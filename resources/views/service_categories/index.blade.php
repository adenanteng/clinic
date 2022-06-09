@extends('layouts.app')
@section('title')
    {{__('messages.service_categories')}}
@endsection
@section('page_css')
    <link href="{{ mix('assets/css/app.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="container">
        @include('flash::message')
    </div>
    <x-layout.index>
        <x-slot name="button_id">createServiceCategory</x-slot>
        <x-slot name="button_title">{{__('messages.service_category.add_category')}}</x-slot>

        <div class="card-body pt-0">
            @include('service_categories.table')
            @include('service_categories.templates.templates')
        </div>
    </x-layout.index>
    @include('service_categories.create-modal')
    @include('service_categories.edit-modal')
@endsection
@section('page_js')
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/service_categories/service_categories.js')}}"></script>
@endsection
