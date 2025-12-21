<header class="main-header header-style-three">
    <!-- Header Upper -->
    <div class="header-upper">
        <div class="auto-container clearfix">

            <div class="pull-left logo-box">
                <div class="logo"><a href="/"><img src="{{ asset('assets/frontend/images/logo-removebg-preview.png') }}" alt="" title=""></a>
                </div>
            </div>

            <div class="pull-right">

                <!-- Search Box -->
                <div class="search-box">
                    <form method="post" action="#">
                        <div class="form-group">
                            <input type="button" class="apply-franchise-btn open-modal-btn" name=""
                                value="Apply For Franchise">
                            <!--<button type="submit"><span class="icon flaticon-email"></span></button>-->
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
    <!--End Header Upper-->

    <!-- Header Upper -->
    <div class="header-lower">
        <div class="auto-container clearfix">
            <div class="nav-outer clearfix">
                <!--Mobile Navigation Toggler-->
                <div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
                <!-- Main Menu -->
                <nav class="main-menu navbar-expand-md">
                    <div class="navbar-header">
                        <!-- Toggle Button -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                        <ul class="navigation clearfix">
                            <li class=""><a href="{{ url('/') }}">Home</a></li>
                            <li class=""><a href="{{ url('franchise') }}">Franchise</a></li>
                            <li class=""><a href="{{ url('distributor') }}">Distributor</a></li>
                            <li class=""><a href="{{ url('flavor') }}">Our Flavor</a></li>
                            <li class="dropdown"><a href="#">About</a>
                                <ul>
                                    <li><a href="{{ url('about') }}">About Us</a></li>
                                    <li><a href="{{ url('about#team') }}">Team</a></li>
                                </ul>
                            </li>

                            <li class="dropdown"><a href="">Media</a>
                                <ul>
                                    <li><a href="{{ url('gallery') }}">Gallery</a></li>
                                    <li><a href="{{ url('video') }}">Video</a></li>
                                </ul>
                            </li>
                            <!-- <li class=""><a href="">Blog</a></li> -->
                            <li><a href="{{ url('contact') }}">Contact us</a></li>
                        </ul>
                    </div>
                </nav>

                <!-- Main Menu End-->
                <div class="outer-box clearfix">
                    <!-- Social Box -->
                    <ul class="social-box">
                        <li><a href="{{ $headerContent['site_facebook'] }}" class="fa fa-facebook-f"></a></li>
                        <li><a href="{{ $headerContent['site_instagram'] }}" class="fa fa-instagram"></a></li>
                        <li><a href="{{ $headerContent['site_twitter'] }}" class="fa fa-twitter"></a></li>
                        <li><a href="{{ $headerContent['site_linkedin'] }}" class="fa fa-linkedin"></a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <!-- End Header Lower -->

    <!-- Sticky Header  -->
    <div class="sticky-header">
        <div class="auto-container clearfix">
            <!--Logo-->
            <div class="logo pull-left">
                <a href="{{ url('/') }}" title=""><img src="{{ asset('assets/frontend/images/logo-small.png') }}" alt="" title=""></a>
            </div>
            <!--Right Col-->
            <div class="pull-right">
                <!-- Main Menu -->
                <nav class="main-menu">
                    <!--Keep This Empty / Menu will come through Javascript-->
                </nav>
                <!-- Main Menu End-->

                <!-- Main Menu End-->
                <div class="outer-box clearfix">

                    <!-- Search Btn -->
                    <!-- <div class="search-box-btn search-box-outer"><span class="icon fa fa-search"></span></div> -->

                    <!-- Nav Btn -->
                    <div class="nav-btn navSidebar-button"><span class="icon flaticon-menu-2"></span></div>

                </div>

            </div>
        </div>
    </div><!-- End Sticky Menu -->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><span class="icon flaticon-multiply"></span></div>

        <nav class="menu-box">
            <div class="nav-logo"><a href="{{ url('/') }}"><img src="{{ asset('assets/frontend/images/logo-2.png') }}" alt="" title=""></a></div>
            <div class="menu-outer">
                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
            </div>
        </nav>
    </div>
    <!-- End Mobile Menu -->

</header>