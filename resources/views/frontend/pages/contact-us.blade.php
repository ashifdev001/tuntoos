@extends('frontend.layout')
@section('page_name')
    contact
@endsection
@section('title')
    {{ env('APP_NAME') }} - Contact Us
@endsection
@section('content')
   <!-- Page Title -->
		<x-hero-section page="contact" />
		<!-- End Page Title -->
		<!-- Contact Page Section -->
		<section class="contact-page-section">
			<div class="auto-container">
				<!-- Sec Title -->
				<div class="sec-title centered">
					<h2>Get in touch</span></h2>
					<div class="separate"></div>
				</div>
				<div class="row clearfix">

					<!-- Form Column -->
					<div class="form-column col-lg-8 col-md-12 col-sm-12">
						<div class="inner-column">
							<div class="title-box">
								<h4>Drop us a line</h4>
								<div class="text">Your email address will not be published. Required fields are marked *
								</div>
							</div>

							<!-- Contact Form -->
							<div class="contact-form">
								<form method="post" action="" id="contact-form">
									<div class="row clearfix">

										<div class="form-group col-lg-6 col-md-6 col-sm-12">
											<input type="text" name="username" placeholder="Your Name" required="">
										</div>
										<div class="form-group col-lg-6 col-md-6 col-sm-12">
											<input type="text" name="phone" placeholder="Contact Number" required="">
										</div>

										<div class="form-group col-lg-6 col-md-6 col-sm-12">
											<input type="email" name="email" placeholder="Your Email" required="">
										</div>
										<div class="form-group col-lg-6 col-md-6 col-sm-12">
											<input type="text" name="subject" placeholder="Write Your Purpose"
												required="">
										</div>
										<div class="form-group col-lg-12 col-md-12 col-sm-12">
											<textarea name="message" placeholder="Your Comment"></textarea>
										</div>

										<div class="form-group col-lg-12 col-md-12 col-sm-12">
											<button type="submit" class="theme-btn btn-style-four clearfix"><span
													class="icon flaticon-arrow-pointing-to-right"></span>Send</button>
										</div>

									</div>
								</form>
								<!-- Contact Form -->
							</div>

						</div>
					</div>

					<!-- Info Column -->
					<div class="info-column col-lg-4 col-md-12 col-sm-12">
						<div class="inner-column">
							<ul class="info-list">
								<li>
									<Strong>Email</Strong>
									{{ $settings['contact_email'] }}
								</li>
								<li>
									<strong>Phone</strong>
									@forelse (explode(',', $settings['contact_phone']) as $item)
										{{ $item }} <br />
									@empty
										
									@endforelse
								</li>
								<li>
									<strong>Address</strong>
									{{ $settings['contact_address'] }}
								</li>
								<li>
									<strong>Opening Hours</strong>
									{!! $settings['contact_open_hrs'] !!}
								</li>
							</ul>
						</div>
					</div>

				</div>
			</div>
		</section>
		<!-- End Contact Page Section -->

		<!-- Map Section -->
		<section class="contact-map-section">
			<div class="auto-container">
				<!-- Map Boxed -->
				<div class="map-boxed">
					<!--Map Outer-->
					<div class="map-outer">
						<iframe
							src="{{ $settings['map_link'] }}"
							allowfullscreen=""></iframe>
					</div>
				</div>
			</div>
		</section>
		<!-- End Map Section -->
@endsection
@section('scripts')
    <script src="{{ asset('assets/frontend/js/enqSubmit.js') }}"></script>
@endsection