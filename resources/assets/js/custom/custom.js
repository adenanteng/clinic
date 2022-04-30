'use strict';

let source = null;
let jsrender = require('jsrender');
window.TomSelect = require('tom-select')

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
});

$(document).ajaxComplete(function () {
    // Required for Bootstrap tooltips in DataTables
    $('[data-toggle="tooltip"]').tooltip({
        'html': true,
        'offset': 10,
    });
});

$(document).on('select2:open', () => {
    let allFound = document.querySelectorAll('.select2-container--open .select2-search__field');
    allFound[allFound.length - 1].focus();
});

$(document).on('focus', '.select2.select2-container', function (e) {
    let isOriginalEvent = e.originalEvent; // don't re-open on closing focus event
    let isSingleSelect = $(this).find('.select2-selection--single').length > 0; // multi-select will pass focus to input

    if (isOriginalEvent && isSingleSelect) {
        $(this).siblings('select:enabled').select2('open');
    }
});

if (isSetFirstFocus) {
    $('input:text:not([readonly="readonly"])').first().focus();
}

$(function () {
    $('.modal').on('shown.bs.modal', function () {
        if ($(this).attr('class') != 'modal fade event-modal show') {
            $(this).find('input:text,input:password').first().focus();
        }
    });
});

toastr.options = {
    'closeButton': true,
    'debug': false,
    'newestOnTop': false,
    'progressBar': true,
    'positionClass': 'toast-top-right',
    'preventDuplicates': false,
    'onclick': null,
    'showDuration': '300',
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

window.resetModalForm = function (formId, validationBox) {
    $(formId)[0].reset();
    $('select.select2Selector').each(function (index, element) {
        let drpSelector = '#' + $(this).attr('id');
        $(drpSelector).val('');
        $(drpSelector).trigger('change');
    });
    $(validationBox).hide();
};

window.printErrorMessage = function (selector, errorResult) {
    $(selector).show().html('');
    $(selector).text(errorResult.responseJSON.message);
};

window.manageAjaxErrors = function (data) {
    var errorDivId = arguments.length > 1 && arguments[1] !== undefined
        ? arguments[1]
        : 'editValidationErrorsBox';
    if (data.status == 404) {
        toastr.error(data.responseJSON.message);
    } else {
        printErrorMessage('#' + errorDivId, data);
    }
};

window.displaySuccessMessage = function (message) {
    toastr.success(message);
};

window.displayErrorMessage = function (message) {
    toastr.error(message);
};

window.deleteItem = function (url, tableId, header) {
    var callFunction = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;
    Swal.fire({
        title: 'Delete !',
        text: 'Are you sure want to delete this "' + header + '" ?',
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonColor: '#266CB0',
        showLoaderOnConfirm: true,
        cancelButtonText: 'No, Cancel',
        confirmButtonText: 'Yes, Delete!',
    }).then(function (result) {
        if (result.isConfirmed) {
            deleteItemAjax(url, tableId, header, callFunction);
        }
    });
};

function deleteItemAjax (url, tableId, header, callFunction = null) {
    $.ajax({
        url: url,
        type: 'DELETE',
        dataType: 'json',
        success: function (obj) {
            if (obj.success) {
                if ($(tableId).DataTable().data().count() == 1) {
                    $(tableId).DataTable().page('previous').draw('page');
                } else {
                    $(tableId).DataTable().ajax.reload(null, false);
                }
            }
            Swal.fire({
                title: 'Deleted!',
                text: header + ' has been deleted.',
                icon: 'success',
                confirmButtonColor: '#266CB0',
                timer: 2000,
            });
            if (callFunction) {
                eval(callFunction);
            }
        },
        error: function (data) {
            Swal.fire({
                title: 'Error',
                icon: 'error',
                text: data.responseJSON.message,
                type: 'error',
                confirmButtonColor: '#266CB0',
                timer: 5000,
            });
        },
    });
}

window.format = function (dateTime) {
    var format = arguments.length > 1 && arguments[1] !== undefined
        ? arguments[1]
        : 'DD-MMM-YYYY';
    return moment(dateTime).format(format);
};

window.processingBtn = function (selecter, btnId, state = null) {
    var loadingButton = $(selecter).find(btnId);
    if (state === 'loading') {
        loadingButton.button('loading');
    } else {
        loadingButton.button('reset');
    }
};

window.prepareTemplateRender = function (templateSelector, data) {
    let template = jsrender.templates(templateSelector);
    return template.render(data);
};

window.isValidFile = function (inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
        $(inputSelector).val('');
        $(validationMessageSelector).removeClass('d-none');
        $(validationMessageSelector).
            html('The image must be a file of type: jpeg, jpg, png.').
            show();
        $(validationMessageSelector).delay(5000).slideUp(300);

        return false;
    }
    $(validationMessageSelector).hide();
    return true;
};

