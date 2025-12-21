<?php

namespace App\Http\Controllers\API;

use App\Classes\ImageuploadHelper;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlogController extends BaseController
{

    public function index(Request $request)
    {
        try {
            $perPage = $request->has('per_page') ? $request->per_page : 25;
            $blogs = Blog::orderBy('id', 'desc');
            if (!empty($request->search)) {
                $blogs = $blogs->where('id', $request->search)
                    ->orWhere('title', 'LIKE', "$request->search%")
                    ->orWhere('short_desc', 'LIKE', "$request->search%");
            }
            $blogs = $blogs->paginate($perPage);
            return $this->sendResponse($blogs, 'Blogs List.');
        } catch (\Exception $e) {
            Log::debug([
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return $this->sendError('Something went wrong!', $e);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'short_desc' => 'required|string',
            'long_desc' => 'string',
            
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }

        $title = $request->input('title');
        $slug = Blog::generateSlug($title);

        $blog = new Blog();
        $blog->title = $title;
        $blog->slug = $slug;
        $blog->short_desc = $request->short_desc;
        $blog->long_desc = $request->long_desc;
        $blog->content = $request->contenttxt;
        $blog->meta_title = $request->meta_title;
        $blog->meta_description = $request->meta_description;

        if ($request->hasFile('cover_image')) {
            $imageName = ImageuploadHelper::uploadImage($request->file('cover_image'), 'blogs');
            $blog->cover_image = $imageName['path'];
        }

         if ($request->hasFile('image')) {
            $imageName = ImageuploadHelper::uploadImage($request->file('image'), 'blogs');
            $blog->image = $imageName['path'];
        }

        $blog->save();

        return $this->sendResponse($blog, 'Blog created successfully.');
    }

    public function show($id)
    {
        $blog = Blog::find($id);

        if (is_null($blog)) {
            return $this->sendError('Blog not found.');
        }

        return $this->sendResponse($blog, 'Blog retrieved successfully.');
    }

    public function update(Request $request, Blog $blog)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'short_desc' => 'required|string',
            'long_desc' => 'required|string',
            
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }

        $blog->title = $request->title;
        $blog->short_desc = $request->short_desc;
        $blog->long_desc = $request->long_desc;
        $blog->content = $request->contenttxt;
         $blog->meta_title = $request->meta_title;
        $blog->meta_description = $request->meta_description;

        if ($request->hasFile('cover_image')) {
            ImageuploadHelper::removeImageFromDisk($blog->cover_image);
            $imageName = ImageuploadHelper::uploadImage($request->file('cover_image'), 'blogs');
            $blog->cover_image = $imageName['path'];
        }
        if ($request->hasFile('image')) {
            ImageuploadHelper::removeImageFromDisk($blog->image);
            $imageName = ImageuploadHelper::uploadImage($request->file('image'), 'blogs');
            $blog->image = $imageName['path'];
        }

        $blog->save();
        return $this->sendResponse($blog, 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return $this->sendResponse([], 'Blog deleted successfully.');
    }
}
