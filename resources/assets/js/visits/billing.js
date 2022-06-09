// Form Charges
$(document).on('change', '#treatmentName', function () {
    let halo = $('#treatmentName').val();
    $("#treatmentType").val(halo).trigger('change');
    $("#treatmentCharges").val(halo).trigger('change');
});

// Add visit Billing Data
$(document).on('submit', '#addBilling', function (e) {
    e.preventDefault();
    let btnSubmitEle = $(this).find('#billingSubmitBtn');
    setAdminBtnLoader(btnSubmitEle);
    let addBillingUrl = route('add.billing');
    $.ajax({
        url: addBillingUrl,
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function (result) {
            // $('#addBilling')[0].reset();
            $('.visit-billings').empty();
            $('#treatmentName').val('');
            $('#treatmentUnit').val('1');
            $('#treatmentType').val('');
            $('#treatmentCharges').val('');
            $.each(result.data, function (i, val) {
                let data = [
                    {
                        'id': val.id,
                        'date': val.created_at,
                        'name': val.name_text,
                        'unit': val.unit,
                        'type': val.type_text,
                        'unit_price': val.unit_price,
                        'subtotal': val.subtotal,
                    }];
                const visitBillingTblData = prepareTemplateRender(
                    '#visitsBillingTblTemplate', data);
                $('.visit-billings').append(visitBillingTblData);
            });
            console.log(result.data)
            displaySuccessMessage(result.message);
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            $('#billingSubmitBtn').attr('disabled', false)
        },
    });
});

// Delete Visit Billing Data
$(document).on('click', '.delete-billing-btn', function (e) {
    e.preventDefault();

    let id = $(this).attr('data-id');
    $(this).closest('tr').remove();
    let billingDeleteUrl = route('delete.billing', id);
    $.ajax({
        url: billingDeleteUrl,
        type: 'POST',
        dataType: 'json',
        success: function (result) {
            // $('#addPrescription')[0].reset();
            $('#billingId').val('');
            if (result.data.length < 1) {
                displaySuccessMessage(result.message);
                $('.visit-billings').
                append(
                    `<tr><td colspan="4" class="text-center fw-bold  text-muted text-gray-600">No data available in table</td></tr>`);
            } else {
                displaySuccessMessage(result.message);
            }
        },
    });
});
