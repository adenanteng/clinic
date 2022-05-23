'use strict';

let tableName = '#treatmentCategoriesTable';
$(document).ready(function () {
    let tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[0, 'asc']],
        ajax: {
            url: route('treatment-categories.index'),
        },
        columnDefs: [
            {
                'targets': [0],
                'width': '40%',
            },
            {
                'targets': [1],
                'className': 'text-center',
            },
            {
                'targets': [2],
                'orderable': false,
                'className': 'text-center',
                'width': '8%',
            },
        ],
        columns: [
            {
                data: 'name',
                name: 'name',
            },
            {
                data: function (row) {
                    return `<span class="badge badge-light-danger">${row.treatments_count}</span>`;
                },
                name: 'treatments_count',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                        },
                    ];
                    return prepareTemplateRender('#treatmentCategoriesTemplate',
                        data);
                },
                name: 'id',
            },
        ],
    });
    handleSearchDatatable(tbl);
});

$(document).on('click', '#createTreatmentCategory', function () {
    $('#createTreatmentCategoryModal').modal('show').appendTo('body');
});

$('#createTreatmentCategoryModal').on('hidden.bs.modal', function () {
    resetModalForm('#createTreatmentCategoryForm',
        '#createTreatmentCategoryValidationErrorsBox');
});

$('#editTreatmentCategoryModal').on('hidden.bs.modal', function () {
    resetModalForm('#editTreatmentCategoryForm',
        '#editTreatmentCategoryValidationErrorsBox');
});

$(document).on('click', '.edit-btn', function (event) {
    let id = $(event.currentTarget).data('id');
    renderData(id);
});

function renderData (id) {
    $.ajax({
        url: route('treatment-categories.edit', id),
        type: 'GET',
        success: function (result) {
            $('#treatmentCategoryID').val(result.data.id);
            $('#editName').val(result.data.name);
            $('#editTreatmentCategoryModal').modal('show');
        },
    });
}

$(document).on('submit', '#createTreatmentCategoryForm', function (e) {
    e.preventDefault();
    $.ajax({
        url: route('treatment-categories.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#createTreatmentCategoryModal').modal('hide');
                $(tableName).DataTable().ajax.reload(null, false);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

$(document).on('submit', '#editTreatmentCategoryForm', function (e) {
    e.preventDefault();
    let formData = $(this).serialize();
    let id = $('#treatmentCategoryID').val();
    $.ajax({
        url: route('treatment-categories.update', id),
        type: 'PUT',
        data: formData,
        success: function (result) {
            $('#editTreatmentCategoryModal').modal('hide');
            displaySuccessMessage(result.message);
            $(tableName).DataTable().ajax.reload(null, false);
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

$(document).on('click', '.delete-btn', function (event) {
    let recordId = $(event.currentTarget).data('id');
    deleteItem(route('treatment-categories.destroy', recordId), tableName,
        'Treatment Category');
});
