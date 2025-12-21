 <ul class="mob-action nav1 nav-fill d-sm-block d-lg-none">
    <li class="nav-item enqModal">
        <a href="https://wa.me/+{{$mobileNav['site_phone'] }}?text=Hi,%20I%20want%20to%20know%20more%20about%20Luvleen%20Services">
            <img src="{{asset('/assets/frontend')}}/img/whatsapp.svg" width="16" height="16"
                alt="Contact us on whatsapp">&nbsp;&nbsp;WhatsApp
        </a>
    </li>
    <li class="nav-item enqModal">
        <a href="tel:+{{$mobileNav['site_phone'] }}">
            <img src="{{asset('/assets/frontend')}}/img/telephone.png" width="16" height="16"
                alt="Contact us on Call">&nbsp;&nbsp;Call
        </a>
    </li>
    <li class="nav-item enqModal">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal">
            <img src="{{asset('/assets/frontend')}}/img/envelope.svg" width="16" height="16"
                alt="Enquire">&nbsp;&nbsp;Enquire
        </a>
    </li>
</ul>