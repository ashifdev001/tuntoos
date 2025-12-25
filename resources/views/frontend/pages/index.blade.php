@extends('frontend.layout')
@section('page_name')
    home
@endsection

@section('title')
    {{ env('APP_NAME') }}
@endsection

@section('content')

    <x-slider />
    <!-- Beverage Section -->
    <section class="beverage-section">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title centered">
                <!-- <div class="title">Best for You</div> -->
                <h2>Our Flavors</h2>
                <div class="separate"></div>
            </div>
            <x-flavors :limit="4" />
            <div class="button-box text-center">
                <a href="{{ route(name: 'flavor') }}" class="theme-btn btn-style-two clearfix"><span
                        class="icon"></span>View All
                    Flavors</a>
            </div>
        </div>
    </section>
    <!-- End Beverage Section -->
    <x-home-section />
    <!-- End Video Section Two -->
    <!-- Testimonial Section -->
    <x-testimonial />
    <!-- End Testimonial Section -->
    <!-- start Form section -->
    <section class="fluid-section-one">
        <div class="outer-container clearfix">

            <!-- Content Column -->
            <div class="content-column">
                <!-- <div class="icon-box" style="background-image:url(images/icons/icon-4.png)"></div> -->
                <div class="inner-column">
                    <!-- Sec Title -->
                    <div class="sec-title">
                        <h2>Contact Us </h2>
                        <div class="text">Fill in your details and we'll get back to you with franchise
                            opportunities</div>
                        <div class="comment-form">
                            <!-- Contact Form -->
                            <form method="post" action="" id="contact-form">
                                <div class="row clearfix">

                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                        <input type="text" name="name" placeholder="Your Name" required="">
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                        <input type="text" name="phone" placeholder="Your Phone Number" required="">
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                        <input type="email" name="email" placeholder="Your Email" required="">
                                    </div>
                                    <div class="form-group contact-dropdown col-lg-6 col-md-6 col-sm-12">
                                        <select id="enquiry-type" name="enq_for" class="dropdown-input">
                                            <option value="">Select Occupation</option>
                                            @forelse ($dropdownItems as $item)
                                                <option value="{{ $item->title }}">{{ $item->title }}</option>
                                            @empty
                                                <option value="">No options available</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                        <select class="form-control state-dropdown" name="state">
                                            <option value="">Select State</option>
                                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                            <option value="Assam">Assam</option>
                                            <option value="Bihar">Bihar</option>
                                            <option value="Chhattisgarh">Chhattisgarh</option>
                                            <option value="Goa">Goa</option>
                                            <option value="Gujarat">Gujarat</option>
                                            <option value="Haryana">Haryana</option>
                                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                                            <option value="Jharkhand">Jharkhand</option>
                                            <option value="Karnataka">Karnataka</option>
                                            <option value="Kerala">Kerala</option>
                                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                                            <option value="Maharashtra">Maharashtra</option>
                                            <option value="Manipur">Manipur</option>
                                            <option value="Meghalaya">Meghalaya</option>
                                            <option value="Mizoram">Mizoram</option>
                                            <option value="Nagaland">Nagaland</option>
                                            <option value="Odisha">Odisha</option>
                                            <option value="Punjab">Punjab</option>
                                            <option value="Rajasthan">Rajasthan</option>
                                            <option value="Sikkim">Sikkim</option>
                                            <option value="Tamil Nadu">Tamil Nadu</option>
                                            <option value="Telangana">Telangana</option>
                                            <option value="Tripura">Tripura</option>
                                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                                            <option value="Uttarakhand">Uttarakhand</option>
                                            <option value="West Bengal">West Bengal</option>
                                            <option value="Andaman & Nicobar Islands">Andaman & Nicobar Islands
                                            </option>
                                            <option value="Chandigarh">Chandigarh</option>
                                            <option value="Dadra & Nagar Haveli">Dadra & Nagar Haveli</option>
                                            <option value="Daman & Diu">Daman & Diu</option>
                                            <option value="Delhi">Delhi</option>
                                            <option value="Jammu & Kashmir">Jammu & Kashmir</option>
                                            <option value="Ladakh">Ladakh</option>
                                            <option value="Lakshadweep">Lakshadweep</option>
                                            <option value="Puducherry">Puducherry</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                        <input type="text" name="city" placeholder="City" />
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <input type="text" name="subject" placeholder="Subject" required="">
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <textarea name="message" placeholder="Your Comment"></textarea>
                                    </div>

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="check-box">
                                            <input type="checkbox" name="shipping-option" id="account-option"> &ensp; <label
                                                for="account-option">Save my
                                                name, email, phone number, in this website.</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <button type="submit" class="theme-btn btn-style-one clearfix"><span
                                                class="icon"></span>Submit Now</button>
                                    </div>

                                </div>
                            </form>
                            <!-- Contact Form -->
                        </div>
                    </div>

                </div>
            </div>

            <!-- Image Column -->
            <div class="image-column"
                style="background-image:url({{ asset('assets/frontend/images/imagebackground/ba1.jpg') }})">
                <figure class="image-box"><img src="{{ asset('assets/frontend/images/imagebackground/ba1.jpg') }}" alt="">
                </figure>
            </div>

        </div>
    </section>
    <!-- End Form section -->

    <!-- Gallery Section -->
    <x-home-service-gallery />
    <!-- End Gallery Section -->
    <!-- Clent Section Start -->
    <x-brand />
@endsection
@section('scripts')
    <script>
        if ($('#contact-form').length) {
            $('#contact-form').validate({
                rules: {
                    name: { required: true },
                    phone: { required: true },
                    subject: { required: true },
                    email: {
                        required: true,
                        email: true
                    },
                    "shipping-option": {
                        required: true
                    }
                },

                errorPlacement: function (error, element) {
                    if (element.attr("type") === "checkbox") {
                        error.insertAfter(element.closest('.check-box'));
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function (form) {
                    const $form = $(form);

                    $.ajax({
                        type: 'POST',
                        url: appconfig.apibaseurl + '/enquiries',
                        data: $form.serialize(),
                        dataType: 'json',
                        beforeSend: function () {
                            $form.find('button[type="submit"]')
                                .prop('disabled', true)
                                .text('Sending...');
                        },
                        success: function () {
                            $form[0].reset();
                            window.location.href = appconfig.siteutl + '/thank-you';
                        },
                        error: function (xhr) {
                            alert("Something went wrong. Please try again.");
                            console.error(xhr.responseText);
                        },
                        complete: function () {
                            $form.find('button[type="submit"]')
                                .prop('disabled', false)
                                .text('Submit');
                        }
                    });
                }
            });
        }
    </script>
@endsection