$(document).ready(function () {
    $('#user_register').click(function (event) {
        event.preventDefault();
        let name = $('#name').val();
        let email = $('#email').val();
        let password = $('#password').val();
        let c_password = $('#c_password').val();
        let btnLoader = $(this);
        registerAuthanticate(appconfig.apibaseurl+'/register', name, email, password, c_password, btnLoader);
    });
});