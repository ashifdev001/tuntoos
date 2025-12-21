$(document).ready(function () {
    $('#user_login').click(function (event) {
        event.preventDefault();
        let email = $('#email').val();
        let password = $('#password').val();
        let btnLoader = $(this);
        authanticate(appconfig.apibaseurl+'/login', email, password, btnLoader);
    });
});