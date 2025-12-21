@extends('layouts.master')

@section('title')
    Teams - {{ env('APP_NAME') }}
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
                                <div>Teams</div>
                                <div>
                                    <a href="{{ route('admin-team.create') }}" class="btn btn-success">
                                        Create Team
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-section">
                                <table id="teams" class="table table-bordered table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Position</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- DataTables will load data --}}
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
    <script src="{{ asset('/assets/admin') }}/js/custom/teams.js"></script>
@endsection
