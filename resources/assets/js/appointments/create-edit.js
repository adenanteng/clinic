'use strict';

let ready = $(document).ready(function () {
    let timezone_offset_minutes = new Date().getTimezoneOffset();
    timezone_offset_minutes = timezone_offset_minutes === 0
        ? 0 : -timezone_offset_minutes;

    $('#date').flatpickr({
        minDate: new Date(),
        disableMobile: true,
    });

    setTimeout(function () {
        if (isEdit) {
            $('#date').val(date).trigger('change');
            $('#serviceId').trigger('change');
            $('#doctorId').trigger('change');
        }
    }, 1000);

    let selectedDate;
    let selectedSlotTime;
    $('.no-time-slot').removeClass('d-none');

    function renderSlot () {
        selectedDate = $('#date').val();
        $('#slotData').html('');
        let url = !isEmpty(userRole)
            ? route('patients.doctor-session-time')
            : route('doctor-session-time');
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                'doctorId': $('#doctorId').val(),
                'date': selectedDate,
                'timezone_offset_minutes': timezone_offset_minutes,
            },
            success: function (result) {
                if (result.success) {
                    $.each(result.data['slots'], function (index, value) {
                        if (isEdit && fromTime == value) {
                            $('.no-time-slot').addClass('d-none');
                            $('#slotData').append(
                                '<span class="time-slot col-2  activeSlot" data-id="' +
                                value + '">' + value + '</span>');
                        } else {
                            $('.no-time-slot').addClass('d-none');
                            if (result.data['bookedSlot'] == null) {
                                $('#slotData').
                                    append(
                                        '<span class="time-slot col-2" data-id="' +
                                        value + '">' + value + '</span>');
                            } else {
                                if ($.inArray(value,
                                    result.data['bookedSlot']) !== -1) {
                                    $('#slotData').
                                        append(
                                            '<span class="time-slot col-2 bookedSlot " data-id="' +
                                            value + '">' + value + '</span>');
                                } else {
                                    $('#slotData').
                                        append(
                                            '<span class="time-slot col-2" data-id="' +
                                            value + '">' + value + '</span>');
                                }

                            }
                        }
                    });
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    }

    $(document).on('change', '#date', function () {
            // let data = $(this).val();
            isEmpty($('#doctorId').val()) ? $('#slotData').html('') : renderSlot();

        });

    $(document).on('change', '#doctorId', function () {
        isEmpty($('#date').val()) ? $('.no-time-slot').removeClass('d-none') : renderSlot();
    });

    $(document).on('change', '#serviceId', function () {
        // $('#date').val('');
        $('#slotData').html('');
        $('.no-time-slot').removeClass('d-none');
        let url = route('get-doctor');
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                'serviceId': $(this).val(),
            },
            success: function (result) {
                if (result.success) {
                    $('#date').removeAttr('disabled');
                    $('#doctorId').empty();
                    $('#doctorId').
                    append($('<option value=""></option>').
                    text('Pilih Dokter'));
                    $.each(result.data, function (i, v) {
                        $('#doctorId').
                        append($('<option></option>').
                        attr('value', v.id).
                        text(v.user.full_name));
                    });
                }
            },
        });
    });


    $(document).on('click', '.time-slot', function () {
        if ($('.time-slot').hasClass('activeSlot')) {
            $('.time-slot').removeClass('activeSlot');
            selectedSlotTime = $(this).addClass('activeSlot');
        } else {
            selectedSlotTime = $(this).addClass('activeSlot');
        }
        let fromToTime = $(this).attr('data-id').split('-');
        let fromTime = fromToTime[0];
        let toTime = fromToTime[1];
        $('#timeSlot').val('');
        $('#toTime').val('');
        $('#timeSlot').val(fromTime);
        $('#toTime').val(toTime);
    });

});

// $(document).on('submit', '#addAppointmentForm', function (e) {
//     e.preventDefault();
//     let data = new FormData($(this)[0]);
//     let btnSubmitEle = $(this).find('#submitBtn');
//     setAdminBtnLoader(btnSubmitEle);
//     $.ajax({
//         url: $(this).attr('action'),
//         type: 'POST',
//         data: data,
//         processData: false,
//         contentType: false,
//         success: function (mainResult) {
//             if (mainResult.success) {
//                 let appID = mainResult.data.appointmentId;
//                 displaySuccessMessage(mainResult.message);
//
//                 $('#addAppointmentForm')[0].reset();
//                 $('#doctorId').val('').trigger('change');
//
//                 if (mainResult.data.payment_type == paystack) {
//                     return location.href = mainResult.data.redirect_url;
//                 }
//
//                 if (mainResult.data.payment_type == paytmMethod) {
//                     window.location.replace(route('paytm.init', { 'appointmentId': appID }));
//                 }
//
//                 if (mainResult.data.payment_type == authorizeMethod) {
//                     return location.href = route('authorize.init',{'appointmentId': appID});
//                 }
//
//                 if (mainResult.data.payment_type == paypal) {
//                     $.ajax({
//                         type: 'GET',
//                         url: route('paypal.init'),
//                         data: { 'appointmentId': appID },
//                         success: function (result) {
//                             if (result.statusCode == 201) {
//                                 let redirectTo = '';
//
//                                 $.each(result.result.links,
//                                     function (key, val) {
//                                         if (val.rel == 'approve') {
//                                             redirectTo = val.href;
//                                         }
//                                     });
//                                 location.href = redirectTo;
//                             }
//                         },
//                         error: function (result) {
//                         },
//                         complete: function () {
//                         },
//                     });
//                 }
//
//                 if (mainResult.data.payment_type == manually) {
//                     setTimeout(function () {
//                         location.href = mainResult.data.url;
//                     }, 1500);
//                 }
//
//                 if (mainResult.data.payment_type == stripeMethod) {
//                     let sessionId = mainResult.data[0].sessionId;
//                     stripe.redirectToCheckout({
//                         sessionId: sessionId,
//                     }).then(function (mainResult) {
//                         manageAjaxErrors(mainResult);
//                     });
//                 }
//
//                 if (mainResult.data.payment_type == razorpayMethod) {
//                     $.ajax({
//                         type: 'POST',
//                         url: route('razorpay.init'),
//                         data: { 'appointmentId': appID },
//                         success: function (result) {
//                             if (result.success) {
//                                 let { id, amount, name, email, contact } = result.data
//                                 options.amount = amount
//                                 options.order_id = id
//                                 options.prefill.name = name
//                                 options.prefill.email = email
//                                 options.prefill.contact = contact
//                                 options.prefill.appointmentID = appID
//
//                                 let razorPay = new Razorpay(options)
//                                 razorPay.open()
//                                 razorPay.on('payment.failed', storeFailedPayment)
//                             }
//                         },
//                         error: function (result) {
//                         },
//                         complete: function () {
//                         },
//                     })
//                 }
//             }
//         },
//         error: function (result) {
//             displayErrorMessage(result.responseJSON.message);
//         },
//         complete: function () {
//             setAdminBtnLoader(btnSubmitEle);
//         },
//     });
// });


