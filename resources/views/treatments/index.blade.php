@extends('layouts.app')
@section('title')
    {{__('messages.treatments')}}
@endsection
@section('page_css')
    <link href="{{ mix('assets/css/app.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="container">
        @include('flash::message')
    </div>
    <x-layout.index>
        <x-slot name="filter">
            <x-layout.index-filter-status :status="$status" :model="\App\Models\Treatment::STATUS" />
        </x-slot>

        <x-slot name="button_url">{{ route('treatments.create') }}</x-slot>
        <x-slot name="button_title">{{__('messages.service.add_service')}}</x-slot>

        <div class="card-body pt-0">
            @include('treatments.table')
            @include('layouts.templates.actions')
            @include('treatments.templates.templates')
        </div>
    </x-layout.index>

@endsection
@section('page_js')
    <script>
        let all = '{{ \App\Models\Service::ALL }}';
        let active = '{{ \App\Models\Service::ACTIVE }}';
    </script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/treatments/treatments.js')}}"></script>
@endsection
