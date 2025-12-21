@extends('layouts.master')

@section('title')
    Franchise - {{ env('APP_NAME') }}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row my-4">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header bg-primary" style="position: relative;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>Franchise</div>

                            </div>
                        </div>

                        <div class="card-body">
                            <form id="updateHeading" method="POST">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="franchise_image_preview"></div>
                                        <label for="franchise_image" class="form-label">Franchise Image</label>
                                        <div>
                                            <input  type="file" id="franchise_image" name="franchise_image" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label for="franchise_model" class="form-label">Franchise Model</label>
                                        <textarea class="form-control" id="franchise_model" name="franchise_model"
                                            placeholder="Enter description" required></textarea>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <div class="funtoos_image_preview"></div>
                                        <label for="funtoos_image" type="file" class="form-label">funtoos Image</label>
                                        <div>
                                            <input type="file" id="funtoos_image" name="funtoos_image" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label for="funtoos_description" class="form-label">Why Choose funtoos?</label>
                                        <textarea class="form-control" id="funtoos_description" name="funtoos_description"
                                            placeholder="Enter description" required></textarea>
                                    </div>
                                    
                                    <div class="col-md-12 mt-2">
                                        <div class="funtoos_image_1_preview"></div>
                                        <label for="funtoos_image_1" type="file" class="form-label">Funtoos Promise Image 1</label>
                                        <div>
                                            <input type="file" id="funtoos_image_1" name="funtoos_image_1" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <div class="funtoos_image_2_preview"></div>
                                        <label for="funtoos_image_2" type="file" class="form-label">Funtoos Promise Image 2</label>
                                        <div>
                                            <input type="file" id="funtoos_image_2" name="funtoos_image_2" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label for="funtoos_promise" class="form-label">Funtoos Promise</label>
                                        <textarea class="form-control" id="funtoos_promise" name="funtoos_promise"
                                            placeholder="Enter description"></textarea>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label for="funtoos_promise_btn_text_1" class="form-label">Funtoos Promise Btn Text 1</label>
                                        <textarea class="form-control" id="funtoos_promise_btn_text_1" name="funtoos_promise_btn_text_1"
                                            placeholder="Enter description"></textarea>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label for="funtoos_promise_btn_bellow_text_1" class="form-label">Funtoos Promise Bellow Btn Text 1</label>
                                        <textarea class="form-control" id="funtoos_promise_btn_bellow_text_1" name="funtoos_promise_btn_bellow_text_1"
                                            placeholder="Enter description"></textarea>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label for="funtoos_promise_btn_text_2" class="form-label">Funtoos Promise Btn Text 2</label>
                                        <textarea class="form-control" id="funtoos_promise_btn_text_2" name="funtoos_promise_btn_text_2"
                                            placeholder="Enter description"></textarea>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label for="funtoos_promise_btn_bellow_text_2" class="form-label">Funtoos Promise Bellow Btn Text 2</label>
                                        <textarea class="form-control" id="funtoos_promise_btn_bellow_text_2" name="funtoos_promise_btn_bellow_text_2"
                                            placeholder="Enter description"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/assets/admin/js/custom/franchise.js') }}"></script>
@endsection