window.displayPhoto = function (input, selector) {
    let displayPreview = true;
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            let image = new Image();
            image.src = e.target.result;
            image.onload = function () {
                $(selector).attr('src', e.target.result);
                displayPreview = true;
            };
        };
        if ((input.files[0].size) > 2097152) {
            displayErrorMessage('Icon size should be less than 2 MB');

            return false;
        }
        if (displayPreview) {
            reader.readAsDataURL(input.files[0]);
            $(selector).show();
        }
    }
};
window.removeCommas = function (str) {
    return str.replace(/,/g, '');
};

window.DatetimepickerDefaults = function (opts) {
    return $.extend({}, {
        sideBySide: true,
        ignoreReadonly: true,
        icons: {
            close: 'fa fa-times',
            time: 'fa fa-clock-o',
            date: 'fa fa-calendar',
            up: 'fa fa-arrow-up',
            down: 'fa fa-arrow-down',
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-clock-o',
            clear: 'fa fa-trash-o',
        },
    }, opts);
};

window.isEmpty = (value) => {
    return value === undefined || value === null || value === '';
};

window.screenLock = function () {
    $('#overlay-screen-lock').show();
    $('body').css({ 'pointer-events': 'none', 'opacity': '0.6' });
};

window.screenUnLock = function () {
    $('body').css({ 'pointer-events': 'auto', 'opacity': '1' });
    $('#overlay-screen-lock').hide();
};

window.onload = function () {
    window.startLoader = function () {
        $('.infy-loader').show();
    };

    window.stopLoader = function () {
        $('.infy-loader').hide();
    };

// infy loader js
    stopLoader();
}
window.setBtnLoader = function (btnLoader) {
    if(btnLoader.attr('data-old-text')){
        btnLoader.html(btnLoader.attr('data-old-text')).prop('disabled',false);
        btnLoader.removeAttr('data-old-text');
        return;
    }
    btnLoader.attr('data-old-text',btnLoader.text());
    btnLoader.html('<i class="icon-line-loader icon-spin m-0"></i>').prop('disabled',true);
}
window.setAdminBtnLoader = function (btnLoader) {
    if(btnLoader.attr('data-old-text')){
        btnLoader.html(btnLoader.attr('data-old-text')).prop('disabled',false);
        btnLoader.removeAttr('data-old-text');
        return;
    }
    btnLoader.attr('data-old-text',btnLoader.text());
    btnLoader.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').prop('disabled',true);
}
$(document).ready(function () {
    // script to active parent menu if sub menu has currently active
    let hasActiveMenu = $(document).
        find('.nav-item.dropdown ul li').
        hasClass('active');
    if (hasActiveMenu) {
        $(document).
            find('.nav-item.dropdown ul li.active').
            parent('ul').
            css('display', 'block');
        $(document).
            find('.nav-item.dropdown ul li.active').
            parent('ul').
            parent('li').
            addClass('active');
    }
});

window.urlValidation = function (value, regex) {
    let urlCheck = (value == '' ? true : (value.match(regex)
        ? true
        : false));
    if (!urlCheck) {
        return false;
    }

    return true;
};

$('.languageSelection').on('click', function () {
    let languageName = $(this).data('prefix-value');

    $.ajax({
        type: 'POST',
        url: '/change-language',
        data: { languageName: languageName },
        success: function () {
            location.reload();
        },
    });
});



if ($(window).width() > 992) {
    $('.no-hover').on('click', function () {
        $(this).toggleClass('open');
    });
}

