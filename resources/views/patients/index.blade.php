@extends('layouts.app')
@section('title')
    {{ __('messages.patients') }}
@endsection
@section('page_css')
    <link href="{{ mix('assets/css/app.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="container">
        @include('flash::message')
    </div>
    <x-layout.index>
        <x-slot name="button_url">{{ route('patients.create') }}</x-slot>
        <x-slot name="button_title">{{__('messages.common.add')}}</x-slot>

        <div class="card-body pt-0">
            @include('patients.table')
            @include('layouts.templates.actions')
        </div>
    </x-layout.index>
@endsection
@section('page_js')
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/patients/patients.js')}}"></script>
@endsection
