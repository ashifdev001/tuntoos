@extends('layouts.master')
@section('title')
    Manage Banners - {{ env('APP_NAME') }}
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row my-4">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Manage Banner</h3>
                        </div>
                        <form id="bannerForm" method="POST" action="" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="banner_type">Type</label>
                                    <select name="type" class="form-control" id="banner_type">
                                        <option value="">Select banner type</option>
                                        <option value="home">Home</option>
                                        <option value="about">About</option>
                                        <option value="flavor">Flavor</option>
                                        <option value="distributor">Distributor</option>
                                        <option value="franchise">Franchise</option>
                                        <option value="gallery">Gallery</option>
                                        <option value="video">Video</option>
                                        <option value="contact">Contact Us</option>
                                        <option value="thankyou">Thank You</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="banner_title">Title</label>
                                    <input type="text" name="title" class="form-control" id="banner_title"
                                        placeholder="Enter banner title">
                                </div>
                                <div class="form-group">
                                    <label for="banner_subtitle">Subtitle</label>
                                    <input type="text" name="subtitle" class="form-control" id="banner_subtitle"
                                        placeholder="Enter banner subtitle">
                                </div>
                                <div class="form-group">
                                    <div id="image-preview" class="mb-2">
                                        <img id="preview-img" src="#" alt="Image Preview"
                                            style="display:none; max-width: 200px; max-height: 200px;" />
                                    </div>
                                    <label for="banner_image">Image</label>
                                    <input type="file" name="image" class="form-control-file" id="banner_image">
                                </div>
                                <div class="form-group">
                                    <label for="banner_btn_txt">Button Text</label>
                                    <input type="text" name="btn_txt" class="form-control" id="banner_btn_txt"
                                        placeholder="Enter button text">
                                </div>
                                <div class="form-group">
                                    <label for="banner_link">Link</label>
                                    <input type="text" name="link" class="form-control" id="banner_link"
                                        placeholder="Enter link URL">
                                </div>
                                <div class="form-group">
                                    <label for="banner_status">Status</label>
                                    <select name="status" class="form-control" id="banner_status">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                @if (!empty($id))
                                    <input type="hidden" name="_method" value="PUT">
                                @endif
                                <input type="hidden" name="id" id="bannerId" value="{{ $id ?? 0 }}">
                                <button type="submit" class="btn btn-primary">Save Banner</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('/assets/admin') }}/js/custom/banners.js"></script>
@endsection