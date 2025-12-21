@extends('layouts.master')

@section('title')
    Galleries - {{ env('APP_NAME') }}
@endsection

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row my-4">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header bg-primary" style="position: relative;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>Galleries</div>
                                <a href="{{ route('add.images') }}" class="btn btn-success">
                                    Add New
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-section">
                                <table id="galleryTab" class="table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Image</th>
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
    <input type="hidden" name="type" id="type" value="gallery" />
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/assets/admin/js/common/datatables.js') }}"></script>
    <script src="{{ asset('/assets/admin/js/custom/gallery.js') }}"></script>
@endsection