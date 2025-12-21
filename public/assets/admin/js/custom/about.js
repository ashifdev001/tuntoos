$(document).ready(function () {
    // Declare aboutId safely
    const aboutId = $('#aboutId').val() || 0;

    // Initialize Summernote on both descriptions
    $('#about_sort_description, #about_description').summernote({
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
    $('#about_image').on('change', function () {
        const file = this.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#preview-img').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        }
    });
    $('#about_home_image').on('change', function () {
        const file = this.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#about_home_image_preview').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        }
    });
    // Form Validation & Submit
    $("#aboutUsForm").validate({
        errorClass: "text-danger",
        rules: {
            title: { required: true },
            // about_sort_description: { required: true },
            image: { ...(aboutId ? {} : { required: true }) },
            about_description: { required: true }
        },
        submitHandler: function (form) {
            let btnLoader = $(form).find('button[type="submit"]');
            startButtonLoader(btnLoader);
            const formData = new FormData(form);

            // Set summernote content into FormData
            formData.set('about_sort_description', $('#about_sort_description').summernote('code'));
            formData.set('about_description', $('#about_description').summernote('code'));

            const url = appconfig.apibaseurl + "/settings/save";

            makeFormApiCall(
                url,
                'POST',
                formData,
                true,
                function (res) {
                    stopButtonLoader(btnLoader);
                    toastr.success('About Us content saved successfully!');
                    setTimeout(() => {
                        window.location.href = appconfig.siteutl + "/admin/about-us";
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
                        case "about_title":
                            $("#about_title").val(el.value);
                            break;
                        case "about_sort_description":
                            $("#about_sort_description").summernote('code', el.value);
                            break;
                        case "about_description":
                            $("#about_description").summernote('code', el.value);
                            break;
                        case "about_image_url":
                            $('#preview-img').attr('src', el.value).show();
                            break;
                        case "about_home_image_url":
                            $('#about_home_image_preview').attr('src', el.value).show();
                            break;
                        
                    }
                });
            }
        },
        function (err) {
            toastr.error("Failed to load About Us settings.");
        },
        false
    );
});
