'use strict';

$(document).ready(function () {
    setTimeout(function () {
        $('.visit-detail-width').
            parent().
            parent().
            addClass('visit-detail-width');
    }, 100);

});
// Add visit Prescription Data
$(document).on('submit', '#addPrescription', function (e) {
    e.preventDefault();
    let btnSubmitEle = $(this).find('#prescriptionSubmitBtn');
    setAdminBtnLoader(btnSubmitEle);
    let prescriptionAddUrl = doctorLogin ? route(
        'doctors.visits.add.prescription') : route('add.prescription');
    $.ajax({
        url: prescriptionAddUrl,
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function (result) {
            $('#addPrescription')[0].reset();
            $('.visit-prescriptions').empty();
            $('#prescriptionId').val('');
            $('#drugId').val('');
            $('#frequencyId').val('');
            $('#durationId').val('');
            $('#descriptionId').val('');
            $.each(result.data, function (i, val) {
                let data = [
                    {
                        'id': val.id,
                        'name': val.pharmacys.name,
                        'frequency': val.frequency,
                        'duration': val.duration,
                    }];

                const visitPrescriptionTblData = prepareTemplateRender(
                    '#visitsPrescriptionTblTemplate', data);
                $('.visit-prescriptions').append(visitPrescriptionTblData);
            });
            console.log(result.data)
            $('#addVisitPrescription').removeClass('show');
            displaySuccessMessage(result.message);
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            $('#prescriptionSubmitBtn').attr('disabled', false)
        },
    });
});

// Edit Visit Prescription Data
function renderData (id) {
    let prescriptionEditUrl = doctorLogin ? route(
        'doctors.visits.edit.prescription', id) : route('edit.prescription',
        id);
    $.ajax({
        url: prescriptionEditUrl,
        type: 'GET',
        success: function (result) {
            $('#addPrescription')[0].reset();
            $('#prescriptionId').val(result.data.id);
            $('#prescriptionNameId').val(result.data.drug.name);
            $('#frequencyId').val(result.data.frequency);
            $('#durationId').val(result.data.duration);
            $('#descriptionId').val(result.data.description);
        },
    });
}

$(document).on('click', '.edit-prescription-btn', function () {
    let id = $(this).attr('data-id');
    if (!$('#addVisitPrescription').hasClass('show')) {
        $('#addVisitPrescription').addClass('show');
    }
    renderData(id);
});

// Delete Visit Prescription Data
$(document).on('click', '.delete-prescription-btn', function (e) {
    e.preventDefault();

    let id = $(this).attr('data-id');
    $(this).closest('tr').remove();
    let prescriptionDeleteUrl = doctorLogin ? route(
        'doctors.visits.delete.prescription', id) : route('delete.prescription',
        id);
    $.ajax({
        url: prescriptionDeleteUrl,
        type: 'POST',
        dataType: 'json',
        success: function (result) {
            $('#addPrescription')[0].reset();
            $('#prescriptionId').val('');
            if (result.data.length < 1) {
                $('#addVisitPrescription').removeClass('show');
                displaySuccessMessage(result.message);
                $('.visit-prescriptions').
                    append(
                        `<tr><td colspan="4" class="text-center fw-bold  text-muted text-gray-600">No data available in table</td></tr>`);
            } else {
                $('#addVisitPrescription').removeClass('show');
                displaySuccessMessage(result.message);
            }
        },
    });
});

// Reset Form JS
$(document).on('click', '.reset-form', function () {
    $('#addPrescription')[0].reset();
});


