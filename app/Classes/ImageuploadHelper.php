<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageuploadHelper
{
    public static function getUploadImagesizes($type)
    {
       $sizes = [
            'profile_images' => [],
            'service_categories' => [],
            'banners' => [],
            'blog_images' => [],
            'brands' => [],
            'customersay' => [],
            'services' => [],
            'blogs' => [],
            'setting_images' => [],
            'galleries' => [],
            'achievements' => [],
            'satisfaction_guaranteed' => [],
            'resumes' => [],
            'flavors' => [],
            'teams' => [],
            'videos' => [],
            'video_thumbnails' => [],
        ];

        return $sizes[$type];
    }

    public static function uploadImage($file, $type = null, $auto = false, $filepath = null, $isImage = true, $isBase64 = false, $base64Data = [])
    {
        $dimensions = self::getUploadImagesizes($type);

        $storageType = 'local';

        if ($filepath == null) {
            $filepath = 'upload/' . $type . '/' . date('Y') . '/' . date('M') . '/' . date('d') . '/';
        }

        $destination = Storage::disk('public')->path($filepath);

        if (!$isBase64) {
            $filename = md5(bcrypt(time())) . '.' . $file->getClientOriginalExtension();
            $file->move($destination, $filename);
        } else {
            $filename = md5(bcrypt(time())) . '.' . $base64Data['ext'];
            Storage::disk('public')->put($filepath . $filename, $base64Data['data']);
        }


        // if ($isImage) {
        //     $img = \Image::make($destination . $filename);
        //     $img->orientate()->save($destination . $filename);
        //     app(\Spatie\ImageOptimizer\OptimizerChain::class)->optimize(Storage::disk('public')->path($filepath . $filename));
        // }

        if ($type != null) {
            self::makeDimensionFolders($dimensions, $filepath, $destination, $filename, $auto);
        }

        if (env('USE_AWS_BUCKET') == true) {
            self::moveFileToAws($filename, $filepath, $filepath . $filename, true);
            $storageType = 'aws';
        }

        return [
            'path' => $filepath . $filename,
            'directory' => $filepath,
            'storage_type' => $storageType,
            'filename' => $filename
        ];
    }

    public static function makeDimensionFolders($dimensions, $filepath, $destination, $filename, $auto)
    {
        foreach ($dimensions as $dimension) {
            $newDestination = Storage::disk('public')->path($filepath . $dimension['height'] . 'x' . $dimension['width'] . '/');
            \File::makeDirectory($newDestination, $mode = 0777, true, true);
            \File::copy($destination . $filename, $newDestination . $filename);

            $img = \Image::make($newDestination . $filename);
            if ($auto) {
                $img->resize(null, $dimension['height'], function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->orientate()->save($newDestination . $filename);
            } else {
                $img->fit($dimension['width'], $dimension['height'], function ($constraint) {
                    $constraint->upsize();
                }, 'top')->orientate()->save($newDestination . $filename);
            }
            if (env('USE_AWS_BUCKET') == true) {
                self::moveFileToAws($filename, $filepath . $dimension['height'] . 'x' . $dimension['width'] . '/', $newDestination . $filename, true);
            }
        }
    }

    public static function copyFile($path, $type)
    {
        $storageType = 'local';
        $extArr = explode('.', $path);
        $ext = $extArr[count($extArr) - 1];
        $newPath = 'upload/' . date('Y') . '/' . date('M') . '/' . date('d') . '/' . $type . '/';
        $fileName = md5(bcrypt(time())) . '.' . $ext;
        $fileContents = file_get_contents(self::getUploadedFileUrl($path));
        if (!File::isDirectory($newPath)) {
            File::makeDirectory($newPath, 0777, true, true);
        }
        File::put($newPath . $fileName, $fileContents);
        if (env('USE_AWS_BUCKET') == true) {
            self::moveFileToAws($fileName, $newPath, $newPath . $fileName, true);
            $storageType = 'aws';
        }
        return [
            'path' => $newPath . $fileName,
            'directory' => $newPath,
            'storage_type' => $storageType,
            'filename' => $fileName
        ];
    }

    public static function moveFileToAws($filename, $path, $localPath, $removeLocal = false)
    {
        $localPath = Storage::disk('public')->path($localPath);
        $contents = file_get_contents($localPath);
        $storagePath = Storage::disk('s3')->put($path . $filename, $contents, 'public');
        if ($storagePath && $removeLocal) {
            unlink($localPath);
        }
        return $storagePath;
    }

    public static function getUploadedFileUrl($path)
    {
        if ($path && $path != '') {
            if (env('USE_AWS_BUCKET') == true) {
                return Storage::disk('s3')->url($path);
            }
            return Storage::disk('public')->url($path);
        }
        return '';
    }

    public static function removeImageFromDisk($filePath, $type = null)
    {
        if (env('USE_AWS_BUCKET') == true && $filePath != null) {
            Storage::disk('s3')->delete($filePath);
        } else {
            if ($filePath && file_exists(Storage::disk('public')->path($filePath))) {
                unlink(Storage::disk('public')->path($filePath));
            }
        }
        if ($type != null) {
            $sizes = self::getUploadImagesizes($type);
            foreach ($sizes as $size) {
                self::removeImageFromDisk(self::getImagePath($filePath, $size['height'] . 'x' . $size['width']));
            }
        }
    }

    public static function getImagePath($path, $folder)
    {
        $filenameArr = explode('/', $path);
        $filename = $filenameArr[(count($filenameArr) - 1)];
        $newPath = str_replace($filename, '', $path);
        $newFilePath = $newPath . $folder . '/' . $filename;
        if (env('USE_AWS_BUCKET') == true) {
            $exists = Storage::disk('s3')->exists($newFilePath);
            if ($exists) {
                return $newFilePath;
            }
            return $path;
        }
        if (file_exists(Storage::disk('public')->path($newFilePath))) {
            return $newFilePath;
        }
        return $path;
    }

    public static function getImageFullLocalPath($path, $folder)
    {
        $filenameArr = explode('/', $path);
        $filename = $filenameArr[(count($filenameArr) - 1)];
        $newPath = str_replace($filename, '', $path);
        $folder = (!empty($folder)) ? $folder . '/' : '';
        $newFilePath = $newPath . $folder . $filename;
        $storagePath = Storage::disk('public')->path($newFilePath);
        if (file_exists($storagePath)) {
            return $storagePath;
        }
        return null;
    }

    private static function getFileTypes()
    {
        return [
            'image'
        ];
    }

    public static function fileStream($fileId, $table)
    {
        try {
            $fileType = ImageuploadHelper::getFileTypes();
            $fileRow = DB::table($table)->find($fileId);
            if (is_null($fileRow))
                return null;
            $row = (array) $fileRow;
            $path = "";
            foreach ($row as $key => $r) {
                if (in_array($key, $fileType)) {
                    $path = $r;
                    break;
                }
            }
            return ImageuploadHelper::getImageFullLocalPath($path, '');
        } catch (\Throwable $th) {
            return null;
        }
    }
}
