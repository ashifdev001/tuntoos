function authanticate(url, email, password, btnLoader) {
    btnLoader = btnLoader || 0;
    if (email != "" && password != "") {
        startButtonLoader(btnLoader);
        let creditinals = {
            email: email,
            password: password,
        };

        makeJsonApiCall(
            url,
            "POST",
            JSON.stringify(creditinals),
            true,
            (data) => {
                stopButtonLoader(btnLoader);
                if (data.success == false) {
                    toastr.error(data.message);
                } else {
                    console.log(data);
                    localStorage.setItem("authToken", data.data.token);

                    toastr.success(data.message);
                    window.setTimeout(() => {
                        window.location.href = appconfig.siteutl + "/admin/dashboard";
                    }, 1000);
                }
            },
            (err) => {
                stopButtonLoader(btnLoader);
                toastr.error(err.message);
            },
            false
        );
    }
}

function registerAuthanticate(url, name, email, password, c_password, btnLoader) {
    btnLoader = btnLoader || 0;
    if (name != "" && email != "" && password != "" && c_password != "") {
        startButtonLoader(btnLoader);
        let creditinals = {
            name: name,
            email: email,
            password: password,
            c_password: c_password,
        };

        makeJsonApiCall(
            url,
            "POST",
            JSON.stringify(creditinals),
            true,
            (data) => {
                stopButtonLoader(btnLoader);
                if (data.success == false) {
                    toastr.error(data.message);
                } else {
                    console.log(data);
                    localStorage.setItem("authToken", data.data.authToken);
                    toastr.success(data.message);
                    window.setTimeout(() => {
                        window.location.href = appconfig.siteutl + "/dashboard";
                    }, 1000);
                }
            },
            (err) => {
                stopButtonLoader(btnLoader);
                toastr.error(err.message);
            },
            false
        );
    }
}

function removeTokenRedirect() {
    localStorage.removeItem("authToken");
    localStorage.removeItem("userprofile");
    window.setTimeout(() => {
        window.location.href = appconfig.siteutl + '/admin/login';
    }, 1000);
}

function logout() {
    makeJsonApiCall(
        appconfig.apibaseurl + "/logout",
        "POST",
        {},
        true,
        (data) => {
            if (data.success == true) {
                toastr.success(data.message);
            } else {
                hideLoader();
                toastr.error(data.message);
            }
            removeTokenRedirect();
        },
        (err) => {
            // TODO
            // toastr.error(err.message);
            removeTokenRedirect();
        },
        false
    );
}

// Forget Password method
function forgetPassword() {
    let email = $("#email").val();

    let data = {
        email: email,
    };

    var e = document.querySelector("#kt_password_reset_submit");
    e.setAttribute("data-kt-indicator", "on");

    makeJsonApiCall(
        appconfig.apibaseurl + "/forgot-password",
        "POST",
        JSON.stringify(data),
        true,
        (res) => {
            if (res.success == true) {
                toastr.success(res.message);
                window.setTimeout(() => {
                    window.location.href =
                        appconfig.siteutl + "/reset-password?email=" + email;
                }, 1000);
            } else {
                var e = document.querySelector("#kt_password_reset_submit");
                e.removeAttribute("data-kt-indicator");
                toastr.error(res.message);
            }
        },
        (err) => {
            var e = document.querySelector("#kt_password_reset_submit");
            e.removeAttribute("data-kt-indicator");
            toastr.error(err.message);
        },
        false
    );
}

function resetPassword() {
    let data = {
        email: $("#rp-email").val(),
        password: $("#rp-password").val(),
        password_confirmation: $("#rp-newpassword").val(),
        token: $("#rp-otp").val(),
    };

    var e = document.querySelector("#kt_password_reset_submit");
    e.setAttribute("data-kt-indicator", "on");

    makeJsonApiCall(
        appconfig.apibaseurl + "/reset-password",
        "POST",
        JSON.stringify(data),
        true,
        (res) => {
            if (res.success == true) {
                toastr.success(res.message);
                window.setTimeout(() => {
                    window.location.href = appconfig.siteutl;
                }, 1000);
            } else {
                var e = document.querySelector("#kt_password_reset_submit");
                e.removeAttribute("data-kt-indicator");
                toastr.error(res.message);
            }
        },
        (err) => {
            var e = document.querySelector("#kt_password_reset_submit");
            e.removeAttribute("data-kt-indicator");
            toastr.error(err.message);
        },
        false
    );
}

