'use strict';

$(document).on('click', '#createCategory', function () {
    $('#createServiceCategoryModal').modal('show').appendTo('body');
});

$(document).on('submit', '#createCategoryForm', function (e) {
    e.preventDefault();
    $.ajax({
        url: route('treatment-categories.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#createCategoryModal').modal('hide');
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
            processingBtn('#createCategoryForm', '#btnSave');
        },
    });
});

$('#createCategoryModal').on('hidden.bs.modal', function () {
    resetModalForm('#createCategoryForm',
        '#createCategoryValidationErrorsBox');
});
