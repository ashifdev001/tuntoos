@extends('frontend.layout')
@section('page_name')
    galleries
@endsection

@section('title')
    {{ env('APP_NAME') }} - {{  'Gallries' }}
@endsection
@section('content')
    <!-- Page Title -->
    <x-hero-section page="gallery" />
    <!-- End Page Title -->
    <!-- Gallery Page Section -->
   <x-gallery />
    <!-- End Gallery Page Section -->
@endsection