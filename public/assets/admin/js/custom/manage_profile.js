$(document).ready(function () {
    $('#user_password_update_submit').click(function (event) {
        event.preventDefault();
        userPasswordUpdate();
    });

    $('#user_profile_update_submit').click(function (event) {
        event.preventDefault();
        userProfileUpdate();
    });

    $('#profileimgupdate').click(function (event) {
        event.preventDefault();
        profileImageUpdate();
    });

    $('#profileimg').on('change', function () {
        const file = this.files[0];

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#previewUserImg').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        }
    });
});