$(document).ready(function () {
    const testimonialId = $(`#testimonialId`).val();
    $("#testimonialForm").validate({
        errorClass: "text-danger",
        rules: {
            name: { required: true },
            location: { required: true },
            message: { required: true },
            image: { ...(testimonialId ? {} : { required: true }) }
        },
        submitHandler: function (form) {
            let btnLoader = $(form).find('button[type="submit"]');
             startButtonLoader(btnLoader);
            let formData = new FormData(form);
            const url =
                testimonialId > 0
                    ? `${appconfig.apibaseurl}/customer-say/${testimonialId}`
                    : `${appconfig.apibaseurl}/customer-say`;
            makeFormApiCall(
                url,
                'POST',
                formData,
                true,
                function (res) {
                     stopButtonLoader(btnLoader);
                    toastr.success('Testimonial saved successfully!');
                    setTimeout(() => {
                        window.location.href = appconfig.siteutl + "/admin/testimonials";
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

    $('#testimonial_image').on('change', function () {
        const file = this.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#preview-img').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        }
    });

    if (testimonialId > 0) {
        $.ajax({
            type: "GET",
            headers: {
                "Content-type": "application/json; charset=UTF-8",
                Authorization: "Bearer " + localStorage.getItem("authToken"),
            },
            url: appconfig.apibaseurl + `/customer-say/${testimonialId}`,
            success: function (response) {
                if (response.success) {
                    $("#preview-img").attr("src", response.data.image_url).show();
                    $("#testimonial_name").val(response.data.name);
                    $("#testimonial_location").val(response.data.location);
                    $("#testimonial_message").val(response.data.message);
                }
            },
            error: function (error) {
                console.log(error);
            },
        });
    }

    if ($("#testimonials").length > 0) {
        generateTable(
            "testimonials",
            "name",
            appconfig.apibaseurl + "/customer-say",
            ["id", "name", "location", "message", "image"],
            `<div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item testimonial_edit"  href="#"><i class="fas fa-edit"></i> Edit</a>
                    <a class="dropdown-item testimonial_delete"  href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                </div>
            </div>`,
            (data) => {
                return {
                    ...data,
                    image: `<img src="${data.image_url}" class="img-thumbnail img-size" style="width:100px; height:100px; object-fit:cover;" />`,
                };
            }
        );
    }

    $(document).on("click", ".testimonial_edit", function () {
        editData($(this), appconfig.siteutl + "/admin/testimonials");
    });

    $(document).on("click", ".testimonial_delete", function () {
        deleteData($(this), appconfig.apibaseurl + "/customer-say/");
    });
});