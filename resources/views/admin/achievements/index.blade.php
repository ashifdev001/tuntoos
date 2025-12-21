@extends('layouts.master')

@section('title')
    Achievements - {{ env('APP_NAME') }}
@endsection

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row my-4">
                <div class="col-12">
                    <div class="card">

                        <!-- Header -->
                        <div class="card-header bg-primary" style="position: relative;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>Achievements</div>
                                <a href="{{ route('create-achievement') }}" class="btn btn-success">
                                    Create New Achievement
                                </a>
                            </div>
                        </div>

                        {{-- <div class="card-body">
                            <form id="updateAchievementHeading" method="POST">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="heading" class="form-label">Heading</label>
                                        <input type="text" class="form-control" id="heading" name="achievements_heading"
                                            placeholder="Enter heading" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="achievements_description"
                                            placeholder="Enter description" required></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div> --}}

                        <!-- Achievements Table -->
                        <div class="card-body">
                            <div class="table-section">
                                <table id="achievementsTable" class="table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Count Text</th>
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
    <script src="{{ asset('/assets/admin/js/common/datatables.js') }}"></script>
    <script src="{{ asset('/assets/admin/js/custom/achievements.js') }}"></script>
@endsection
