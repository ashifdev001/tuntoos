<script>
    let appconfig = {
        siteutl: "{{env('APP_URL')}}",
        apibaseurl: "{{env('API_URL')}}",
        siteStorage: "{{ asset('assets/frontend') }}"
    };
</script>
<script>
    const modal = document.getElementById("enquiryModal");
    const openBtn = document.querySelector(".open-modal-btn");
    const closeBtn = document.querySelector(".close-modal");

    if (openBtn) {
        openBtn.onclick = () => modal.style.display = "block";
    }
    if (closeBtn) {
        closeBtn.onclick = () => modal.style.display = "none";
    }

    if (modal) {
        window.onclick = (e) => {
            if (e.target == modal) {
                modal.style.display = "none";
            }
        }
    }
</script>
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-arrow-up"></span></div>
<script src="{{ asset('assets/frontend/js/jquery.js') }}"></script>
<script src="{{ asset('assets/frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('assets/frontend/js/appear.js') }}"></script>
<script src="{{ asset('assets/frontend/js/parallax.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/tilt.jquery.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.paroller.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/owl.js') }}"></script>
<script src="{{ asset('assets/frontend/js/wow.js') }}"></script>
<script src="{{ asset('assets/frontend/js/pagenav.js') }}"></script>
<script src="{{ asset('assets/frontend/js/validate.js') }}"></script>
<script src="{{ asset('assets/frontend/js/isotope.js') }}"></script>
<script src="{{ asset('assets/frontend/js/nav-tool.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/frontend/js/script.js') }}"></script>
<script src="{{ asset('assets/frontend/js/enqSubmit.js') }}"></script>
<script src="{{ asset('assets/frontend/js/appointments.js') }}"></script>