function getProfileDetails() {
    makeJsonApiCall(
        appconfig.apibaseurl + "/user-profile",
        "GET",
        {},
        true,
        (data) => {
            if (data.success == true) {
                localStorage.setItem("userprofile", JSON.stringify(data.data));
                // $("#logged-user-name").html(data.data.name);
                // $("#logged-user-role").html(data.data.roles[0].name);
                // $("#profile-image").attr("src", data.data.image);
                // $("#user-image").attr("src", data.data.image);

                $(".logged-user-name").html(data.data.name);
                $(".profile-image").attr("src", data.data.image);
                $(".user-image").attr("src", data.data.image);
                // TODO
                // $(".logged-user-role").html(data.data.roles[0].name);

                // TODO
                $('#inputName').val(data.data.name);
                $('#inputEmail').val(data.data.email);
                $('#phone').val(data.data.phone);
            } else {
                toastr.error(data.message);
            }
        },
        (err) => {
            toastr.error(err.message);
        },
        false
    );
}

function userOverview() {
    let profile = localStorage.getItem("userprofile");
    data = JSON.parse(profile);
    $("#overview-img").attr("src", data.image);
    $(".user-names").html(data.name);
    $("#profile-full-name").html(data.name);
    $("#user-role").html(data.roles[0].name);
    $("#user-email").html(data.email);
    $("#contact-no").html(data.phone);
    $(".prof-email-add").html(data.email);
    $(".prof-status").html(data.status);
    $(".prof-role").html(data.roles[0].name);
}

function populateUserDataForm() {
    let profile = localStorage.getItem("userprofile");
    data = JSON.parse(profile);
    let form = $("#kt_modal_user_profile_edit_form");
    form.find('input[name="name"]').val(data.name);
    form.find('input[name="email"]').val(data.email);
    form.find('input[name="phone"]').val(data.phone);
}

function userProfileUpdate() {
    var formData = new FormData($("#kt_modal_user_profile_edit_form")[0]);
    makeFormApiCall(
        appconfig.apibaseurl + "/profile-update",
        "POST",
        formData,
        true,
        (res) => {
            if (res.success) {
                toastr.success(res.message);
                getProfileDetails();
                setTimeout(() => {
                    window.location.href =
                        // appconfig.siteutl + "/accounts/overview";
                        appconfig.siteutl + "/admin/manage-profile";
                }, 1000);
            } else {
                toastr.error(res.message);
            }
        },
        (err) => {
            if (typeof err.data != "undefined") {
                showFormErrors($("#kt_modal_user_profile_edit_form"), err.data);
                toastr.error("Please correct the form fields");
            }
        },
        false
    );
}

// Update Password
function userPasswordUpdate() {
    var formData = new FormData($("#kt_modal_user_update_password_form")[0]);

    makeFormApiCall(
        appconfig.apibaseurl + "/password-update",
        "POST",
        formData,
        true,
        (res) => {
            if (res.success) {
                toastr.success(res.message);
                setTimeout(() => {
                    window.location.href =
                        // appconfig.siteutl + "/accounts/overview";
                        appconfig.siteutl + "admin/manage-profile";
                }, 1000);
            } else {
                toastr.error(res.message);
            }
        },
        (err) => {
            if (typeof err.data != "undefined") {
                showFormErrors(
                    $("#kt_modal_user_update_password_form"),
                    err.data
                );
                toastr.error("Please correct the form fields");
            } else {
                toastr.error(err.message);
            }
        },
        false
    );
}

// 
function profileImageUpdate() {
    var formData = new FormData($("#userImportForm")[0]);

    makeFormApiCall(
        appconfig.apibaseurl + "/profile-image-update",
        "POST",
        formData,
        true,
        (res) => {
            if (res.success) {
                toastr.success(res.message);
                getProfileDetails();
                setTimeout(() => {
                    window.location.href =
                        appconfig.siteutl + "/admin/manage-profile";
                }, 1000);
            } else {
                toastr.error(res.message);
            }
        },
        (err) => {
            if (typeof err.data != "undefined") {
                showFormErrors($("#kt_modal_user_profile_edit_form"), err.data);
                toastr.error("Please correct the form fields");
            }
        },
        false
    );
}

function createNewUser(url, name, email, password, c_password, role_id, btnLoader) {
    btnLoader = btnLoader || 0;
    if (name != "" && email != "" && password != "" && c_password != "" && role_id != "") {
        startButtonLoader(btnLoader);
        let creditinals = {
            name: name,
            email: email,
            password: password,
            c_password: c_password,
            role_id: role_id,
        };

        makeJsonApiCall(
            url,
            "POST",
            JSON.stringify(creditinals),
            true,
            (data) => {
                stopButtonLoader(btnLoader);
                if (data.success == false) {
                    toastr.error(data.message);
                } else {
                    toastr.success(data.message);
                }
            },
            (err) => {
                stopButtonLoader(btnLoader);
                toastr.error(err.message);
            },
            false
        );
    }
}