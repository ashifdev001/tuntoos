$(document).ready(function () {

    /* ================================
     * Summernote Editors
     * ================================ */
    $('#franchise_model, #funtoos_description, #funtoos_promise').summernote({
        height: 200,
        placeholder: 'Write content here...',
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['fontsize', 'strikethrough']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture']],
            ['view', ['codeview']]
        ]
    });

    /* ================================
     * Image Preview Handler (Reusable)
     * ================================ */
    function previewImage(input, previewClass) {
        const file = input.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('.' + previewClass)
                    .html(`<img src="${e.target.result}" class="img-fluid mt-2" style="max-height:150px;">`);
            };
            reader.readAsDataURL(file);
        }
    }

    $('#franchise_image').on('change', function () {
        previewImage(this, 'franchise_image_preview');
    });

    $('#funtoos_image').on('change', function () {
        previewImage(this, 'funtoos_image_preview');
    });

    $('#funtoos_image_1').on('change', function () {
        previewImage(this, 'funtoos_image_1_preview');
    });

    $('#funtoos_image_2').on('change', function () {
        previewImage(this, 'funtoos_image_2_preview');
    });

    /* ================================
     * Form Validation & Submit
     * ================================ */
    $('#updateHeading').validate({
        errorClass: 'text-danger',
        rules: {
            franchise_model: { required: true },
            funtoos_description: { required: true }
        },
        submitHandler: function (form) {

            let btnLoader = $(form).find('button[type="submit"]');
            startButtonLoader(btnLoader);

            let formData = new FormData(form);
            let url = appconfig.apibaseurl + "/settings/save";

            makeFormApiCall(
                url,
                'POST',
                formData,
                true,
                function () {
                    stopButtonLoader(btnLoader);
                    toastr.success('Franchise details saved successfully!');
                    setTimeout(() => {
                        window.location.href = appconfig.siteutl + '/admin/franchise';
                    }, 1000);
                },
                function (err) {
                    stopButtonLoader(btnLoader);
                    toastr.error(err?.message || 'Something went wrong.');
                },
                false
            );
        }
    });

    /* ================================
     * Fetch Existing Franchise Data
     * ================================ */
    makeJsonApiCall(
        appconfig.apibaseurl + "/settings/general",
        "GET",
        null,
        true,
        function (res) {
            if (res && res.data) {
                const data = res.data;

                $.each(data, function (index, el) {
                    switch (el.key) {

                        case "franchise_model":
                            $('#franchise_model').summernote('code', el.value);
                            break;

                        case "funtoos_description":
                            $('#funtoos_description').summernote('code', el.value);
                            break;

                        case "funtoos_promise":
                            $('#funtoos_promise').summernote('code', el.value);
                            break;

                        case "franchise_image_url":
                            $('.franchise_image_preview')
                                .html(`<img src="${el.value}" class="img-fluid" style="max-height:150px;">`);
                            break;

                        case "funtoos_image_url":
                            $('.funtoos_image_preview')
                                .html(`<img src="${el.value}" class="img-fluid" style="max-height:150px;">`);
                            break;

                        case "funtoos_image_1_url":
                            $('.funtoos_image_1_preview')
                                .html(`<img src="${el.value}" class="img-fluid" style="max-height:150px;">`);
                            break;

                        case "funtoos_image_2_url":
                            $('.funtoos_image_2_preview')
                                .html(`<img src="${el.value}" class="img-fluid" style="max-height:150px;">`);
                            break;

                        case "funtoos_promise_btn_text_1":
                            $('#funtoos_promise_btn_text_1').val(el.value);
                            break;

                        case "funtoos_promise_btn_bellow_text_1":
                            $('#funtoos_promise_btn_bellow_text_1').val(el.value);
                            break;

                        case "funtoos_promise_btn_text_2":
                            $('#funtoos_promise_btn_text_2').val(el.value);
                            break;
                        case "funtoos_promise_btn_bellow_text_2":
                            $('#funtoos_promise_btn_bellow_text_2').val(el.value);
                            break;
                    }
                });
            }
        },
        function () {
            toastr.error('Failed to load Franchise settings.');
        },
        false
    );

});
