<div class="row gx-10 mb-5">
    @role('patient')
        {{ Form::hidden('patient_id',$patient->id) }}
        {{ Form::hidden('status',\App\Models\Appointment::BOOKED) }}
    @else
        {{ Form::hidden('status',\App\Models\Appointment::BOOKED) }}
        @if(!empty($patient->user))
            {{ Form::hidden('patient_id',$patient->id) }}
        @else
            <div class="d-flex col-sm-12 col-lg-6 flex-column mb-7 fv-row">
                {{ Form::label('Patient',__('messages.appointment.patient').':' ,['class' => 'fs-6 fw-bolder text-gray-700 fw-bold mb-2 required']) }}
                {{ Form::select('patient_id', $data['patients'], null,['class' => 'form-control form-control-solid form-select', 'data-control'=>"select2",'placeholder' => 'Select Patient']) }}
            </div>
        @endif
    @endrole
        <div class="d-flex col-lg-6 col-sm-12 flex-column mb-5 fv-row">
            {{ Form::label('Date',__('messages.appointment.date').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
            {{ Form::text('date', null,['class' => 'form-control form-control-solid date','placeholder' => 'Select Date', 'id'=>'date', 'required','autocomplete'=>'off']) }}
        </div>
        <div class="d-flex col-lg-6 col-sm-12 flex-column mb-5 fv-row">
            {{ Form::label('Service',__('messages.appointment.service').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
            {{ Form::select('service_id', $data['services'], null,['class' => 'form-control form-control-solid form-select', 'data-control'=>"select2", 'id'=> 'serviceId','placeholder' => 'Select Service','required']) }}
        </div>
        <div class="d-flex col-sm-12 col-lg-6 flex-column mb-5 fv-row">
            {{ Form::label('Doctor',__('messages.doctor.doctor').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
            {{ Form::select('doctor_id', [], null,['class' => 'form-control form-control-solid form-select', 'id' => 'doctorId', 'data-control'=>"select2", 'required','placeholder' => 'Select Doctor']) }}
        </div>
    @php
        $styleCss = 'style';
    @endphp
    <div class="col-12 form-group">
        {{ Form::label('Available Slots',__('messages.appointment.available_slot').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
        <div class="mb-0 d-inline-flex align-items-center ms-2">
            <div class="bg-danger  rounded-circle" {{ $styleCss }}="height: 10px;width: 10px"></div>
            <span class="ms-2">{{__('messages.appointment.booked')}}</span>
            <div class="bg-success ms-2  rounded-circle" {{ $styleCss }}="height: 10px;width: 10px"></div>
            <span class="ms-2">{{__('messages.appointment.available')}}</span>
        </div>
        <div class="fc-timegrid-slot ps-5 pe-5 form-control form-control-solid h-300px overflow-auto">
            {{ Form::hidden('from_time', null,['id'=>'timeSlot',]) }}
            {{ Form::hidden('to_time', null,['id'=>'toTime',]) }}
            <div class="text-center d-flex flex-wrap justify-content-center px-3" id="slotData"></div>
            <span class="justify-content-center d-flex p-20 text-primary no-time-slot">{{__('messages.appointment.no_slot_found')}}</span>
        </div>
    </div>
    <div class="col-12 mb-5 mt-5">
        {{ Form::label('Description',__('messages.appointment.description').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{  Form::textarea('description', null, ['class'=> 'form-control form-control-solid','rows'=> 10,'placeholder'=>'Description' ])}}
    </div>
    <div class="d-flex col-lg-6 col-sm-12 flex-column mb-7 mt-4 fv-row">
        {{ Form::label('Payment Type',__('Payment Method').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
        {{ Form::select('payment_type', getPatientPayment($patient->id), null,['class' => 'form-control form-control-solid form-select', 'data-control'=>"select2",'placeholder' => 'Select Payment Method','required']) }}
    </div>
{{--    <div class="col-lg-6 col-sm-12 mt-4 mb-5">--}}
{{--        {{ Form::label('Total Payable Amount',__('messages.appointment.total_payable_amount').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}--}}
{{--        <div class="input-group">--}}
{{--            <div class="input-group-text border-0">--}}
{{--                <a class="fw-bolder text-gray-500">{{ getCurrencyIcon() }}</a>--}}
{{--            </div>--}}
{{--            {{ Form::number('payable_amount', 15000,['class' => 'form-control form-control-solid','placeholder' => 'Biaya Adm.', 'required']) }}--}}

{{--        </div>--}}
{{--    </div>--}}
    <div class="d-flex">
        {{ Form::button(__('messages.common.save'),['type' => 'submit','class' => 'btn btn-primary me-2']) }}
        <a href="{{ url()->previous() }}" type="reset"
           class="btn btn-light btn-active-light-primary me-2">{{__('messages.common.discard')}}</a>
    </div>
{{--<x-layout.form-submit />--}}
</div>
