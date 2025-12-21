$(document).ready(function () {
    const categoryId = $(`#categoryId`).val();
    $("#serviceCategoryForm").validate({
        errorClass: "text-danger",
        rules: {
              title: {
    required: true,
    maxlength: 30
},
            description: { required: true },
            image: { ...(categoryId ? {} : { required: true }) },
        },
        submitHandler: function (form) {
            let btnLoader = $(form).find('button[type="submit"]');
             startButtonLoader(btnLoader);
            let formData = new FormData(form);
            const url =
                categoryId > 0
                    ? `${appconfig.apibaseurl}/service-categories/${categoryId}`
                    : `${appconfig.apibaseurl}/service-categories`;
            makeFormApiCall(
                url,
                'POST',
                formData,
                true,
                function (res) {
                     stopButtonLoader(btnLoader);
                    toastr.success('Service category added successfully!');
                    setTimeout(() => {
                        window.location.href = appconfig.siteutl + "/admin/service-categories";
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

    $('#category_image').on('change', function () {
        const file = this.files[0];

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#preview-img').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        }
    });
     $('#cover_image').on('change', function () {
        const file = this.files[0];

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#preview-cover-img').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        }
    });


    if (categoryId > 0) {
        $.ajax({
            type: "GET",
            headers: {
                "Content-type": "application/json; charset=UTF-8",
                Authorization: "Bearer " + localStorage.getItem("authToken"),
            },
            url: appconfig.apibaseurl + `/service-categories/${categoryId}`,
            success: function (response) {
                if (response.success) {

                    $("#preview-img").attr("src", response.data.image_url).show();
                    $("#category_title").val(response.data.title);
                    $('#description').val(response.data.description)

                }
            },
            error: function (error) {
                console.log(error);
            },
        });
    }

    if ($("#service_categories").length > 0) {
        generateTable(
            "service_categories",
            "title",
            appconfig.apibaseurl + "/service-categories",
            ["id", "title","description" ,"image"],
            `<div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-cog" aria-hidden="true"></i>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item category_edit"  href="#"><i class="fas fa-edit"></i> Edit</a>
                <a class="dropdown-item category_delete"  href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
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

    $(document).on("click", ".category_edit", function () {
        editData($(this), appconfig.siteutl + "/admin/service-categories");
    });

    $(document).on("click", ".category_delete", function () {
        deleteData($(this), appconfig.apibaseurl + "/service-categories/");
    });
});