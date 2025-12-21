$(document).ready(function () {
    $('.contact_us_form, .dzForm').off('submit').on('submit', function (e) {
        e.preventDefault();

        let form = $(this);
        let formData = form.serialize();

        let isValid = true;

        form.find('input[required], textarea[required]').each(function () {
            if (!$(this).val()) {
                isValid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        if (!isValid) return;
        $.ajax({
            type: 'POST',
            url: appconfig.apibaseurl + `/enquiries`,
            data: formData,
            dataType: 'json',
            beforeSend: function () {
                form.find('button[type="submit"]').prop('disabled', true).text('Sending...');
            },
            success: function (response) {
                window.location.href = appconfig.siteutl + `/thank-you`;
                form[0].reset();
            },
            error: function (xhr) {

                alert("Something went wrong. Please try again.");
                console.error(xhr.responseText);
            },
            complete: function () {

                form.find('button[type="submit"]').prop('disabled', false).text('Submit');
            }
        });
    });
});
