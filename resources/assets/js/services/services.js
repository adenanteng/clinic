'use strict';

let tableName = '#servicesTable';
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
            url: route('services.index'),
            data: function (data) {
                data.status = $('#filterStatus').
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
                'targets': [2],
                'width': '30%',
            },
            {
                'targets': [3],
                'width': '30%',
            },
            // {
            //     'targets': [4],
            //     'width': '5%',
            //     'className': 'text-center',
            //     'orderable': false,
            //     'searchable': false,
            // },
            {
                'targets': [4],
                'orderable': false,
                'className': 'text-center',
                'width': '5%',
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
                data: 'service_category.name',
                name: 'service_category.name',
            },
            // {
            //     data: function (row) {
            //         return currencyIcon + ' ' + getFormattedPrice(row.id);
            //     },
            //     name: 'charges',
            // },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                            'status': row.status,
                        },
                    ];
                    return prepareTemplateRender('#servicesTemplate', data);
                },
                name: 'status',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                            'editUrl': route('services.edit', row.id),
                        },
                    ];
                    return prepareTemplateRender('#actionsTemplates',
                        data);
                },
                name: 'id',
            },
        ],
        'fnInitComplete': function () {
            $('#filterStatus').change(function () {
                $('#filter').removeClass('show');
                $('#filterBtn').removeClass('show');
                $('#servicesTable').DataTable().ajax.reload(null, true);
            });
        },
    });
    handleSearchDatatable(tbl);
});

$(document).on('click', '#resetFilter', function () {
    $('#filterStatus').val(all).trigger('change');
});

$(document).on('click', '.delete-btn', function (event) {
    let recordId = $(event.currentTarget).data('id');
    deleteItem(route('services.destroy', recordId), tableName, 'Service');
});

$(document).on('click', '.service-statusbar', function (event) {
    let recordId = $(event.currentTarget).data('id');

    $.ajax({
        type: 'PUT',
        url: route('service.status'),
        data: { id: recordId },
        success: function (result) {
            displaySuccessMessage(result.message);
        },
    });
});

