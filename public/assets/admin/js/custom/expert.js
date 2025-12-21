$(document).ready(function () {
    $('#expert_description').summernote({
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
    // Form Validation & Submit
    $("#meetExpertForm").validate({
        errorClass: "text-danger",
        rules: {
            expert_description: { required: true }
        },
        submitHandler: function (form) {
            let btnLoader = $(form).find('button[type="submit"]');
            startButtonLoader(btnLoader);
            const formData = new FormData(form);
            const url = appconfig.apibaseurl + "/settings/save";

            makeFormApiCall(
                url,
                'POST',
                formData,
                true,
                function (res) {
                    stopButtonLoader(btnLoader);
                    toastr.success('Expert content saved successfully!');
                    setTimeout(() => {
                        window.location.href = appconfig.siteutl + "/admin/manage-expert";
                    }, 1000);
                },
                function (err) {
                    stopButtonLoader(btnLoader);
                    toastr.error('Error: ' + (err.message || 'Something went wrong.'));
                },
                false
            );
        }
    });

    $('#expert_image').on('change', function () {
        const file = this.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#preview-img').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        }
    });

    // Load Contact us content from settings
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
                        case "expert_image_url":
                            $("#preview-img").attr('src',el.value).show();
                            break;
                        case "expert_description":
                            $("#expert_description").summernote('code',el.value);
                            break;
                    }
                });
            }
        },
        function (err) {
            toastr.error("Failed to load expert settings.");
        },
        false
    );

});