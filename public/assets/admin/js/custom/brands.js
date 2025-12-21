$(document).ready(function () {
    const flavorId = $(`#flavorId`).val();

    $("#flavorCreateForm").validate({
        errorClass: "text-danger",
        rules: {
            title: { required: true },
            image: { ...(flavorId ? {} : { required: true }) },
        },

        submitHandler: function (form) {
            let btnLoader = $(form).find('button[type="submit"]');
            startButtonLoader(btnLoader);

            let formData = new FormData(form);

            const url =
                flavorId > 0
                    ? `${appconfig.apibaseurl}/flavors/${flavorId}`
                    : `${appconfig.apibaseurl}/flavors`;

            makeFormApiCall(
                url,
                "POST",
                formData,
                true,
                function (res) {
                    stopButtonLoader(btnLoader);
                    toastr.success("Flavor saved successfully!");

                    setTimeout(() => {
                        window.location.href =
                            appconfig.siteutl + "/admin/flavors";
                    }, 1000);
                },
                function (err) {
                    stopButtonLoader(btnLoader);
                    toastr.error(
                        "Error: " + (err.message || "Something went wrong.")
                    );
                },
                false
            );
        },
    });

    /* Image preview */
    $("#image").on("change", function () {
        const file = this.files[0];

        if (file && file.type.startsWith("image/")) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $(".viewImg").html(
                    `<img src="${e.target.result}" class="img-thumbnail" style="width:100px;height:100px;object-fit:cover;" />`
                );
            };
            reader.readAsDataURL(file);
        }
    });

    /* Edit page data load */
    if (flavorId > 0) {
        $.ajax({
            type: "GET",
            headers: {
                "Content-type": "application/json; charset=UTF-8",
                Authorization: "Bearer " + localStorage.getItem("authToken"),
            },
            url: appconfig.apibaseurl + `/flavors/${flavorId}`,
            success: function (response) {
                if (response.success) {
                    $("#title").val(response.data.title);
                    $("#description").val(response.data.description);

                    if (response.data.image_url) {
                        $(".viewImg").html(
                            `<img src="${response.data.image_url}" class="img-thumbnail" style="width:100px;height:100px;object-fit:cover;" />`
                        );
                    }
                }
            },
            error: function (error) {
                console.log(error);
            },
        });
    }

    /* Listing page (DataTable) */
    if ($("#flavors").length > 0) {
        generateTable(
            "flavors",
            "title",
            appconfig.apibaseurl + "/flavors",
            ["id", "title", "image", "description"],
            `<div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item flavor_edit" href="#">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a class="dropdown-item flavor_delete" href="#">
                        <i class="fa fa-trash"></i> Delete
                    </a>
                </div>
            </div>`,
            (data) => {
                return {
                    ...data,
                    image: data.image_url
                        ? `<img src="${data.image_url}" class="img-thumbnail img-size" style="width:100px;height:100px;object-fit:cover;" />`
                        : "",
                };
            }
        );
    }

    $(document).on("click", ".flavor_edit", function () {
        editData($(this), appconfig.siteutl + "/admin/flavors");
    });

    $(document).on("click", ".flavor_delete", function () {
        deleteData($(this), appconfig.apibaseurl + "/flavors/");
    });
});
