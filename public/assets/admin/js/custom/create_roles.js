$(document).ready(function () {
    $.ajax({
        type: "get",
        url: appconfig.apibaseurl + "/get-permissions",
        headers: {
            "Content-type": "application/json; charset=UTF-8",
            Authorization: "Bearer " + localStorage.getItem("authToken"),
        },
        dataType: "json",
        success: function (response) {
            html = "";
            $.map(response.data, function (elements, Key) {
                html += '<div class="col-sm-3">' + "<label>" + Key;
                ("</label>");
                $.map(elements, function (element, index) {
                    html +=
                        '<div class="form-group clearfix my-2">' +
                        '<div class="icheck-primary d-inline">' +
                        '<input name="permission_id[]" value="' +
                        element.id +
                        '" type="checkbox" id="per' +
                        element.id +
                        '">' +
                        '<label for="per' +
                        element.id +
                        '">' +
                        element.name +
                        "</label>" +
                        "</div>" +
                        "</div>";
                });
                html += "</div>";
            });
            $("#permissions-list").html(html);
        },
    });

    // create new roles
    $("#create_new_roles_submit").click(function (e) {
        e.preventDefault();
        var permissions = [];
        var name = $("#role_name").val();

        $(":checkbox:checked").each(function (i) {
            permissions[i] = $(this).val();
        });
        console.log(permissions, name);

        const formData = new FormData();

        formData.append("name", name);
        formData.append("permission", permissions);

        makeFormApiCall(
            appconfig.apibaseurl + "/create-new-user-roles",
            "POST",
            formData,
            true,
            (res) => {
                if (res.success) {
                    toastr.success(res.message);
                    getProfileDetails();
                    setTimeout(() => {
                        window.location.href = appconfig.siteutl + "/create-roles";
                    }, 1000);
                } else {
                    toastr.error(res.message);
                }
            },
            (err) => {
                if (typeof err.data != "undefined") {
                    showFormErrors($("#create_new_role"), err.data);
                    toastr.error("Please correct the form fields");
                }
            },
            false
        );

    });
});