$('#register').on('click', function (e) {
    e.preventDefault();
    $('.open #dropdownLanguage').trigger('click');
    $('.open #dropdownLogin').trigger('click');
});
$('#language').on('click', function (e) {
    e.preventDefault();
    $('.open #dropdownRegister').trigger('click');
    $('.open #dropdownLogin').trigger('click');
});
$('#login').on('click', function (e) {
    e.preventDefault();
    $('.open #dropdownRegister').trigger('click');
    $('.open #dropdownLanguage').trigger('click');
});

window.checkSummerNoteEmpty = function (
    selectorElement, errorMessage, isRequired = 0) {
    if ($(selectorElement).summernote('isEmpty') && isRequired === 1) {
        displayErrorMessage(errorMessage);
        $(document).find('.note-editable').html('<p><br></p>');
        return false;
    } else if (!$(selectorElement).summernote('isEmpty')) {
        $(document).find('.note-editable').contents().each(function () {
            if (this.nodeType === 3) { // text node
                this.textContent = this.textContent.replace(/\u00A0/g, '');
            }
        });
        if ($(document).find('.note-editable').text().trim().length == 0) {
            $(document).find('.note-editable').html('<p><br></p>');
            $(selectorElement).val(null);
            if (isRequired === 1) {
                displayErrorMessage(errorMessage);

                return false;
            }
        }
    }

    return true;
};

window.preparedTemplate = function () {
    let source = $('#actionTemplate').html();
    window.preparedTemplate = Handlebars.compile(source);
};

window.ajaxCallInProgress = function () {
    ajaxCallIsRunning = true;
};

window.ajaxCallCompleted = function () {
    ajaxCallIsRunning = false;
};

window.avoidSpace = function (event) {
    let k = event ? event.which : window.event.keyCode;
    if (k == 32) {
        return false;
    }
};


$(document).on('click', '#readNotification', function (e) {
    e.preventDefault();
    e.stopPropagation();
    let notificationId = $(this).data('id');
    let notification = $(this);
    $.ajax({
        type: 'POST',
        url: route('notifications.read', notificationId),
        data: { notificationId: notificationId },
        success: function () {
            let count = parseInt($('#header-notification-counter').text());
            $('#header-notification-counter').text(count - 1);
            notification.remove();
            let notificationCounter = document.getElementsByClassName(
                'readNotification').length;
            $('#counter').text(notificationCounter);
            if (notificationCounter == 0) {
                $('.notification-message-counter').addClass('d-none');
                $('#readAllNotification').addClass('d-none');
                $('.empty-state').removeClass('d-none');
                $('.notification-toggle').removeClass('beep');
            }
            displaySuccessMessage('Notification read successfully.');
        },
        error: function (error) {
            manageAjaxErrors(error);
        },
    });
});

$(document).on('click', '#readAllNotification', function (e) {
    e.preventDefault();
    e.stopPropagation();
    $.ajax({
        type: 'POST',
        url: route('notifications.read.all'),
        success: function () {
            $('.notification-message-counter').text(0);
            $('.notification-message-counter').addClass('d-none');
            $('.readNotification').remove();
            $('#readAllNotification').addClass('d-none');
            $('.empty-state').removeClass('d-none');
            $('.notification-toggle').removeClass('beep');
            displaySuccessMessage('Notification read successfully.');
        },
        error: function (error) {
            manageAjaxErrors(error);
        },
    });
});

window.getAvgReviewHtmlData = function (reviews) {
    let ratingCount = reviews.length;
    let totalSumRating = 0;
    $(reviews).each(function (index, value) {
        totalSumRating += value.rating;
    });
    let avgRating = totalSumRating / ratingCount;
    let data = '<div class="avg-review-star-div d-flex align-self-center mb-1">';
    for (let i = 0; i < 5; i++) {
        if (avgRating > 0) {
            if (avgRating > 0.5) {
                data += '<i class="fas fa-star review-star"></i>';
            } else {
                data += '<i class="fas fa-star-half-alt review-star"></i>';
            }
        } else {
            data += '<i class="far fa-star review-star"></i>'
        }
        avgRating--
    }
    data += '</div>'
    return data
};

$(document).on('click', '.apply-dark-mode', function (e) {
    e.preventDefault()
    $.ajax({
        url: route('update-dark-mode'),
        type: 'get',
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                setTimeout(function () {
                    location.reload()
                }, 500)
            }
        }, error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

