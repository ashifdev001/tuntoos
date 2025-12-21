@extends('layouts.master')

@section('title')
    Manage Achievement - {{ env('APP_NAME') }}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row my-4">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Manage Achievement</h3>
                        </div>
                        <form id="achievementForm" method="POST" action="">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="achievement_title">Title</label>
                                    <input type="text" name="title" class="form-control" id="achievement_title"
                                        placeholder="Enter title" value="{{ old('title', $achievement->title ?? '') }}">
                                </div>
                                <div class="form-group">
                                    <label for="achievement_countTxt">Count Text</label>
                                    <input  name="countTxt" class="form-control" id="achievement_countTxt"
                                        placeholder="Count Text"
                                        />
                                </div>
                            </div>
                            <div class="card-footer">
                                @if (!empty($id))
                                    <input type="hidden" name="_method" value="PUT">
                                @endif
                                <input type="hidden" name="id" id="achievementId" value="{{ $id ?? 0 }}">
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
    <script src="{{ asset('/assets/admin/js/custom/achievements.js') }}"></script>
@endsection