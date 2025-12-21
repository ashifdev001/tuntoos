$(document).ready(function () {
    const teamId = $(`#teamId`).val();

    /* Create / Update */
    $("#teamCreateForm").validate({
        errorClass: "text-danger",
        rules: {
            name: { required: true },
            position: { required: true },
            image: { ...(teamId ? {} : { required: true }) },
        },

        submitHandler: function (form) {
            let btnLoader = $(form).find('button[type="submit"]');
            startButtonLoader(btnLoader);

            let formData = new FormData(form);

            const url =
                teamId > 0
                    ? `${appconfig.apibaseurl}/teams/${teamId}`
                    : `${appconfig.apibaseurl}/teams`;

            makeFormApiCall(
                url,
                "POST",
                formData,
                true,
                function (res) {
                    stopButtonLoader(btnLoader);
                    toastr.success("Team member saved successfully!");

                    setTimeout(() => {
                        window.location.href =
                            appconfig.siteutl + "/admin/teams";
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
    if (teamId > 0) {
        $.ajax({
            type: "GET",
            headers: {
                "Content-type": "application/json; charset=UTF-8",
                Authorization: "Bearer " + localStorage.getItem("authToken"),
            },
            url: appconfig.apibaseurl + `/teams/${teamId}`,
            success: function (response) {
                if (response.success) {
                    $("#name").val(response.data.name);
                    $("#position").val(response.data.position);

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
    if ($("#teams").length > 0) {
        generateTable(
            "teams",
            "name",
            appconfig.apibaseurl + "/teams",
            ["id", "name", "image", "position"],
            `<div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item team_edit" href="#">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a class="dropdown-item team_delete" href="#">
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

    /* Actions */
    $(document).on("click", ".team_edit", function () {
        editData($(this), appconfig.siteutl + "/admin/teams");
    });

    $(document).on("click", ".team_delete", function () {
        deleteData($(this), appconfig.apibaseurl + "/teams/");
    });
});
