$(document).ready(function () {
    $.ajax({
        type: "get",
        url: appconfig.apibaseurl + "/edit-role-permissions",
        headers: {
            "Content-type": "application/json; charset=UTF-8",
            Authorization: "Bearer " + localStorage.getItem("authToken"),
        },
        data: {'role_id' : role_id},
        dataType: "json",
        success: function (response) {
            if (response.success) {
                console.log(response);
                $('#role_name').val(response.data.roles.role_name);
                html = "";
                $.map(response.data.permissions, function (elements, Key) {
                    html += '<div class="col-sm-3">' + "<label>" + Key;
                    ("</label>");
                    $.map(elements, function (element, index) {
                        checked = response.data.roles.permissions.includes(element.id) ? 'checked' : '';
                        html +=
                            '<div class="form-group clearfix my-2">' +
                            '<div class="icheck-primary d-inline">' +
                            '<input name="permission_id[]" value="' +
                            element.id +
                            '" type="checkbox" id="per' +
                            element.id +
                            '"'+ checked + '>' +
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
            }
        },
    });

    $("#edit_roles_submit").click(function (e) {
        e.preventDefault();
        console.log('edit_roles_submit');
    });
});
