$(document).ready(function () {
    // Declare aboutId safely
    const aboutId = $('#aboutId').val() || 0;

    // Initialize Summernote on both descriptions
    $('#distributor_description, #distributor_more_content').summernote({
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

    // Image preview on file input
    $('#distributor_image').on('change', function () {
        const file = this.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#preview-img').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        }
    });
   
    // Form Validation & Submit
    $("#aboutUsForm").validate({
        errorClass: "text-danger",
        rules: {
            title: { required: true },
            image: { ...(aboutId ? {} : { required: true }) },
            about_description: { required: true }
        },
        submitHandler: function (form) {
            let btnLoader = $(form).find('button[type="submit"]');
            startButtonLoader(btnLoader);
            const formData = new FormData(form);

            // Set summernote content into FormData
            formData.set('distributor_description', $('#distributor_description').summernote('code'));
            formData.set('distributor_more_content', $('#distributor_more_content').summernote('code'));

            const url = appconfig.apibaseurl + "/settings/save";

            makeFormApiCall(
                url,
                'POST',
                formData,
                true,
                function (res) {
                    stopButtonLoader(btnLoader);
                    toastr.success('Distributor content saved successfully!');
                    setTimeout(() => {
                        window.location.href = appconfig.siteutl + "/admin/manage-distributor";
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

    // Load About Us content from settings
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
                        case "distributor_description":
                            $("#distributor_description").summernote('code', el.value);
                            break;
                        case "distributor_more_content":
                            $("#distributor_more_content").summernote('code', el.value);
                            break;
                        case "distributor_image_url":
                            $('#preview-img').attr('src', el.value).show();
                            break;
                        
                    }
                });
            }
        },
        function (err) {
            toastr.error("Failed to load distributor settings.");
        },
        false
    );
});
