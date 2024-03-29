'use strict';

$(document).on('click', '#createServiceCategory', function () {
    $('#createServiceCategoryModal').modal('show').appendTo('body');
});

$(document).on('submit', '#createServiceCategoryForm', function (e) {
    e.preventDefault();
    $.ajax({
        url: route('service-categories.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#createServiceCategoryModal').modal('hide');
                let data = {
                    id: result.data.id,
                    name: result.data.name,
                };

                let newOption = new Option(data.name, data.id, false, true);
                $('#serviceCategory').append(newOption).trigger('change');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#createServiceCategoryForm', '#btnSave');
        },
    });
});

$('#createServiceCategoryModal').on('hidden.bs.modal', function () {
    resetModalForm('#createServiceCategoryForm',
        '#createServiceCategoryValidationErrorsBox');
});
