@extends('layouts.master')

@section('title')
    Manage About Us - {{ env('APP_NAME') }}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row my-4">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Manage About Us</h3>
                        </div>
                        <form id="aboutUsForm" method="POST" action="" enctype="multipart/form-data">
                            <div class="card-body">
                                {{-- Title --}}
                                <div class="form-group">
                                    <label for="about_title">Title</label>
                                    <input type="text" name="about_title" class="form-control" id="about_title"
                                        placeholder="Enter title" value="{{ old('title', $about->title ?? '') }}">
                                </div>
                                <div class="form-group">
                                    <label for="about_image">Home About Image</label>
                                    <div class="mb-2">
                                        <img id="about_home_image_preview" src="#"
                                            style="display: none; max-width: 200px; max-height: 200px;">
                                    </div>
                                    <input type="file" name="about_home_image" class="form-control-file"
                                        id="about_home_image">
                                </div>
                                <div class="form-group">
                                    <label for="about_sort_description">Short Description For Home Page</label>
                                    <textarea name="about_sort_description" class="form-control" id="about_sort_description"
                                        placeholder="Enter short description">{{ old('sort_description', $about->sort_description ?? '') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="about_image">Image</label>
                                    <div class="mb-2">
                                        @if (!empty($about->image))
                                            <img src="{{ $about->image }}" id="preview-img" alt="Preview"
                                                style="max-width: 200px; max-height: 200px;">
                                        @else
                                            <img id="preview-img" src="#"
                                                style="display: none; max-width: 200px; max-height: 200px;">
                                        @endif
                                    </div>
                                    <input type="file" name="about_image" class="form-control-file" id="about_image">
                                </div>
                                <div class="form-group">
                                    <label for="about_description">Full Description</label>
                                    <textarea name="about_description" class="form-control" id="about_description"
                                        placeholder="Enter full description"></textarea>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('/assets/admin')}}/js/custom/about.js"></script>
@endsection