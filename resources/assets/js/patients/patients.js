'use strict';

let tableName = '#patientsTable';
$(document).ready(function () {
    let tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[4, 'desc']],
        ajax: {
            url: route('patients.index'),
        },
        columnDefs: [
            {
                'targets': [5],
                'orderable': true,
                'searchable': true,
                'className': 'text-center',
                'width': '8%',
            },
            {
                'targets': [2],
                'orderable': true,
                'searchable': true,
                'className': 'text-center',
            },
            {
                'targets': [3],
                'orderable': true,
                'searchable': true,
                'className': 'text-center',
            },
            {
                'targets': [1],
                'width': '16%',
                'className': 'text-center',
            },
            {
                'targets': [4],
                'width': '16%',
            },
        ],
        columns: [
            {
                data: function (row) {
                    return `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <div class="symbol-label">
                            <img src="${row.profile}" alt=""
                                 class="w-100 object-cover">
                        </div>
                    </div>
                    <div class="d-inline-block align-top">
                        <a href="${route('patients.show', row.id)}"
                           class="text-primary-800 mb-1 d-inline-block">${row.user.full_name}</a>
                        <a class="btn btn-sm btn-light-success fw-bolder ms-2 fs-8 py-1 px-3 cursor-default"
                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="No Rekam Medis">${row.patient_unique_id}</a>
                        <span class="d-block text-muted fw-bold">${row.address.address1}</span>
                    </div>`;
                },
                name: 'user.full_name',
            },
            {
                data: function (row) {
                    return `<span class="badge badge-light-info">+62 ${row.user.contact}</span>
                            <span class="badge badge-light-success">${row.user.email}</span>`;
                },
                name: 'user.contact',
            },
            {
                data: function (row) {
                    console.log(row)
                    return `<span class="badge badge-light-danger">${row.appointments_count}</span>`;
                },
                name: 'patient_unique_id',
            },
            {
                data: function (row) {
                    return `<div class="form-check form-switch form-check-custom form-check-solid justify-content-center">
                            <input class="form-check-input h-20px w-30px email-verified" data-id="${row.user.id}" type="checkbox" value=""
                               ${row.user.email_verified_at ? 'checked' : ''} />
                            </div>`;
                },
                name: 'user.id',
            },
            {
                data: function (row) {
                    return `<span class="badge badge-light-info">${moment.parseZone(
                        row.created_at).format('Do MMM, Y H:mm')}</span>`;
                },
                name: 'created_at',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                            'editUrl': route('patients.edit', row.id),
                            'userId': row.user_id,
                            'emailVerified': isEmpty(row.user.email_verified_at),
                        },
                    ];

                    return prepareTemplateRender('#actionsTemplates', data);
                },
                name: 'id',
            },
        ],
    });
    handleSearchDatatable(tbl);
});

$(document).on('click', '.delete-btn', function () {
    let patientId = $(this).attr('data-id');
    deleteItem(route('patients.destroy', patientId), tableName, 'Patient');
});

$(document).on('change','.email-verified',function(e){
    let recordId = $(e.currentTarget).data('id');
    let value = $(this).is(':checked') ? 1 : 0;
    $.ajax({
        type: 'POST',
        url: route('emailVerified'),
        data: {
            id: recordId,
            value : value,
        },
        success: function (result) {
            $(tableName).DataTable().ajax.reload(null, false);
            displaySuccessMessage(result.message);
        },
    });
});

$(document).on('click', '.email-verification', function (event) {
    let userId = $(event.currentTarget).data('id');
    $.ajax({
        type: 'POST',
        url: route('resend.email.verification', userId),
        success: function (result) {
            $(tableName).DataTable().ajax.reload(null, false);
            displaySuccessMessage(result.message);
        },
        error: function (result){
            displayErrorMessage(result.responseJSON.message);
        }
    });
});
