@extends('layouts.master')

@section('title')
    Manage Distributor - {{ env('APP_NAME') }}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row my-4">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Manage Distributor</h3>
                        </div>
                        <form id="aboutUsForm" method="POST" action="" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="about_image">Image</label>
                                    <div class="mb-2">

                                        <img id="preview-img" src="#"
                                            style="display: none; max-width: 200px; max-height: 200px;">
                                    </div>
                                    <input type="file" name="distributor_image" class="form-control-file"
                                        id="distributor_image">
                                </div>
                                <div class="form-group">
                                    <label for="distributor_description">Full Description</label>
                                    <textarea name="distributor_description" class="form-control"
                                        id="distributor_description" placeholder="Enter full description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="distributor_more_content">More Content</label>
                                    <textarea name="distributor_more_content" class="form-control"
                                        id="distributor_more_content" placeholder="Enter More Content"></textarea>
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
    <script src="{{asset('/assets/admin')}}/js/custom/distributor.js"></script>
@endsection