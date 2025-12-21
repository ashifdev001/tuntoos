$(document).ready(function () {
    // Form Validation & Submit
    $("#contactUsForm").validate({
        errorClass: "text-danger",
        rules: {
            contact_address: { required: true },
            contact_phone: { required: true },
            contact_email: { required: true }
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
                    toastr.success('Contact us content saved successfully!');
                    setTimeout(() => {
                        window.location.href = appconfig.siteutl + "/admin/manage-contact";
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
                        case "contact_address":
                            $("#contact_address").val(el.value);
                            break;
                        case "contact_email":
                            $("#contact_email").val(el.value);
                            break;
                        case "contact_phone":
                            $("#contact_phone").val(el.value);
                            break;
                            case "contact_open_hrs":
                            $("#contact_open_hrs").val(el.value);
                            break;
                        case "map_link":
                            $("#map_link").val(el.value);
                            break;
                    }
                });
            }
        },
        function (err) {
            toastr.error("Failed to load contact Us settings.");
        },
        false
    );

});