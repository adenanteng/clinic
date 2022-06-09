// Add Visit Observation Data
$(document).on('submit', '#addObservation', function (e) {
    e.preventDefault();

    let btnSubmitEle = $(this).find('#observationSubmitBtn');
    setAdminBtnLoader(btnSubmitEle);
    let observationAddUrl = doctorLogin ? route('doctors.visits.add.observation') : route('add.observation');
    $.ajax({
        url: observationAddUrl,
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',

        success: function (result) {
            // $('#addPrescription')[0].reset();
            $('.visit-observations').empty();
            $('#symptoms').val('');
            $('#anamnesis').val('');
            $('#prognosis').val('');
            $('#awareness').val('');
            $('#temperature').val('');
            $('#height').val('');
            $('#weight').val('');
            $('#belly').val('');
            $('#systole').val('');
            $('#diastole').val('');
            $('#respiratory_rate').val('');
            $('#heart_rate').val('');
            $('#assessment').val('');
            $('#plan').val('');
            $.each(result.data, function (i, val) {
                let data = [
                    {
                        'id': val.id,
                        'date': val.updated_at,
                        'name': val.observation_name,
                        'user': val.create_user,
                        'symptoms': val.symptoms,
                        'anamnesis': val.anamnesis,
                        'temperature': val.temperature,
                        'awareness': val.awareness,
                        'height': val.height,
                        'weight': val.weight,
                        'systole': val.systole,
                        'diastole': val.diastole,
                        'respiratory': val.respiratory_rate,
                        'heart': val.heart_rate,
                        'assessment': val.assessment,
                        'plan': val.plan,
                    }];
                const visitObservationTblData = prepareTemplateRender(
                    '#visitsObservationTblTemplate', data);
                $('.visit-observations').append(visitObservationTblData);
            });
            $('#collapseObservation').removeClass('show');
            displaySuccessMessage(result.message);
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            $('#observationSubmitBtn').attr('disabled', false)
        },
    });
});

// Delete Visit Observation Data
$(document).on('click', '.remove-observation', function (e) {
    e.preventDefault();

    let id = $(this).attr('data-id');
    let observationDeleteUrl = route('delete.observation', id);

    $.ajax({
        url: observationDeleteUrl,
        type: 'POST',
        dataType: 'json',
        success: function (result) {
            // $('#collapseObservation')[0].reset();
            $('#observation_name').val('');
            if ($('#accordionExample div').length < 1) {
                displaySuccessMessage(result.message);
                $('#accordionExample').
                append(
                    `<p class="text-center fw-bold mt-3 text-muted text-gray-600">${noRecordsFound}</p>`);
            } else {
                $('#addVisitObservation').removeClass('show');
                displaySuccessMessage(result.message);
            }
        },
    });
});
