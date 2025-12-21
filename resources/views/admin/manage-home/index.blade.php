@extends('layouts.master')

@section('title')
    Manage Home Page - {{ env('APP_NAME') }}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row my-4">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Manage Home Page</h3>
                        </div>
                        <form method="POST" id="manage-home-form" enctype="multipart/form-data">
                            <div class="card-body">
                                <h4 class="text-primary mb-3">Refreshing Flavors</h4>
                                <div class="form-group">
                                    <label>Heading</label>
                                    <input type="text" name="rf_heading" class="form-control"
                                        value="{{ $settings['rf_heading'] ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="rf_description"
                                        class="form-control">{{ $settings['rf_description'] ?? '' }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Image 1</label>
                                        <input type="file" name="rf_image_1" class="form-control-file"
                                            onchange="previewImage(this,'#rf_image_1_preview')">
                                        <img id="rf_image_1_preview"
                                            style="display:none;max-width:100%;height:auto;margin-top:6px;">
                                    </div>

                                    <div class="col-md-3">
                                        <label>Image 2</label>
                                        <input type="file" name="rf_image_2" class="form-control-file"
                                            onchange="previewImage(this,'#rf_image_2_preview')">
                                        <img id="rf_image_2_preview"
                                            style="display:none;max-width:100%;height:auto;margin-top:6px;">
                                    </div>

                                    <div class="col-md-3">
                                        <label>Image 3</label>
                                        <input type="file" name="rf_image_3" class="form-control-file"
                                            onchange="previewImage(this,'#rf_image_3_preview')">
                                        <img id="rf_image_3_preview"
                                            style="display:none;max-width:100%;height:auto;margin-top:6px;">
                                    </div>

                                    <div class="col-md-3">
                                        <label>Site Image</label>
                                        <input type="file" name="rf_site_image" class="form-control-file"
                                            onchange="previewImage(this,'#rf_site_image_preview')">
                                        <img id="rf_site_image_preview"
                                            style="display:none;max-width:100%;height:auto;margin-top:6px;">
                                    </div>
                                </div>



                                <hr>

                                {{-- ================= Demand Product ================= --}}
                                <h4 class="text-primary mb-3">Demand Product</h4>

                                <div class="form-group">
                                    <label>Offer</label>
                                    <input type="text" name="dp_offer" class="form-control"
                                        value="{{ $settings['dp_offer'] ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="dp_title" class="form-control"
                                        value="{{ $settings['dp_title'] ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="dp_description"
                                        class="form-control">{{ $settings['dp_description'] ?? '' }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Get In Text</label>
                                    <input type="text" name="dp_get_in_text" class="form-control"
                                        value="{{ $settings['dp_get_in_text'] ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="dp_image" class="form-control-file"
                                        onchange="previewImage(this,'#dp_image_preview')">

                                    <img id="dp_image_preview"
                                        style="display:none;max-width:150px;height:auto;margin-top:8px;">
                                </div>


                                <hr>

                                {{-- ================= Video Section ================= --}}
                                <h4 class="text-primary mb-3">Video Section</h4>

                                <div class="form-group">
                                    <label>Thumbnail Image</label>
                                    <input type="file" name="vd_image" class="form-control-file"
                                        onchange="previewImage(this,'#vd_image_preview')">

                                    <img id="vd_image_preview"
                                        style="display:none;max-width:150px;height:auto;margin-top:8px;">
                                </div>

                                <div class="form-group">
                                    <label>Video Type</label>
                                    <select name="vd_video_type" class="form-control">
                                        <option value="url" {{ ($settings['vd_video_type'] ?? '') == 'url' ? 'selected' : '' }}>
                                            Video URL</option>
                                        <option value="upload" {{ ($settings['vd_video_type'] ?? '') == 'upload' ? 'selected' : '' }}>Upload Video</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Video URL</label>
                                    <input type="text" name="vd_video_url" class="form-control"
                                        value="{{ $settings['vd_video_url'] ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label>Upload Video</label>
                                    <input type="file" name="vd_video_file" class="form-control-file">
                                </div>

                            </div>

                            <div class="card-footer">
                                <button class="btn btn-primary">Save</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('/assets/admin')}}/js/custom/manage-home.js"></script>
@endsection