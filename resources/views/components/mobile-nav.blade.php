<style>
    @media only screen and (max-width: 991px) {
        .mob-action {
            padding-left: 10px;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #000;
            color: #fff;
            box-shadow: 0 1px 6px 2px rgb(0 0 0 / 40%);
            z-index: 1030;
            margin-bottom: 0;
        }
        .mob-action .nav-item {
            padding: 10px 0;
            text-align: center;
            font-size: 14px;
            width: 32%;
            display: inline-flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }
    }

    @media (min-width: 992px) {
        .d-lg-none {
            display: none !important;
        }
    }
</style>
<ul class="mob-action nav1 nav-fill d-sm-block d-lg-none">
    <li class="nav-item enqModal">
        <a
            href="https://wa.me/+{{$mobileNav['site_phone'] }}?text=Hi,%20I%20want%20to%20know%20more%20about%20Luvleen%20Services">
            <img src="{{asset('/assets')}}/images/whatsapp.svg" width="16" height="16"
                alt="Contact us on whatsapp">&nbsp;&nbsp;WhatsApp
        </a>
    </li>
    <li class="nav-item enqModal">
        <a href="tel:+{{$mobileNav['site_phone'] }}">
            <img src="{{asset('/assets')}}/images/telephone.png" width="16" height="16"
                alt="Contact us on Call">&nbsp;&nbsp;Call
        </a>
    </li>
    <li class="nav-item open-popup" data-attr="general-enq">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal">
            <img src="{{asset('/assets')}}/images/envelope.svg" width="16" height="16" alt="Enquire">&nbsp;&nbsp;Enquire
        </a>
    </li>
</ul>