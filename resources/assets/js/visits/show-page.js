'use strict';

$(document).ready(function () {
    $('#date').flatpickr({
        maxDate: new Date(),
        disableMobile: true
    });

    setTimeout(function () {
        $('.visit-detail-width').
            parent().
            parent().
            addClass('visit-detail-width');
    }, 100);
});

// Reset Form JS
$(document).on('click', '.reset-form', function () {
    $('#addPrescription')[0].reset();
});
