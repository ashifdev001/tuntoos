<footer class="main-footer">
    <div class="pattern-layer-three" style="background-image: url({{ asset('assets/frontend/images/background/pattern-6.png')}})"></div>
    <div class="auto-container">
        <!-- Widgets Section -->
        <div class="widgets-section">
            <div class="row clearfix">

                <!-- Big Column -->
                <div class="big-column col-lg-6 col-md-12 col-sm-12">
                    <div class="row clearfix">

                        <!--Footer Column-->
                        <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                            <div class="footer-widget contact-widget">
                                <h6>Contact Us</h6>
                                <div class="text">{{ $footerContent['contact_address'] }}</div>
                                <ul class="contact-list">
                                    <li><span class="icon fa fa-send"></span>{{ $footerContent['site_email'] }}</li>
                                    <li><span class="icon fa fa-phone"></span><a href="tel:{{ $footerContent['site_phone'] }}">{{ $footerContent['site_phone'] }}</a></li>
                                </ul>
                            </div>
                        </div>

                        <!--Footer Column-->
                        <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                <h6>Useful Links</h6>
                                <ul class="footer-list">
                                    <li><a href="{{ url('/') }}">Home</a></li>
                                    <li><a href="{{ url('about') }}">About us</a></li>
                                    <li><a href="{{ url('franchise') }}">franchise</a></li>
                                    <li><a href="{{ url('terms') }}">Terms Of Service</a></li>
                                    <li><a href="{{ url('privacy') }}">Privacy Policy</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Big Column -->
                <div class="big-column col-lg-6 col-md-12 col-sm-12">
                    <div class="row clearfix">

                        <!--Footer Column-->
                        <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                            <div class="footer-widget social-widget">
                                <h6>Follow Us Now</h6>
                                <ul class="social-list">
                                    <li><a href="{{ $footerContent['site_facebook'] }}"><span class="icon fa fa-facebook"></span>facebook</a></li>
                                    <li><a href="{{ $footerContent['site_twitter'] }}"><span class="icon fa fa-twitter"></span>twitter</a></li>
                                    <li><a href="{{ $footerContent['site_linkedin'] }}"><span class="icon fa fa-linkedin"></span>LinkedIn</a></li>
                                    <li><a href="{{ $footerContent['site_instagram'] }}"><span class="icon fa fa-instagram"></span>Instagram</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Footer Column -->
                        <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                            <div class="footer-widget newsletter-widget">
                                <h6>Get Email</h6>
                                <div class="newsletter-form">
                                    <form method="post" action="#">
                                        <div class="form-group">
                                            <input type="email" name="email" value="" placeholder="Your Email"
                                                required="">
                                            <button type="submit" class="theme-btn submit-btn">Submit
                                                Now</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div class="footer-bottom">
            <div class="copyright">&copy; 2025 Fantoos All Rights Reserved.</div>
        </div>
    </div>
</footer>