'use strict';

let tableName = '#inventoriesTable';
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
            url: route('inventories.index'),
            data: function (data) {
                data.status = $('#filterStatus').
                    find('option:selected').val();
            },
        },
        columnDefs: [
            {
                'targets': [0],
                'width': '8%',
                'orderable': true,
                'searchable': true,
            },
            {
                'targets': [1],
                'width': '50%',
            },
            {
                'targets': [2],
                'width': '22%',
                'orderable': true,
                'searchable': true,
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
                'orderable': true,
                'className': 'text-center',
                'width': '10%',
            },
        ],
        columns: [
            {
                data: function (row) {
                    return `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <div class="symbol-label">
                            <img src="${row.icon}" alt="" class="w-100 object-cover">
                        </div>
                    </div>`;
                },
                name: 'icon',
            },
            {
                data: function (row) {
                    return `${row.name} <span class="ms-3 badge badge-circle badge-danger">${row.total_procurement}</span>`;
                },
                name: 'name',
            },
            {
                data: function (row) {
                    console.log(row)
                    return `<span class="badge badge-success">
                                ${row.category_text}
                            </span>`;
                },
                name: 'brand',
            },
            {
                data: function (row) {
                    return row.stock + ' ' + row.unit_text;
                },
                name: 'stock',
            },
            {
                data: function (row) {
                    return isEmpty(row.price) ? 'N/A' : row.price
                },
                name: 'price',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                            'editUrl': route('inventories.edit', row.id),
                            'hideDelete': false,
                        },
                    ];
                    return prepareTemplateRender('#actionsTemplates', data);
                },
                name: 'id',
            },
        ],
        'fnInitComplete': function () {
            $('#filterStatus').change(function () {
                $('#filter').removeClass('show');
                $('#filterBtn').removeClass('show');
                $('#inventoriesTable').DataTable().ajax.reload(null, true);
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
    deleteItem(route('inventories.destroy', recordId), tableName, 'Inventory');
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

