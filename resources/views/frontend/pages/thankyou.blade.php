@extends('frontend.layout')

@section('page_name')
    thank-you
@endsection

@section('title')
    {{ env('APP_NAME') }} - Thank You
@endsection

@section('content')
    <div class="page-content ">

        <!-- Hero Section -->
        <x-hero-section page="thankyou" />

        <!-- Thank You Message -->
        <div class="section-full content-inner bg-white" >
            <div class="container text-center">
                <div class="thankyou-message max-w700 m-auto p-tb50" style="margin-bottom: 60px">
                    <div class="icon-box m-b30">
                        <span class="icon fa fa-check-circle text-success fa-4x"></span>
                    </div>
                    <h2 class="m-b10">Thank You!</h2>
                    <p class="lead m-b20">Your submission has been received successfully. We’ll get back to you shortly.</p>
                    <p>If you have any urgent queries, feel free to <a href="{{ route('contact') }}">contact us</a>
                        directly.</p>
                    <a href="{{ url('/') }}" class="site-button m-t30">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
@endsection