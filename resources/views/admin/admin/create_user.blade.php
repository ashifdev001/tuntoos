@extends('layouts.master')
@section('title')
    Admin - {{ env('APP_NAME') }}
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-8 my-4">
                    <div class="card">
                        <div class="card-header bg-primary" style="position: relative;">
                            <div class="d-flex" style="justify-content: space-between;">
                                <div class="d-flex align-items-center">Create New User</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="create_new_user">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="name">User Name</label>
                                            <input type="text" class="form-control" id="name" name="" placeholder="Enter Name">
                                          </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" placeholder="Email">
                                          </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="email">Password</label>
                                            <input type="password" class="form-control" id="password" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="email">Repeat Password</label>
                                            <input type="password" class="form-control" id="c_password" placeholder="Repeat Password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="role_id">User Role</label>
                                            <select class="form-control" id="role_id" name="role_id">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                    </div>
                                </div>
                                <button class="btn btn-primary" id="create_new_user_submit" style="float: right;">Submit</button>
                              </form>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{asset('/assets/admin')}}/js/custom/create_new_user.js"></script>
@endsection