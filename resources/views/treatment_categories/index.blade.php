@extends('layouts.app')
@section('title')
    {{__('messages.treatment_categories')}}
@endsection
@section('page_css')
    <link href="{{ mix('assets/css/app.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="container">
        @include('flash::message')
    </div>
    <x-layout.index>
        <x-slot name="button_id">createTreatmentCategory</x-slot>
        <x-slot name="button_title">{{__('messages.treatment_category.add')}}</x-slot>

        <div class="card-body pt-0">
            @include('treatment_categories.table')
            @include('treatment_categories.templates.templates')
        </div>
    </x-layout.index>
    @include('treatment_categories.create-modal')
    @include('treatment_categories.edit-modal')
@endsection
@section('page_js')
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/treatment_categories/treatment_categories.js')}}"></script>
@endsection
