$(document).ready(function () {
    // Create New User
    $("#create_new_user_submit").click(function (e) {
        e.preventDefault();
        let name = $('#name').val();
        let email = $('#email').val();
        let password = $('#password').val();
        let c_password = $('#c_password').val();
        let role_id = $('#role_id').val();
        let btnLoader = $(this);
        createNewUser(appconfig.apibaseurl + '/create-new-user', name, email, password, c_password, role_id, btnLoader);
        $('#create_new_user')[0].reset();
    });

    // get user role list
    $.ajax({
        type: "get",
        url: appconfig.apibaseurl + "/get-user-roles-list",
        headers: {
            "Content-type": "application/json; charset=UTF-8",
            Authorization: "Bearer " + localStorage.getItem("authToken"),
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            html = '<option selected value="" hidden>Select Role</option>';
            if (response.success) {
                $.map(response.data, function (element, index) {
                    html += '<option value="'+ element.id +'">'+ element.name +'</option>';
                });
            }
            $('#role_id').html(html);
        },
    });
});
