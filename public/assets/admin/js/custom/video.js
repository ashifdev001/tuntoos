$(document).ready(function () {

    const vId = $('#gId').val();          // reuse hidden id
    const base = appconfig.apibaseurl + '/videos';

    /* ===============================
       THUMBNAIL PREVIEW
    =============================== */
    $('input[name="thumbnail"]').on('change', function () {
        $('.preview').html('');

        if (this.files && this.files[0]) {
            const file = this.files[0];
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = $('<img>')
                        .attr('src', e.target.result)
                        .addClass('img-thumbnail mr-2 mb-2')
                        .css({ 'max-width': '120px', 'max-height': '120px' });
                    $('.preview').html(img);
                };
                reader.readAsDataURL(file);
            }
        }
    });


    /* ===============================
       VIDEO TYPE TOGGLE
    =============================== */
    function toggleVideoType(type) {
        if (type === 'url') {
            $('#video_url_box').show();
            $('#video_file_box').hide();
        } else {
            $('#video_url_box').hide();
            $('#video_file_box').show();
        }
    }

    toggleVideoType($('#video_type').val());

    $('#video_type').on('change', function () {
        toggleVideoType(this.value);
    });


    /* ===============================
       FORM VALIDATION & SUBMIT
    =============================== */
    $('#videoForm').validate({
        errorClass: 'text-danger',
        rules: {
            title: { required: true },
            thumbnail: { ...(vId > 0 ? {} : { required: true }) },
            video_url: {
                required: function () {
                    return $('#video_type').val() === 'url';
                }
            },
            video_file: {
                required: function () {
                    return $('#video_type').val() === 'upload' && vId == 0;
                }
            }
        },
        messages: {
            title: { required: 'Please enter a title.' },
            thumbnail: { required: 'Please select a thumbnail.' },
            video_url: { required: 'Please enter video URL.' },
            video_file: { required: 'Please upload a video file.' }
        },
        submitHandler: function (form) {

            let btnLoader = $(form).find('button[type="submit"]');
            startButtonLoader(btnLoader);

            const formData = new FormData(form);
            const url = (vId > 0)
                ? `${appconfig.apibaseurl}/videos/${vId}`
                : base;

            makeFormApiCall(
                url,
                'POST',
                formData,
                true,
                () => {
                    stopButtonLoader(btnLoader);
                    toastr.success('Video saved successfully!');
                    setTimeout(() => {
                        window.location.href = appconfig.siteutl + '/admin/videos';
                    }, 1000);
                },
                (err) => {
                    stopButtonLoader(btnLoader);
                    toastr.error(
                        'Error: ' +
                        (err.responseJSON ? err.responseJSON.message : err.message || 'Something went wrong.')
                    );
                },
                false
            );
        }
    });


    /* ===============================
       EDIT MODE LOAD DATA
    =============================== */
    if (vId > 0) {
        $.ajax({
            type: 'GET',
            headers: {
                'Content-type': 'application/json; charset=UTF-8',
                Authorization: 'Bearer ' + localStorage.getItem('authToken')
            },
            url: `${appconfig.apibaseurl}/videos/${vId}`,
            success: function (res) {
                if (res.success) {
                    $('#title').val(res.data.title);
                    $('#video_type').val(res.data.video_type).trigger('change');
                    $('input[name="video_url"]').val(res.data.video_url || '');

                    if (res.data.thumbnail) {
                        $('.preview').html(
                            `<img src="${res.data.thumbnail}" class="img-thumbnail" style="max-height:120px;">`
                        );
                    }
                }
            },
            error: console.error
        });
    }


    /* ===============================
       VIDEO LIST TABLE
    =============================== */
    if ($('#videoTable').length > 0) {
        generateTable(
            'videoTable',
            'title',
            base,
            ['idx', 'title', 'thumbnail', 'video'],
            `<div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item edit_video" href="#">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a class="dropdown-item delete_video" href="#">
                        <i class="fa fa-trash"></i> Delete
                    </a>
                </div>
            </div>`,
            (row, indx) => {
                const isYouTube = row.video_url && row.video_url.includes('youtube.com');
                return {
                    ...row,
                    idx: indx + 1,
                    thumbnail: `<img src="${row.thumbnail_full_url}" class="img-thumbnail" style="max-width:100px;">`,
                    video: isYouTube
                        ? `<iframe width="200" height="120" src="https://www.youtube.com/embed/${row.video_url.split('v=')[1]?.split('&')[0]}" frameborder="0" allowfullscreen></iframe>`
                        : `<iframe src="${row.video_full_url}" width="200" height="120" frameborder="0" allowfullscreen></iframe>`
                };
            }
        );
    }


    /* ===============================
       ACTIONS
    =============================== */
    $(document).on('click', '.delete_video', function () {
        deleteData($(this), appconfig.apibaseurl + '/videos/');
    });

    $(document).on('click', '.edit_video', function () {
        editData($(this), appconfig.siteutl + '/admin/videos');
    });

});
