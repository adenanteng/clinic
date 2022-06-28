@extends('layouts.app')
@section('title')
    {{__('messages.treatment.edit')}}
@endsection
@section('header_toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div>
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            </div>
            <div class="d-flex align-items-center py-1 ms-auto">
                <a href="{{ route('treatments.index') }}"
                   class="btn btn-sm btn-primary">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <x-layout.create-edit>
        {{ Form::model($treatment, ['route' => ['treatments.update', $treatment->id], 'method' => 'PUT', 'files' => true]) }}
        @include('treatments.fields')
        {{ Form::close() }}
    </x-layout.create-edit>
    @include('treatment_categories.create-modal')
@endsection
@section('page_js')
    <script src="{{mix('assets/js/treatments/create-edit.js')}}"></script>
@endsection
