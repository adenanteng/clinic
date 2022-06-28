@extends('layouts.app')
@section('title')
    {{__('messages.pharmacy.add')}}
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{asset('assets/css/plugins/flatpickr.css')}}">
@endsection
@section('header_toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div>
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            </div>
            <div class="d-flex align-items-center py-1 ms-auto">
                <a href="{{ route('pharmacies.index') }}"
                   class="btn btn-sm btn-primary">{{ __('messages.common.back') }}
                </a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <x-layout.create-edit>
        {{ Form::open(['route' => 'pharmacies.store','id' => 'saveForm']) }}
        @include('pharmacies.fields')
        {{ Form::close() }}
    </x-layout.create-edit>
@endsection
@section('page_js')
    <script src="{{asset('assets/js/plugins/flatpickr.js')}}"></script>
    <script src="{{mix('assets/js/pharmacies/create-edit.js')}}"></script>
@endsection
