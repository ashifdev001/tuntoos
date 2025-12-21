<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.inc.head')

</head>

<body class="hidden-bar-wrapper">
    <div class="page-wrapper">
        <x-header />

        <!-- Content -->
        @yield('content')
        <x-footer />
    </div>
    <!--Model Form Start-->
    <div id="enquiryModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <!-- ADD THIS HERE -->
            <h5 class="modal-title">Enquiry Form For Franchise</h5>
            <!--<p class="modal-description">Fill the form below & we will contact you shortly.</p>-->
            <!-- END ADDED PART -->

            <form class="modal-form">

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Name" required>
                </div>

                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Phone" required>
                </div>

                <div class="form-group">
                    <select class="modal-content form-control state-dropdown" required>
                        <option value="">Select occupation</option>
                        <option>Service</option>
                        <option>Dealership</option>
                        <option>Trading</option>
                        <option>Manufacturing</option>
                        <option>Others</option>
                        <!-- Add others if needed -->
                    </select>
                </div>

                <div class="form-group">
                    <select class="modal-content form-control" required>
                        <option value="">Select State</option>
                        <option>Andhra Pradesh</option>
                        <option>Assam</option>
                        <option>Bihar</option>
                        <option>Gujarat</option>
                        <option>Maharashtra</option>
                        <option>Tamil Nadu</option>
                        <option>Uttar Pradesh</option>
                        <option>West Bengal</option>
                        <!-- Add others if needed -->
                    </select>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="City" required>
                </div>

                <div class="form-group">
                    <textarea class="form-control" placeholder="Message" rows="3" required></textarea>
                </div>

                <button type="submit" class="modal-submit-btn">Submit</button>

            </form>
        </div>
    </div>

    <!--Model Form End-->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><span class="icon flaticon-multiply"></span></div>

        <nav class="menu-box">
            <div class="nav-logo"><a href="index.html"><img src="{{ asset('assets/frontend/images/logo-removebg-preview.png')}}" alt="" title=""></a>
            </div>
            <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
            </div>
        </nav>
    </div>
    <!-- End Mobile Menu -->
    <div class="search-popup">
        <div class="search-popup__overlay search-toggler"></div>
        <!-- /.search-popup__overlay -->
        <div class="search-popup__content">
            <form action="#">
                <label for="search" class="sr-only">search here</label><!-- /.sr-only -->
                <input type="text" id="search" placeholder="Search Here...">
                <button type="submit" aria-label="search submit" class="thm-btn">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        <!-- /.search-popup__content -->
    </div>
    <!-- /.search-popup -->
    {{-- <x-mobile-nav /> --}}


    @include('frontend.inc.scripts')
    @yield('scripts')
</body>

</html>