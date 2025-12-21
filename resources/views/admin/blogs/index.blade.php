@extends('layouts.master')
@section('title')
    Blogs - {{ env('APP_NAME') }}
@endsection
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row my-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary" style="position: relative;">
                            <div class="d-flex" style="justify-content: space-between;">
                                <div class="d-flex align-items-center">Blogs</div>
                                <div class=""><a type="button" href="{{ route('admin-blog') }}"
                                        class="btn btn-success">Create Blog</a></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tabale-section">
                                <table id="blogs" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sr no.</th>
                                            <th>title</th>
                                            <th>Cover Image</th>
                                            <th>Short Description</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/assets/admin') }}/js/common/datatables.js"></script>
    <script src="{{ asset('/assets/admin') }}/js/custom/blogs.js"></script>
@endsection
