@extends('frontend.layout')

@section('page_name')
    team
@endsection

@section('title')
    {{ env('APP_NAME') }} - Our Team
@endsection

@section('content')
    <!-- Page Banner Start -->
    <div class="page-banner-area">
        <div class="container">
            <div class="page-banner-content">
                <h2>Our Team</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Our Team</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Banner End -->

    <!-- Team Section Start -->
    <div class="team-section ptb-100">
        <div class="container">
            <div class="section-title">
                <span>Our Team</span>
                <h2>Meet Our Expert Team</h2>
                <p>Get to know the talented individuals behind our success.</p>
            </div>
            <!-- Add team members here -->
        </div>
    </div>
    <!-- Team Section End -->
@endsection
