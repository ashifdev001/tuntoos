@extends('layouts.master')

@section('title')
    Manage Galleries - {{ env('APP_NAME') }}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row my-4">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Manage Galleries</h3>
                        </div>
                        <form id="galleryForm" method="POST" action="">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="script">Title</label>
                                    <input name="title" class="form-control" id="title" rows="5"
                                        placeholder="Enter Title" />
                                </div>
                                <div class="form-group">
                                    <label for="script">Description</label>
                                    <input name="description" class="form-control" id="description" rows="5"
                                        placeholder="Enter Description" />
                                </div>
                                <div class="form-group">
                                    <div class="preview"></div>
                                    <label for="script">Images</label>
                                    <input name="images[]" type="file" multiple accept="image/*" class="form-control" id="images"/>
                                </div>
                            </div>
                            <input type="hidden" id="type" value="gallery" name="type">
                            <div class="card-footer">
                                @if (!empty($id))
                                    <input type="hidden" name="_method" value="PUT">
                                @endif
                                <input type="hidden" name="id" id="gId" value="{{ $id ?? 0 }}">
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
    <script src="{{ asset('/assets/admin/js/custom/gallery.js') }}"></script>
@endsection