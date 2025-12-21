$(function () {
    $("#generalSettingForm").validate({
        errorClass: "text-danger",
        rules: {
            site_phone: { required: true },
            site_email: { required: true, email: true },
            site_ofc_time: { required: true },
            site_facebook: { url: true },
            site_twitter: { url: true },
            site_linkedin: { url: true },
            site_gplus: { url: true }
        },
        submitHandler: function (form, event) {
            let btnLoader = $(form).find('button[type="submit"]');
            event.preventDefault();
            startButtonLoader(btnLoader);
            const formData = new FormData(form);
            $.ajax({
                url: appconfig.apibaseurl + "/settings/save",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("authToken"),
                },
                success: function (response) {
                    stopButtonLoader(btnLoader);
                    if (response.success) {
                        toastr.success(response.message);
                    } else {
                        if (response.data && response.data.length > 0) {
                            $.each(response.data, (k, v) => {
                                $(`.${k}_err`).html(v[0] ?? "");
                            });
                        }
                        toastr.error(response.message);
                    }
                },
                error: function (xhr) {
                    stopButtonLoader(btnLoader);
                    if (xhr.responseJSON && xhr.responseJSON.data) {
                        $.each(xhr.responseJSON.data, (k, v) => {
                            $(`.${k}_err`).html(v[0] ?? "");
                        });
                        toastr.error(xhr.responseJSON.message);
                    } else {
                        toastr.error("An error occurred.");
                    }
                },
            });
        },
    });
    
    makeJsonApiCall(
        appconfig.apibaseurl + "/settings/general",
        "GET",
        null,
        true,
        function (res) {
            if (res && res.data) {
                const data = res.data;
                $.each(data, function(index, el) {
                    console.log(el.key)
                    $("#" + el.key).val(el.value);
                });
            }
        },
        function (err) {
            toastr.error("Failed to load general settings.");
        },
        false
    );
});