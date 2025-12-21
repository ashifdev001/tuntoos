$(document).ready(function () {
    $('#appointmentForm,#popupForm').off('submit').on('submit', function (e) {
        e.preventDefault();

        let $form = $(this);
        let formData = $form.serialize();
        let $submitBtn = $form.find('button[type="submit"]');

        // Clear previous messages
        $('.dzFormMsg').html('');

        // Simple client-side validation
        let valid = true;
        $form.find('[required]').each(function () {
            if (!$(this).val().trim()) {
                $(this).addClass('is-invalid');
                valid = false;
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        if (!valid) {
            $('.dzFormMsg').html('<div class="alert alert-danger">Please fill all required fields.</div>');
            return;
        }

        $submitBtn.prop('disabled', true).text('Submitting...');

        $.ajax({
            url: appconfig.apibaseurl + `/appointments`,
            method: 'POST',
            data: formData,
            success: function (response) {
                if (response.success) {
                    window.location.href =appconfig.siteutl + `/thank-you`;
                    $form[0].reset();
                } else {
                    $('.dzFormMsg').html('<div class="alert alert-danger">' + response.message + '</div>');
                }
            },
            error: function (xhr) {
                let message = xhr.responseJSON?.message || 'Something went wrong!';
                $('.dzFormMsg').html('<div class="alert alert-danger">' + message + '</div>');
            },
            complete: function () {
                $submitBtn.prop('disabled', false).text('Submit Now');
            }
        });
    });
});
