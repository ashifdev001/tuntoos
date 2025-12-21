$(document).ready(function () {
    const bannerId = $(`#bannerId`).val();
    $("#bannerForm").validate({
        errorClass: "text-danger",
        rules: {
            type: { required: true },
            title: { required: false },
            //subtitle: { required: true },
            image: { ...(bannerId ? {} : { required: true }) },
            // btn_txt: { required: true },
            
            status: { required: true }
        },
        submitHandler: function (form) {
            let btnLoader = $(form).find('button[type="submit"]');
             startButtonLoader(btnLoader);
            let formData = new FormData(form);
            const url =
                bannerId > 0
                    ? `${appconfig.apibaseurl}/banners/${bannerId}`
                    : `${appconfig.apibaseurl}/banners`;
            makeFormApiCall(
                url,
                'POST',
                formData,
                true,
                function (res) {
                     stopButtonLoader(btnLoader);
                    toastr.success('Banner saved successfully!');
                    setTimeout(() => {
                        window.location.href = appconfig.siteutl + "/admin/banners";
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

    $('#banner_image').on('change', function () {
        const file = this.files[0];

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#preview-img').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        }
    });

    if (bannerId > 0) {
        $.ajax({
            type: "GET",
            headers: {
                "Content-type": "application/json; charset=UTF-8",
                Authorization: "Bearer " + localStorage.getItem("authToken"),
            },
            url: appconfig.apibaseurl + `/banners/${bannerId}`,
            success: function (response) {
                if (response.success) {
                    $("#preview-img").attr("src", response.data.image_url).show();
                    $("#banner_type").val(response.data.type);
                    $("#banner_title").val(response.data.title);
                    $("#banner_subtitle").val(response.data.subtitle);
                    $("#banner_btn_txt").val(response.data.btn_txt);
                    $("#banner_link").val(response.data.link);
                    $("#banner_status").val(response.data.status);
                }
            },
            error: function (error) {
                console.log(error);
            },
        });
    }

    if ($("#banners").length > 0) {
        generateTable(
            "banners",
            "title",
            appconfig.apibaseurl + "/banners",
            ["id", "type", "title", "subtitle", "image", "btn_txt", "link", "status"],
            `<div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-cog" aria-hidden="true"></i>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item banner_edit"  href="#"><i class="fas fa-edit"></i> Edit</a>
                <a class="dropdown-item banner_delete"  href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
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

    $(document).on("click", ".banner_edit", function () {
        editData($(this), appconfig.siteutl + "/admin/banners");
    });

    $(document).on("click", ".banner_delete", function () {
        deleteData($(this), appconfig.apibaseurl + "/banners/");
    });
});