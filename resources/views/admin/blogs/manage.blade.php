@extends('layouts.master')
@section('title')
    Manage Blog - {{ env('APP_NAME') }}
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row my-5">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Manage Blog</h3>
                            </div>
                            <form id="blogCreateForm">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="Enter title" maxlength="30">
                                    </div>
                                    <div class="form-group">
                                        <div class="viewCvrImg"></div>
                                        <label for="cover_image">Image For Blog</label>
                                        <input type="file" class="form-control" id="cover_image" name="cover_image">
                                    </div>
                                    <div class="form-group">
                                        <div class="viewImg"></div>
                                        <label for="cover_image">Image For Blog Detail</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                   
                                    <div class="form-group">

                                        <label for="short_desc">Short Description</label>
                                        <textarea type="text" class="form-control" id="short_desc" name="short_desc" placeholder="Enter short description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="long_desc">Long Description</label>
                                        <textarea class="form-control" id="long_desc" name="long_desc" placeholder="Enter long description"></textarea>
                                    </div>
                                     <div class="form-group">
                                        <label for="long_desc">Long Content</label>
                                        <textarea class="form-control" id="content" name="content" placeholder="Enter long description"></textarea>
                                    </div>
                                     <div class="form-group">
                                        <label for="long_desc">Meta Title</label>
                                        <input class="form-control" id="meta_title" name="meta_title" placeholder="Enter meta title" />
                                    </div>
                                    <div class="form-group">
                                        <label for="long_desc">Meta Description</label>
                                        <textarea class="form-control" id="meta_description" name="meta_description" placeholder="Enter meta description"></textarea>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    @if (!empty($id))
                                        <input type="hidden" name="_method" value="PUT">
                                    @endif
                                    <input type="hidden" name="id" id="blogId" value="{{ $id ?? 0 }}">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
    <script src="{{ asset('/assets/admin/js/custom/blogs.js') }}"></script>
    <script src="{{ asset('/assets/admin') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <script>
        $(function() {
            // Summernote
            $('#long_desc').summernote({

                height: 300,
                minHeight: null,
                maxHeight: null,
                focus: true

            })
            $('#short_desc,#content').summernote({

                height: 300,
                minHeight: null,
                maxHeight: null,
                focus: true

            })


        })
    </script>
@endsection
