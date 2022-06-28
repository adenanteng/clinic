@extends('layouts.app')
@section('title')
    {{__('messages.service.add_service')}}
@endsection
@section('header_toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div>
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            </div>
            <div class="d-flex align-items-center py-1 ms-auto">
                <a href="{{ route('services.index') }}"
                   class="btn btn-sm btn-primary">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <x-layout.create-edit>
        {{ Form::open(['route' => 'services.store', 'files' => true]) }}
        @include('services.fields')
        {{ Form::close() }}
    </x-layout.create-edit>
    @include('service_categories.create-modal')
@endsection
@section('page_js')
    <script src="{{mix('assets/js/services/create-edit.js')}}"></script>
@endsection
