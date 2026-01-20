<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.inc.head')
    <style>
        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
        html, body {
    overflow-x: hidden !important;
}
    </style>
</head>

<body class="hidden-bar-wrapper">
    <div class="page-wrapper">
        <x-header />

        <!-- Content -->
        @yield('content')
        <x-footer />
    </div>
    <!--Model Form Start-->
    <x-enquiry-modal />

    <!--Model Form End-->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><span class="icon flaticon-multiply"></span></div>

        <nav class="menu-box">
            <div class="nav-logo"><a href="/"><img src="{{ asset('assets/frontend/images/logo-removebg-preview.png')}}"
                        alt="" title=""></a>
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
            <form action="#" id="">
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
    <x-mobile-nav />


    @include('frontend.inc.scripts')
    @yield('scripts')
    <script>
        if ($('#modal-form').length) {
            $('#modal-form').validate({
                rules: {
                    name: {
                        required: true
                    },
                    phone: {
                        required: true
                    },
                    subject: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
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
                        success: function (response) {
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
        $('#footer-news-latter,#hero-news-latter,#deal-news-latter').submit(function (e) {
            e.preventDefault();
            let form = $(this);
            $.ajax({
                type: 'POST',
                url: "{{ url('api/enquiries') }}",
                data: form.serialize(),
                dataType: 'json',
                beforeSend: function () {
                    form.find('button[type="submit"]')
                        .prop('disabled', true)
                        .text('Sending...');
                },
                success: function () {
                    form[0].reset();
                    window.location.href = appconfig.siteutl + '/thank-you';
                },
                error: function (xhr) {
                    alert("Something went wrong. Please try again.");
                    console.error(xhr.responseText);
                },
                complete: function () {
                    form.find('button[type="submit"]')
                        .prop('disabled', false)
                        .text('Submit');
                }
            });

        });
        $('.open-popup').on('click', function () {
            const data = {
                'franchise': 'Enquiry Form For Franchise',
                'distributor': 'Enquiry Form For Distributor',
                'general-enq': 'General Enquiry Form'
            };
            $('.modal-title').text(data[$(this).data('attr')]);
            $('#enquiryModal').show();
        })
    </script>
</body>

</html>