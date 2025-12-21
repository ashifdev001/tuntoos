@extends('layouts.master')

@section('title')
    Manage Team - {{ env('APP_NAME') }}
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row my-5">
                    <div class="col-md-12">
                        <div class="card card-primary">

                            <div class="card-header">
                                <h3 class="card-title">
                                    {{ !empty($id) ? 'Edit Team Member' : 'Create Team Member' }}
                                </h3>
                            </div>

                            <form id="teamCreateForm" enctype="multipart/form-data">
                                @csrf

                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text"
                                               class="form-control"
                                               id="name"
                                               name="name"
                                               placeholder="Enter team member name"
                                               maxlength="255">
                                    </div>

                                    <div class="form-group">
                                        <label for="position">Position</label>
                                        <input type="text"
                                               class="form-control"
                                               id="position"
                                               name="position"
                                               placeholder="Enter designation / position"
                                               maxlength="255">
                                    </div>

                                    <div class="form-group">
                                        <div class="viewImg mb-2"></div>
                                        <label for="image">Profile Image</label>
                                        <input type="file"
                                               class="form-control"
                                               id="image"
                                               name="image">
                                    </div>

                                </div>

                                <div class="card-footer">
                                    @if (!empty($id))
                                        <input type="hidden" name="_method" value="PUT">
                                    @endif

                                    <input type="hidden" name="id" id="teamId" value="{{ $id ?? 0 }}">

                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/assets/admin/js/custom/teams.js') }}"></script>
@endsection
