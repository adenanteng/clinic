// Add visit Problem Data
$(document).on('submit', '#addVisitProblem', function (e) {
    e.preventDefault();
    // let problemName = $('#diagnosisName').val();
    // let empty = problemName.trim().replace(/ \r\n\t/g, '') === '';
    //
    // if (empty) {
    //     displayErrorMessage(
    //         'Problem field is not contain only white space');
    //     return false;
    // }

    let btnSubmitEle = $(this).find('#problemSubmitBtn');
    setAdminBtnLoader(btnSubmitEle);
    let problemAddUrl = route('add.problem');
    $.ajax({
        url: problemAddUrl,
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function (result) {
            $('ul#diagnosisLists').empty();
            $('ul#procedureLists').empty();
            if (result.data.length > 0) {
                displaySuccessMessage(result.message);
                $.each(result.data, function (i, val) {
                    $('#diagnosisName').val('');
                    $('#procedureName').val('');
                    if (val.type === 10) {
                        $('#diagnosisLists').append(
                            `<li class="list-group-item text-break text-wrap d-flex justify-content-between align-items-center py-5">${val.problem_name}<span class="remove-problem" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" data-id="${val.id}"><a href="javascript:void(0)"><i class="fas fa-trash text-danger"></i></a></span></li>`);
                    }else {
                        $('#procedureLists').append(
                            `<li class="list-group-item text-break text-wrap d-flex justify-content-between align-items-center py-5">${val.problem_name}<span class="remove-problem" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" data-id="${val.id}"><a href="javascript:void(0)"><i class="fas fa-trash text-danger"></i></a></span></li>`);
                    }
                });
            } else {
                $('#diagnosisLists').
                append(
                    `<p class="text-center fw-bold text-muted mt-3">${noRecordsFound}</p>`);
                $('#procedureLists').
                append(
                    `<p class="text-center fw-bold text-muted mt-3">${noRecordsFound}</p>`);
            }
        },
        complete: function () {
            $('#problemSubmitBtn').attr('disabled', false)
        },
    });
});

// Delete Visit Problem Data
$(document).on('click', '.remove-problem', function (e) {
    e.preventDefault();
    let id = $(this).attr('data-id');
    let problemDeleteUrl = doctorLogin ? route('doctors.visits.delete.problem',
        id) : route('delete.problem', id);
    $(this).closest('li').remove();
    $.ajax({
        url: problemDeleteUrl,
        type: 'POST',
        dataType: 'json',
        success: function (result) {
            if (result.success) {
                if ($('#problemLists li').length < 1) {
                    displaySuccessMessage(result.message);
                    $('#problemLists').
                    append(
                        `<p class="text-center fw-bold mt-3 text-muted text-gray-600">${noRecordsFound}</p>`);
                } else {
                    displaySuccessMessage(result.message);
                }
            }
        },
    });
});

// Icd-9
new TomSelect('#select-icd9',{
    valueField: 'Name',
    labelField: 'Name',
    searchField: ['Name','Description'],

    // fetch remote data
    load: function(query, callback) {
        let url = 'http://icd10api.com/?s=' + encodeURIComponent(query) + '&desc=short&r=json';
        fetch(url)
            .then(response => response.json())
            .then(json => {
                callback(json.Search);
                self.settings.load = null;
                console.log(url)
            }).catch(()=>{
            callback();

        });
    },
    // custom rendering function for options
    render: {
        option: function(item, escape) {
            return `<div><span class="ml-5">${ escape(item.Name) } - </span><span>${ escape(item.Description) }</span></div>`;
        },

        item: function(item, escape) {
            return `<div><span class="ml-5">${ escape(item.Name) } - </span><span>${ escape(item.Description) }</span></div>`;
        },
    },
});

//Icd-10
new TomSelect('#select-icd10',{
    valueField: 'Name',
    labelField: 'Name',
    searchField: ['Name','Description'],

    // fetch remote data
    load: function(query, callback) {
        let url = 'http://icd10api.com/?s=' + encodeURIComponent(query) + '&desc=short&r=json';
        fetch(url)
            .then(response => response.json())
            .then(json => {
                callback(json.Search);
                self.settings.load = null;
                console.log(url)
            }).catch(()=>{
            callback();

        });
    },
    // custom rendering function for options
    render: {
        option: function(item, escape) {
            return `<div><span class="ml-5">${ escape(item.Name) } - </span><span>${ escape(item.Description) }</span></div>`;
        },

        item: function(item, escape) {
            return `<div><span class="ml-5">${ escape(item.Name) } - </span><span>${ escape(item.Description) }</span></div>`;
        },
    },
});
