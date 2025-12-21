@extends('layouts.master')
@section('title')
    General Settings - {{ env('APP_NAME') }}
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row my-4">
                <div class="col-12">
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">General Settings</h3>
                        </div>
                        <div class="card-body">
                            <form id="generalSettingForm">
                                <div class="form-group">
                                    <label for="site_phone">Phone</label>
                                    <input type="text" class="form-control" id="site_phone" name="site_phone"
                                        placeholder="Enter phone">
                                </div>
                                <div class="form-group">
                                    <label for="site_email">Email</label>
                                    <input type="email" class="form-control" id="site_email" name="site_email"
                                        placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="site_facebook">Facebook</label>
                                    <input type="text" class="form-control" id="site_facebook" name="site_facebook"
                                        placeholder="Facebook link">
                                </div>
                                <div class="form-group">
                                    <label for="site_twitter">Twitter</label>
                                    <input type="text" class="form-control" id="site_twitter" name="site_twitter"
                                        placeholder="Twitter link">
                                </div>
                                <div class="form-group">
                                    <label for="site_linkedin">LinkedIn</label>
                                    <input type="text" class="form-control" id="site_linkedin" name="site_linkedin"
                                        placeholder="LinkedIn link">
                                </div>
                                <div class="form-group">
                                    <label for="site_gplus">Instagram</label>
                                    <input type="text" class="form-control" id="site_instagram" name="site_instagram"
                                        placeholder="Instagram link">
                                </div>
                                <div class="form-group">
                                    <label for="site_gplus">Banner bellow section heading</label>
                                    <input type="text" class="form-control" id="banner_bellow_heading" name="banner_bellow_heading"
                                        placeholder="Banner bellow section heading">
                                </div>
                                <div class="form-group">
                                    <label for="site_gplus">Banner bellow section description</label>
                                    <textarea type="text" class="form-control" id="banner_bellow_description" name="banner_bellow_description"
                                        placeholder="Banner bellow section description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="site_gplus">Banner bellow section button text</label>
                                    <input type="text" class="form-control" id="banner_bellow_btn_txt" name="banner_bellow_btn_txt"
                                        placeholder="Banner bellow section button text">
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('/assets/admin') }}/js/custom/general-settings.js"></script>
@endsection