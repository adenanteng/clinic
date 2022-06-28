@extends('layouts.app')
@section('title')
    {{__('messages.inventories')}}
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
            <x-layout.index-filter-status :status="$status" :model="\App\Models\Pharmacy::DEPT_TYPE" />
        </x-slot>

        <x-slot name="button_url">{{ route('inventories.create') }}</x-slot>
        <x-slot name="button_title">{{__('messages.inventory.add')}}</x-slot>

        <div class="card-body pt-0">
            @include('pharmacy_inventories.table')
            @include('layouts.templates.actions')
            @include('pharmacy_inventories.templates.templates')
        </div>
    </x-layout.index>

@endsection
@section('page_js')
    <script>
        {{--let all = '{{ \App\Models\Service::ALL }}';--}}
        {{--let active = '{{ \App\Models\Service::ACTIVE }}';--}}
    </script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/pharmacy_inventories/inventories.js')}}"></script>
@endsection
