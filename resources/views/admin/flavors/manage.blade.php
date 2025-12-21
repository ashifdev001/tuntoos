@extends('layouts.master')

@section('title')
    Manage Flavor - {{ env('APP_NAME') }}
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
                                    {{ !empty($id) ? 'Edit Flavor' : 'Create Flavor' }}
                                </h3>
                            </div>

                            <form id="flavorCreateForm" enctype="multipart/form-data">
                                @csrf

                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text"
                                               class="form-control"
                                               id="title"
                                               name="title"
                                               placeholder="Enter flavor title"
                                               maxlength="255">
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control"
                                                  id="description"
                                                  name="description"
                                                  placeholder="Enter flavor description"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <div class="viewImg mb-2"></div>
                                        <label for="image">Flavor Image</label>
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

                                    <input type="hidden" name="id" id="flavorId" value="{{ $id ?? 0 }}">

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
    <script src="{{ asset('/assets/admin/js/custom/flavors.js') }}"></script>
@endsection
