@extends('layouts.master')

@section('title')
    Manage Video - {{ env('APP_NAME') }}
@endsection

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row my-4">
            <div class="col-12">
                <div class="card card-primary">

                    <div class="card-header">
                        <h3 class="card-title">
                            {{ !empty($id) ? 'Update Video' : 'Add Video' }}
                        </h3>
                    </div>

                    <form id="videoForm" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">

                            {{-- ================= Title ================= --}}
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text"
                                       name="title"
                                       id="title"
                                       class="form-control"
                                       placeholder="Enter Title"
                                       value="{{ $video->title ?? '' }}">
                            </div>

                            {{-- ================= Thumbnail ================= --}}
                            <div class="form-group">
                                <label>Thumbnail</label>
                                <input type="file"
                                       name="thumbnail"
                                       class="form-control-file"
                                       onchange="previewImage(this,'#thumbnail_preview')">

                                <img id="thumbnail_preview"
                                     src="{{ $video->thumbnail ?? '' }}"
                                     style="{{ !empty($video->thumbnail) ? '' : 'display:none;' }}max-width:150px;margin-top:8px;">
                            </div>

                            {{-- ================= Video Type ================= --}}
                            <div class="form-group">
                                <label>Video Type</label>
                                <select name="video_type" id="video_type" class="form-control">
                                    <option value="upload"
                                        {{ ($video->video_type ?? '') == 'upload' ? 'selected' : '' }}>
                                        Upload File
                                    </option>
                                    <option value="url"
                                        {{ ($video->video_type ?? '') == 'url' ? 'selected' : '' }}>
                                        Video URL
                                    </option>
                                </select>
                            </div>

                            {{-- ================= Video URL ================= --}}
                            <div class="form-group" id="video_url_box">
                                <label>Video URL</label>
                                <input type="text"
                                       name="video_url"
                                       class="form-control"
                                       placeholder="https://youtube.com/..."
                                       value="{{ $video->video_url ?? '' }}">
                            </div>

                            {{-- ================= Video Upload ================= --}}
                            <div class="form-group" id="video_file_box">
                                <label>Upload Video</label>
                                <input type="file"
                                       name="video_file"
                                       class="form-control-file"
                                       accept="video/*">
                            </div>

                        </div>

                        <div class="card-footer">
                            @if (!empty($id))
                                <input type="hidden" name="_method" value="PUT">
                            @endif

                            <input type="hidden" id="gId" value="{{ $id ?? 0 }}">
                            

                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('/assets/admin/js/custom/video.js') }}"></script>
@endsection
