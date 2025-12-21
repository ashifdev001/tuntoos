@extends('layouts.master')
@section('title')
    Admin - {{ env('APP_NAME') }}
@endsection
@section('content')
<style>
.dropdown-toggle::after {
    display: none;
}
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 my-4">
                    <div class="card">
                        <div class="card-header bg-primary" style="position: relative;">
                            <div class="d-flex" style="justify-content: space-between;">
                                <div class="d-flex align-items-center">Admin Management</div>
                                <div class=""><a type="button" href="{{url('/admin/create-user')}}" class="btn btn-success">Create User</a></div>
                            </div>
                        </div>
                        <div class="card-body">
                          <div class="tabale-section">
                            <table id="admin_management" class="display table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                    <div class="user-filter">
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" id="user_id" placeholder="Enter User Id">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control" id="user_name" placeholder="Enter Name">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="user_email" placeholder="Enter Email">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="user_phone" placeholder="Enter Phone">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="user_created_at" placeholder="Created at">
                                            </td>
                                            <td></td>
                                       </tr>
                                    </div>
                                </thead>
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
<script src="{{asset('/assets/admin')}}/js/common/datatables.js"></script>
<script src="{{asset('/assets/admin')}}/js/custom/admin_management.js"></script>
@endsection