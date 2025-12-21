@extends('layouts.master')
@section('title')
    Manage Testimonials - {{ env('APP_NAME') }}
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row my-4">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Manage Testimonial</h3>
                        </div>
                        <form id="testimonialForm" method="POST" action="" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="testimonial_name">Name</label>
                                    <input type="text" name="name" class="form-control" id="testimonial_name"
                                        placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="testimonial_location">Location</label>
                                    <input type="text" name="location" class="form-control" id="testimonial_location"
                                        placeholder="Enter location">
                                </div>
                                <div class="form-group">
                                    <label for="testimonial_message">Message</label>
                                    <textarea name="message" class="form-control" id="testimonial_message" rows="4"
                                        placeholder="Enter testimonial message"></textarea>
                                </div>
                                <div class="form-group">
                                    <div id="image-preview" class="mb-2">
                                        <img id="preview-img" src="#" alt="Image Preview"
                                            style="display:none; max-width: 200px; max-height: 200px;" />
                                    </div>
                                    <label for="testimonial_image">Image</label>
                                    <input type="file" name="image" class="form-control-file" id="testimonial_image">
                                </div>
                            </div>
                            <div class="card-footer">
                                @if (!empty($id))
                                    <input type="hidden" name="_method" value="PUT">
                                @endif
                                <input type="hidden" name="id" id="testimonialId" value="{{ $id ?? 0 }}">
                                <button type="submit" class="btn btn-primary">Save Testimonial</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('/assets/admin') }}/js/custom/testimonials.js"></script>
@endsection
