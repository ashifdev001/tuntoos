@extends('layouts.master')
@section('title')
    Manage Event - {{ env('APP_NAME') }}
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row my-5">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Manage Event</h3>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="event-create">
                                        <form id="eventCreateForm" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="title" name="title"
                                                        placeholder="Event Title">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="event_date" class="col-sm-2 col-form-label">Event Date</label>
                                                <div class="col-sm-10">
                                                    <input type="date" class="form-control" id="event_date"
                                                        name="event_date" min="{{date('Y-m-d')}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="start_time" class="col-sm-2 col-form-label">Start Time</label>
                                                <div class="col-sm-10">
                                                    <input type="time" class="form-control" id="start_time"
                                                        name="start_time">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="end_time" class="col-sm-2 col-form-label">End Time</label>
                                                <div class="col-sm-10">
                                                    <input type="time" class="form-control" id="end_time"
                                                        name="end_time">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="fees" class="col-sm-2 col-form-label">Fees</label>
                                                <div class="col-sm-10">
                                                    <input type="number" step="0.01" class="form-control" id="fees"
                                                        name="fees" placeholder="Event Fees">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    @if (!empty($id))
                                                        <input type="hidden" name="_method" value="PUT">
                                                    @endif
                                                    <input type="hidden" name="id" id="eventId"
                                                        value="{{ $id ?? 0 }}">
                                                    <button type="submit" id="event_create_submit"
                                                        class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/assets/admin') }}/js/custom/events.js"></script>
@endsection
