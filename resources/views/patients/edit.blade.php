@extends('layouts.app')
@section('title')
    {{ __('messages.patient.edit') }}
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{asset('assets/css/plugins/flatpickr.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/intl/css/intlTelInput.css') }}">
@endsection
@section('header_toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div>
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            </div>
            <div class="d-flex align-items-center py-1 ms-auto">
                <a href="{{ route('patients.index') }}" class="btn btn-sm btn-primary">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <x-layout.create-edit>
        {{ Form::model($patient, ['route' => ['patients.update', $patient->id], 'method' => 'patch', 'files' => 'true','id'=>'editPatientForm']) }}
            @include('patients.fields')
        {{ Form::close() }}
    </x-layout.create-edit>
    @endsection
@section('page_js')
    <script src="{{ asset('assets/js/intl/js/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('assets/js/intl/js/utils.min.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let countryId = "{{ !empty($patient->address->country_id) ? $patient->address->country_id : null}}";
        let stateId = "{{ !empty($patient->address->state_id) ? $patient->address->state_id : null}}";
        let cityId = "{{ !empty($patient->address->city_id) ? $patient->address->city_id : null}}";
        let isEdit = true;
        let utilsScript = "{{asset('assets/js/intl/js/utils.min.js')}}";
        let phoneNo = "{{ !empty($patient->user) ? (($patient->user->region_code).($patient->user->contact)) : null }}";
        let backgroundImg = "{{ asset('web/media/avatars/male.png') }}";
    </script>
    <script src="{{asset('assets/js/plugins/flatpickr.js')}}"></script>
    <script src="{{ asset('assets/js/custom/phone-number-country-code.js') }}"></script>
    <script src="{{mix('assets/js/patients/create-edit.js')}}"></script>
@endsection
