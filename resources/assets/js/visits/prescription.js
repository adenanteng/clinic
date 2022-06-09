// Add visit Prescription Data
$(document).on('submit', '#addPrescription', function (e) {
    e.preventDefault();
    let btnSubmitEle = $(this).find('#prescriptionSubmitBtn');
    setAdminBtnLoader(btnSubmitEle);
    let prescriptionAddUrl = route('add.prescription');
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
                        'date': val.date,
                        'name': val.pharmacys.name,
                        'frequency': val.frequency,
                        'duration': val.duration,
                        'status': val.status_name,
                    }];
                console.log(data)
                const visitPrescriptionTblData = prepareTemplateRender(
                    '#visitsPrescriptionTblTemplate', data);
                $('.visit-prescriptions').append(visitPrescriptionTblData);
            });
            console.log(result.data)
            $('#collapsePrescription').removeClass('show');
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
$(document).on('click', '.edit-prescription-btn', function () {
    let id = $(this).attr('data-id');
    editPrescription(id);
});

// Delete Visit Prescription Data
$(document).on('click', '.delete-prescription-btn', function (e) {
    e.preventDefault();

    let id = $(this).attr('data-id');
    $(this).closest('tr').remove();
    let prescriptionDeleteUrl = route('delete.prescription', id);
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

// Send Visit Prescription Data
$(document).on('click', '.send-prescription-btn', function () {
    let id = $(this).attr('data-id');
    sendPrescription(id);
});


function editPrescription (id) {
    let prescriptionEditUrl = route('edit.prescription', id);
    $.ajax({
        url: prescriptionEditUrl,
        type: 'GET',
        success: function (result) {
            $('#addPrescription')[0].reset();
            $('#prescriptionId').val(result.data.id);
            $("#drugId").val(result.data.drug_id).trigger('change');
            $('#frequencyId').val(result.data.frequency);
            $('#durationId').val(result.data.duration);
            $('#descriptionId').val(result.data.description);
            // console.log(result)
        },
    });
}

function sendPrescription (id) {
    let prescriptionSendUrl = route('send.prescription', id);
    $.ajax({
        url: prescriptionSendUrl,
        type: 'GET',
        success: function (result) {
            // $('#addPrescription')[0].reset();
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
                        'date': val.date,
                        'name': val.pharmacys.name,
                        'frequency': val.frequency,
                        'duration': val.duration,
                        'status': val.status_name,
                    }];
                console.log(data)
                const visitPrescriptionTblData = prepareTemplateRender(
                    '#visitsPrescriptionTblTemplate', data);
                $('.visit-prescriptions').append(visitPrescriptionTblData);
            });
            console.log(result.data)
            displaySuccessMessage(result.message);
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
}
