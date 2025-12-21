@extends('layouts.master')

@section('title')
    Videos - {{ env('APP_NAME') }}
@endsection

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row my-4">
            <div class="col-12">
                <div class="card">

                    <div class="card-header bg-primary">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>Videos</div>
                            <a href="{{ route('add.video') }}" class="btn btn-success">
                                Add Video
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table id="videoTable" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Thumbnail</th>
                                    <th>Video</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="type" value="video">

@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('/assets/admin/js/common/datatables.js') }}"></script>
<script src="{{ asset('/assets/admin/js/custom/video.js') }}"></script>
@endsection
