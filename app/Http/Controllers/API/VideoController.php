<?php

namespace App\Http\Controllers\API;

use App\Classes\ImageuploadHelper;
use App\Http\Controllers\API\BaseController;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VideoController extends BaseController
{
    /**
     * Display a listing of videos
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $searchTitle = trim($request->input('search'));

        $query = Video::query();

        if (!empty($searchTitle)) {
            $query->where('title', 'LIKE', '%' . $searchTitle . '%');
        }

        $videos = $query->orderBy('id', 'desc')->paginate($perPage);
        
        return $this->sendResponse($videos, 'Video list fetched successfully.');
    }

    /**
     * Store a newly created video
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'        => 'required|string|max:255',
            'thumbnail'    => 'required|image|max:4096',
            'video_type'   => 'required|in:url,upload',
            'video_url'    => 'required_if:video_type,url|nullable|url',
            'video_file'   => 'required_if:video_type,upload|nullable|mimetypes:video/mp4,video/webm,video/ogg,video/quicktime|max:51200',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), 422);
        }

        DB::beginTransaction();

        try {
            // Upload thumbnail
            $thumbPath = null;
            if ($request->hasFile('thumbnail')) {
                $thumb = ImageuploadHelper::uploadImage($request->file('thumbnail'), 'video_thumbnails');
                $thumbPath = $thumb['path'];
            }

            // Upload video file if needed
            $videoFilePath = null;
            if ($request->video_type === 'upload' && $request->hasFile('video_file')) {
                $video = ImageuploadHelper::uploadImage(
                    $request->file('video_file'),
                    'videos',
                    false,
                    null,
                    false
                );
                $videoFilePath = $video['path'];
            }

            $video = Video::create([
                'title'       => $request->title,
                'thumbnail'   => $thumbPath,
                'video_type'  => $request->video_type,
                'video_url'   => $request->video_type === 'url' ? $request->video_url : null,
                'video_file'  => $videoFilePath,
                'status'      => 1,
            ]);

            DB::commit();
            return $this->sendResponse($video, 'Video created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendError('Failed to create video: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified video
     */
    public function show($id)
    {
        $video = Video::find($id);

        if (!$video) {
            return $this->sendError('Video not found', 404);
        }

        return $this->sendResponse($video, 'Video fetched successfully.');
    }

    /**
     * Update the specified video
     */
    public function update(Request $request, $id)
    {
        $video = Video::find($id);

        if (!$video) {
            return $this->sendError('Video not found', 404);
        }

        $validator = Validator::make($request->all(), [
            'title'        => 'sometimes|string|max:255',
            'thumbnail'    => 'sometimes|image|max:4096',
            'video_type'   => 'sometimes|in:url,upload',
            'video_url'    => 'required_if:video_type,url|nullable|url',
            'video_file'   => 'required_if:video_type,upload|nullable|mimetypes:video/mp4,video/webm,video/ogg,video/quicktime|max:51200',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), 422);
        }

        DB::beginTransaction();

        try {
            // Update title
            if ($request->has('title')) {
                $video->title = $request->title;
            }

            // Update thumbnail
            if ($request->hasFile('thumbnail')) {
                ImageuploadHelper::removeImageFromDisk($video->thumbnail);
                $thumb = ImageuploadHelper::uploadImage($request->file('thumbnail'), 'video_thumbnails');
                $video->thumbnail = $thumb['path'];
            }

            // Handle video type change
            if ($request->has('video_type')) {
                $video->video_type = $request->video_type;
            }

            // URL video
            if ($video->video_type === 'url') {
                ImageuploadHelper::removeImageFromDisk($video->video_file);
                $video->video_file = null;
                $video->video_url = $request->video_url;
            }

            // Upload video
            if ($video->video_type === 'upload' && $request->hasFile('video_file')) {
                ImageuploadHelper::removeImageFromDisk($video->video_file);
                $uploaded = ImageuploadHelper::uploadImage(
                    $request->file('video_file'),
                    'videos',
                    false,
                    null,
                    false
                );
                $video->video_file = $uploaded['path'];
                $video->video_url = null;
            }

            $video->save();
            DB::commit();

            return $this->sendResponse($video, 'Video updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendError('Failed to update video: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified video
     */
    public function destroy($id)
    {
        $video = Video::find($id);

        if (!$video) {
            return $this->sendError('Video not found', 404);
        }

        // Remove files
        ImageuploadHelper::removeImageFromDisk($video->thumbnail);
        ImageuploadHelper::removeImageFromDisk($video->video_file);

        $video->delete();

        return $this->sendResponse([], 'Video deleted successfully.');
    }
}
