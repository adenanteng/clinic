@extends('layouts.app')
@section('title')
    {{ __('messages.visits') }}
@endsection
@section('page_css')
    <link href="{{ mix('assets/css/app.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="container">
        @include('flash::message')
    </div>
    <x-layout.index>
{{--        <x-slot name="filter">--}}
{{--            <x-layout.index-filter-appointment :appointmentStatus="$appointmentStatus" />--}}
{{--        </x-slot>--}}
        <div class="card-body pt-0">
            @include('visits.table')
            @include('visits.templates.templates')
        </div>
    </x-layout.index>
@endsection
@section('page_js')
    <script src="{{asset('assets/js/custom/custom-datatable.js')}}"></script>
@endsection
@section('scripts')
    <script>
        let visitUrl = "{{ route('visits.index') }}";
        {{--let doctorVisitUrl = "{{ route('doctors.visits.index') }}";--}}
    </script>
    @if(getLogInUser()->hasRole('doctor'))
        <script>
            let doctorRole = '{{getLogInUser()->hasRole('doctor')}}';
        </script>
        <script src="{{mix('assets/js/visits/doctor-visit.js')}}"></script>
    @else
        <script src="{{mix('assets/js/visits/visits.js')}}"></script>
    @endif
@endsection
