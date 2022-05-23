'use strict';

let tableName = '#treatmentsTable';
$(document).ready(function () {
    let tbl = $(tableName).DataTable({
        deferRender: true,
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[1, 'asc']],
        ajax: {
            url: route('treatments.index'),
            data: function (data) {
                data.status = $('#treatmentsStatus').
                    find('option:selected').
                    val();
            },
        },
        columnDefs: [
            {
                'targets': [0],
                'width': '8%',
                'orderable': false,
                'searchable': false,
            },
            {
                'targets': [1],
                'width': '50%',
            },
            {
                'targets': [2],
                'width': '22%',
            },
            {
                'targets': [3],
                'width': '10%',
                'className': 'text-center',
                'orderable': true,
                'searchable': false,
            },
            {
                'targets': [4],
                'orderable': false,
                'className': 'text-center',
                'width': '10%',
            },
        ],
        columns: [
            {
                data: function (row) {
                    return `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <div class="symbol-label">
                            <img src="${row.icon}" alt=""
                                 class="w-100 object-cover">
                        </div>
                    </div>`;
                },
                name: 'icon',
            },
            {
                data: 'name',
                name: 'name',
            },
            {
                data: function (row) {
                    return `<span class="badge badge-success">
                                ${row.treatment_category.name}
                            </span>`;
                },
                name: 'treatment_category.name',
            },
            {
                data: function (row) {
                    return currencyIcon + ' ' + getFormattedPrice(row.charges);
                },
                name: 'charges',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                            'status': row.status,
                        },
                    ];
                    return prepareTemplateRender('#treatmentsTemplate', data);
                },
                name: 'status',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                            'editUrl': route('treatments.edit', row.id),
                            'hideDelete': true,
                        },
                    ];
                    return prepareTemplateRender('#actionsTemplates',
                        data);
                },
                name: 'id',
            },
        ],
        'fnInitComplete': function () {
            $('#treatmentsStatus').change(function () {
                $('#filter').removeClass('show');
                $('#filterBtn').removeClass('show');
                $('#treatmentsTable').DataTable().ajax.reload(null, true);
            });
        },
    });
    handleSearchDatatable(tbl);
});

$(document).on('click', '#resetFilter', function () {
    $('#treatmentsStatus').val(all).trigger('change');
});

$(document).on('click', '.delete-btn', function (event) {
    let recordId = $(event.currentTarget).data('id');
    deleteItem(route('treatments.destroy', recordId), tableName, 'Treatment');
});

$(document).on('click', '.treatment-statusbar', function (event) {
    let recordId = $(event.currentTarget).data('id');

    $.ajax({
        type: 'PUT',
        url: route('treatment.status'),
        data: { id: recordId },
        success: function (result) {
            displaySuccessMessage(result.message);
        },
    });
});

