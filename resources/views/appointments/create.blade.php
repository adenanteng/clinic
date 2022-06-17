@extends('layouts.app')
@section('title')
    {{__('messages.appointment.add_new_appointment')}}
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{asset('assets/css/plugins/flatpickr.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
@endsection
@section('header_toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div>
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            </div>
            <div class="d-flex align-items-center py-1 ms-auto">
                @role('patient')
                <a href="{{ route('patients.appointments.index') }}"
                   class="btn btn-sm btn-primary">{{ __('messages.common.back') }}</a>
                @else
                    <a href="{{ route('appointments.index') }}"
                       class="btn btn-sm btn-primary">{{ __('messages.common.back') }}</a>
                @endrole
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container" x-data="{ open:1 }">
            <div class="d-flex flex-column flex-lg-row">
                <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
                    <div class="card mb-10">
                        <div class="card-body p-6">
                            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                                <div class="me-7 mb-4">
                                    <div class="symbol symbol-100px symbol-lg-150px symbol-fixed position-relative align-items-center">
                                        <img class="object-cover" src="{{ $patient->profile }}" alt="image"/>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                        <div class="d-flex flex-column">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="text-gray-800 text-hover-primary fs-2 fw-bolder me-4">{{ $patient->user->full_name }}</span>
                                                <span class="btn btn-sm btn-light-success fw-bolder ms-2 fs-8 py-1 px-3">{{ $patient->patient_unique_id }}</span>
                                            </div>
                                            <div class="flex-wrap fw-bold fs-6 pe-2">

                                                <span class="text-gray-400 text-hover-primary me-2">
                                                    {{ $patient->user->gender_text}}
                                                </span>
                                                <span class="text-gray-400 text-hover-primary mb-2 me-2">
                                                    {{ $patient->user->age . ' tahun' }}
                                                </span>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex overflow-auto h-55px">
                                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary me-6 active" data-bs-toggle="tab" id="opd"
                                           href="#popd">{{ __('messages.appointment.opd') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary" data-bs-toggle="tab" id="ipd"
                                           href="#pipd">{{ __('messages.appointment.ipd') }}</a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="popd" role="tabpanel">
                            <div class="card mb-5 mb-xl-10" >
                                <div class="card-header border-0 cursor-pointer" role="button">
                                    <div class="card-title m-0">
                                        <h3 class="fw-bolder m-0">{{ __('messages.appointment.opd')  }}</h3>
                                    </div>
                                </div>
                                <div class="card-body p-6">
                                    @role('patient')
                                    {{ Form::open(['route' => 'patients.appointments.store','id' => 'addAppointmentForm']) }}
                                    @else
                                    {{ Form::open(['route' => 'appointments.store', 'id' => 'addAppointmentForm']) }}
                                    @endrole
                                    <div class="card-body p-9">
                                        @include('appointments.fields')
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane fade " id="pipd" role="tabpanel">
                            <div class="card mb-5 mb-xl-10" >
                                <div class="card-header border-0 cursor-pointer" role="button">
                                    <div class="card-title m-0">
                                        <h3 class="fw-bolder m-0">{{ __('messages.common.coming_soon')  }}</h3>
                                    </div>
                                </div>
                                <div class="card-body p-6">
                                    <span class="text-gray-800">Tunggu update berikutnya ya</span>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_js')
    <script src="{{asset('assets/js/plugins/flatpickr.js')}}"></script>
    <script>
        let manually = "{{ \App\Models\Appointment::MANUALLY }}";
        let isEdit = false;
        let userRole = '{{getLogInUser()->hasRole('patient')}}';
        let options = {
            'amount': 0, //  100 refers to 1
            'currency': 'IDR',
            'name': "{{getAppName()}}",
            'order_id': '',
            'description': '',
            'image': '{{ asset(getAppLogo()) }}', // logo here
            'prefill': {
                'email': '', // recipient email here
                'name': '', // recipient name here
                'contact': '', // recipient phone here
                'appointmentID': '', // appointmentID here
            },
            'readonly': {
                'name': 'true',
                'email': 'true',
                'contact': 'true',
            },
            'theme': {
                'color': '#4FB281',
            },
            'modal': {
                'ondismiss': function () {
                    displayErrorMessage('Appointment created successfully and payment not completed.');
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                },
            },
        }
    </script>
    <script src="{{mix('assets/js/appointments/create-edit.js')}}"></script>
@endsection

