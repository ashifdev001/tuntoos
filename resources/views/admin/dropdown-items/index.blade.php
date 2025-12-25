@extends('layouts.master')

@section('title')
    Dropdown Items - {{ env('APP_NAME') }}
@endsection

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row my-4">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Dropdown Items</h3>
                        </div>
                        <form id="aboutUsForm" method="POST" action="" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control" id="title"
                                        placeholder="Enter title" value="">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="tabale-section">
                                <table id="dropdownItemsTbl" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sr no.</th>
                                            <th>Title</th>
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
    <script src="{{asset('/assets/admin')}}/js/custom/dropdown-items.js"></script>
@endsection