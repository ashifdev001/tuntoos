$(function () {
    const blogId = $(`#blogId`).val();
    $("#blogCreateForm").validate({
        errorClass: "text-danger",
        rules: {
           title: {
    required: true,
    maxlength: 30
},

            short_desc: {
                required: function () {
                    return $('#long_desc').summernote('isEmpty');
                },
            },
            long_desc: {
                required: function () {
                    return $('#long_desc').summernote('isEmpty');
                },
            },
            content: {
                required: function () {
                    return $('#content').summernote('isEmpty');
                },
            },
        },
        
        errorPlacement: function (error, element) {
            if (element.hasClass("summernote")) {
                error.insertAfter(element.siblings('.note-editor'));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form, event) {
            let btnLoader = $(this);
            event.preventDefault();
            startButtonLoader(btnLoader);
            const shortDesc = $('#short_desc').summernote('code');
            const longDesc = $('#long_desc').summernote('code');
            const content = $('#content').summernote('code');
            const formData = new FormData(form);
            formData.set('short_desc', shortDesc);
            formData.set('long_desc', longDesc);
            formData.set('contenttxt', content);
            const url =
                blogId > 0
                    ? `${appconfig.apibaseurl}/blogs/${blogId}`
                    : `${appconfig.apibaseurl}/blogs`;
            makeFormApiCall(
                url,
                "POST",
                formData,
                true,
                (response) => {
                    stopButtonLoader(btnLoader);
                    if (response.success) {
                        toastr.success(response.message);
                        setTimeout(() => {
                           window.location.href = `${appconfig.siteutl}/admin/blogs`;
                        }, 1500);
                    } else {
                        console.log(response.message);
                        if (response.data.length > 0) {
                            $.each(response.data, (k, v) => {
                                $(`.${k}_err`).html(v[0] ?? "");
                            });
                        }
                        toastr.error(response.message);
                    }
                },
                (error) => {
                    stopButtonLoader(btnLoader);
                    $.each(error.data, (k, v) => {
                        $(`.${k}_err`).html(v[0] ?? "");
                    });
                    toastr.error(error.message);
                }
            );
        },
    });

    console.log(blogId);
    if (blogId > 0) {
        $.ajax({
            type: "GET",
            headers: {
                "Content-type": "application/json; charset=UTF-8",
                Authorization: "Bearer " + localStorage.getItem("authToken"),
            },
            url: appconfig.apibaseurl + `/blogs/${blogId}`,
            success: function (response) {
                if (response.success) {

                    $(".viewCvrImg").html(
                        `<img src="${response.data.coverImageUrl}" class="img-thumbnail img-size" />`
                    );
                    $(".viewImg").html(
                        `<img src="${response.data.imageUrl}" class="img-thumbnail img-size" />`
                    );
                    $("#title").val(response.data.title);
                    $("#meta_title").val(response.data.meta_title);
                    $("#meta_description").val(response.data.meta_description);
                    $('#short_desc').summernote('code', response.data.short_desc);
                    $('#long_desc').summernote('code', response.data.long_desc);
                    $('#content').summernote('code', response.data.content);
                }
            },
            error: function (error) {
                console.log(error);
            },
        });
    }

    $('#cover_image').on('change', function () {
        const file = this.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $(".viewCvrImg").html(
                    `<img src="${e.target.result}" class="img-thumbnail img-size" />`
                );
            };
            reader.readAsDataURL(file);
        }
    });
    $('#image').on('change', function () {
        const file = this.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $(".viewImg").html(
                    `<img src="${e.target.result}" class="img-thumbnail img-size" />`
                );
            };
            reader.readAsDataURL(file);
        }
    });

    if ($("#blogs").length > 0) {
        generateTable(
            "blogs",
            "title",
            appconfig.apibaseurl + "/blogs",
            ["id", "title", "cover_image", "short_desc", "created_at"],
            `<div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-cog" aria-hidden="true"></i>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item blog_edit"  href="#"><i class="fas fa-edit"></i> Edit</a>
                <a class="dropdown-item blog_delete"  href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
            </div>
        </div>`,
            (data) => {
                return {
                    ...data,
                    cover_image: `<img src="${data.coverImageUrl}" class="img-thumbnail img-size" />`,
                };
            }
        );
    }

    $(document).on("click", ".blog_edit", function () {
        editData($(this), appconfig.siteutl + "/admin/blog");
    });

    $(document).on("click", ".blog_delete", function () {
        deleteData($(this), appconfig.apibaseurl + "/blogs/");
    });
});
