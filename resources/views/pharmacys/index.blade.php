@extends('layouts.app')
@section('title')
    {{__('messages.pharmacys')}}
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{asset('assets/css/plugins/daterangepicker.css')}}">
    <link href="{{ mix('assets/css/app.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="container">
        @include('flash::message')
    </div>
    <x-layout.index>
        <x-slot name="status">
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="d-flex justify-content-end">
                        <div class="d-flex align-items-center">
                            <span class="w-10px h-10px bg-primary rounded-circle me-1"></span>
                            <span class="me-4">{{\App\Models\Pharmacy::PRESCRIPTION_STATUS[2]}}</span>
                            <span class="w-10px h-10px bg-success rounded-circle me-1"></span>
                            <span class="me-4">{{\App\Models\Pharmacy::PRESCRIPTION_STATUS[3]}}</span>
                            <span class="w-10px h-10px bg-warning rounded-circle me-1"></span>
                            <span class="me-4">{{\App\Models\Pharmacy::PRESCRIPTION_STATUS[4]}}</span>
                            <span class="w-10px h-10px bg-danger rounded-circle me-1"></span>
                            <span class="me-4">{{\App\Models\Pharmacy::PRESCRIPTION_STATUS[5]}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="filter">
            <x-layout.index-filter-appointment :appointmentStatus="$appointmentStatus" />
        </x-slot>

        <x-slot name="button_url">{{ route('pharmacys.create') }}</x-slot>
        <x-slot name="button_title">{{__('messages.common.add')}}</x-slot>

        <div class="card-body pt-0">
            @include('pharmacys.table')
            @include('layouts.templates.actions')
            @include('pharmacys.templates.templates')
        </div>
    </x-layout.index>

@endsection
@section('page_js')
    <script src="{{asset('assets/js/plugins/daterangepicker.js')}}"></script>

    <script>
        let userRole = '{{getLogInUser()->hasRole('patient')}}';
    </script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script>
        let book = "{{ \App\Models\Appointment::ALL }}";
        let allPaymentCount = "{{\App\Models\Appointment::ALL_PAYMENT}}";
        let checkIn = "{{ \App\Models\Appointment::CHECK_IN }}";
        let checkOut = "{{ \App\Models\Appointment::CHECK_OUT }}";
        let cancel = "{{ \App\Models\Appointment::CANCELLED }}";
        let adminRole = true;
        let pending = "{{\App\Models\Appointment::PENDING}}";
        let paid = "{{\App\Models\Appointment::PAID}}";
    </script>
    <script src="{{mix('assets/js/pharmacys/pharmacys.js')}}"></script>

@endsection
