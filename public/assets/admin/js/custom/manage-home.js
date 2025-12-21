$(document).ready(function () {

    /* ===============================
       IMAGE PREVIEWS
    =============================== */

    function previewImage(input, previewId) {
        const file = input.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $(previewId).attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        }
    }

    $('input[name="rf_image_1"]').on('change', function () {
        previewImage(this, '#rf_image_1_preview');
    });

    $('input[name="rf_image_2"]').on('change', function () {
        previewImage(this, '#rf_image_2_preview');
    });

    $('input[name="rf_image_3"]').on('change', function () {
        previewImage(this, '#rf_image_3_preview');
    });

    $('input[name="rf_site_image"]').on('change', function () {
        previewImage(this, '#rf_site_image_preview');
    });

    $('input[name="dp_image"]').on('change', function () {
        previewImage(this, '#dp_image_preview');
    });

    $('input[name="vd_image"]').on('change', function () {
        previewImage(this, '#vd_image_preview');
    });


    /* ===============================
       VIDEO TYPE TOGGLE
    =============================== */

    function toggleVideoFields(type) {
        if (type === 'upload') {
            $('input[name="vd_video_url"]').closest('.form-group').hide();
            $('input[name="vd_video_file"]').closest('.form-group').show();
        } else {
            $('input[name="vd_video_url"]').closest('.form-group').show();
            $('input[name="vd_video_file"]').closest('.form-group').hide();
        }
    }

    toggleVideoFields($('select[name="vd_video_type"]').val());

    $('select[name="vd_video_type"]').on('change', function () {
        toggleVideoFields(this.value);
    });


    /* ===============================
       FORM SUBMIT (HOLD PAGE)
    =============================== */

    $('#manage-home-form').on('submit', function (e) {
        e.preventDefault(); // 🔒 HOLD THE PAGE

        let form = this;
        let formData = new FormData(form);
        let btnLoader = $(form).find('button[type="submit"]');

        startButtonLoader(btnLoader);

        const url = appconfig.apibaseurl + "/settings/save";

        makeFormApiCall(
            url,
            'POST',
            formData,
            true,
            function (res) {
                stopButtonLoader(btnLoader);
                toastr.success('Home page content saved successfully!');
            },
            function (err) {
                stopButtonLoader(btnLoader);
                toastr.error('Error: ' + (err.message || 'Something went wrong.'));
            },
            false
        );
    });


    /* ===============================
       LOAD EXISTING SETTINGS
    =============================== */

    makeJsonApiCall(
        appconfig.apibaseurl + "/settings/general",
        "GET",
        null,
        true,
        function (res) {
            if (res && res.data) {
                $.each(res.data, function (index, el) {
                    switch (el.key) {

                        /* Refreshing Flavors */
                        case "rf_heading":
                            $('input[name="rf_heading"]').val(el.value);
                            break;
                        case "rf_description":
                            $('textarea[name="rf_description"]').val(el.value);
                            break;
                        case "rf_image_1_url":
                            $('#rf_image_1_preview').attr('src', el.value).show();
                            break;
                        case "rf_image_2_url":
                            $('#rf_image_2_preview').attr('src', el.value).show();
                            break;
                        case "rf_image_3_url":
                            $('#rf_image_3_preview').attr('src', el.value).show();
                            break;
                        case "rf_site_image_url":
                            $('#rf_site_image_preview').attr('src', el.value).show();
                            break;

                        /* Demand Product */
                        case "dp_offer":
                            $('input[name="dp_offer"]').val(el.value);
                            break;
                        case "dp_title":
                            $('input[name="dp_title"]').val(el.value);
                            break;
                        case "dp_description":
                            $('textarea[name="dp_description"]').val(el.value);
                            break;
                        case "dp_get_in_text":
                            $('input[name="dp_get_in_text"]').val(el.value);
                            break;
                        case "dp_image_url":
                            $('#dp_image_preview').attr('src', el.value).show();
                            break;

                        /* Video Section */
                        case "vd_video_type":
                            $('select[name="vd_video_type"]').val(el.value);
                            toggleVideoFields(el.value);
                            break;
                        case "vd_video_url":
                            $('input[name="vd_video_url"]').val(el.value);
                            break;
                        case "vd_image_url":
                            $('#vd_image_preview').attr('src', el.value).show();
                            break;
                    }
                });
            }
        },
        function () {
            toastr.error("Failed to load home page settings.");
        },
        false
    );

});
