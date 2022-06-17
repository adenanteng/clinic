// Add Visit Lab Data
$(document).on('submit', '#addVisitLab', function (e) {
    e.preventDefault();

    // let btnSubmitEle = $(this).find('#observationSubmitBtn');
    // setAdminBtnLoader(btnSubmitEle);
    // let observationAddUrl = doctorLogin ? route('doctors.visits.add.observation') : route('add.observation');
    // $.ajax({
    //     url: 'add.lab',
    //     type: 'POST',
    //     data: $(this).serialize(),
    //     dataType: 'json',
    //
    //     success: function (result) {
    //         // $('#addPrescription')[0].reset();
    //         $('.visit-labs').empty();
    //         $('#date').val('');
    //         $('#treatment_id').val('');
    //         $('#klinis').val('');
    //         $('#description').val('');
    //         $.each(result.data, function (i, val) {
    //             let data = [
    //                 {
    //                     'id': val.id,
    //                     'type': val.type,
    //                     'date': val.date,
    //                     'treatment_id': val.treatment_id,
    //                     'klinis': val.klinis,
    //                     'description': val.description,
    //                     'status': val.status,
    //                 }];
    //             console.log(data)
    //             const visitObservationTblData = prepareTemplateRender(
    //                 '#visitsObservationTblTemplate', data);
    //             $('.visit-labs').append(visitObservationTblData);
    //         });
    //         console.log(result.data)
    //         $('#addVisitLab').removeClass('show');
    //         displaySuccessMessage(result.message);
    //     },
    //     error: function (result) {
    //         displayErrorMessage(result.responseJSON.message);
    //     },
    //     complete: function () {
    //         $('#observationSubmitBtn').attr('disabled', false)
    //     },
    // });
});
