@extends('layouts.master')
@section('title')
    Manage Brands - {{ env('APP_NAME') }}
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row my-4">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Manage Brand</h3>
                        </div>
                        <form id="brandForm" method="POST" action="" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="brand_name">Name</label>
                                    <input type="text" name="name" class="form-control" id="brand_name"
                                        placeholder="Enter brand name">
                                </div>
                                <div class="form-group">
                                    <div id="image-preview" class="mb-2">
                                        <img id="preview-img" src="#" alt="Image Preview"
                                            style="display:none; max-width: 200px; max-height: 200px;" />
                                    </div>
                                    <label for="brand_image">Image</label>
                                    <input type="file" name="image" class="form-control-file" id="brand_image">
                                </div>
                                <div class="form-group">
                                    <label for="brand_link">Link</label>
                                    <input type="text" name="link" class="form-control" id="brand_link"
                                        placeholder="Enter brand link URL">
                                </div>
                            </div>
                            <div class="card-footer">
                                @if (!empty($id))
                                    <input type="hidden" name="_method" value="PUT">
                                @endif
                                <input type="hidden" name="id" id="brandId" value="{{ $id ?? 0 }}">
                                <button type="submit" class="btn btn-primary">Save Brand</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('/assets/admin') }}/js/custom/brands.js"></script>
@endsection
