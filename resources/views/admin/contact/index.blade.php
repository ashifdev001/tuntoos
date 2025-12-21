@extends('layouts.master')

@section('title')
    Manage Contact Us - {{ env('APP_NAME') }}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row my-4">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Manage Contact Us</h3>
                        </div>
                        <form id="contactUsForm" method="POST" action="" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="contact_title">Addesss</label>
                                    <input type="text" name="contact_address" class="form-control" id="contact_address"
                                        placeholder="Enter Address">
                                </div>
                                <div class="form-group">
                                    <label for="contact_phone">Phone <small>(Use commas to separate multiple
                                            numbers)</small></label>
                                    <input type="text" name="contact_phone" class="form-control" id="contact_phone"
                                        placeholder="Enter phone number(s), e.g. 9876543210,9123456780"
                                        />
                                </div>
                                <div class="form-group">
                                    <label for="contact_email">Email <small>(Use commas to separate multiple
                                            email)</small></label>
                                    <input type="text" name="contact_email" class="form-control" id="contact_email"
                                        placeholder="Enter email ids(s), e.g. example1@example.com,example2@example.com" />
                                </div>

                                <div class="form-group">
                                    <label for="contact_open_hrs">Opening Hours</label>
                                    <input type="text" name="contact_open_hrs" class="form-control" id="contact_open_hrs"
                                        placeholder="Enter Opening Hours">
                                </div>

                                <div class="form-group">
                                    <label for="map_link">Map Link</label>
                                    <input type="url" name="map_link" class="form-control" id="map_link"
                                        placeholder="Enter Google Maps link"
                                        value="{{ old('map_link', $branch->map_link ?? '') }}">
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
    <script src="{{asset('/assets/admin')}}/js/custom/contact.js"></script>
@endsection