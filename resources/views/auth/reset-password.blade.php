@extends('layouts.auth')
@section('title')
    Reset Password
@endsection
@section('content')
    <!--begin::Main-->
    <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
        <a class="mb-12">
            <img alt="Logo" src="{{ asset(getAppLogo()) }}" class="h-45px"/>
        </a>
        <div class="w-lg-500px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">

            <form class="form w-100" method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="fv-row mb-10">
                    <label class="form-label fs-6 fw-bolder text-dark" for="email">{{__('messages.web.email')}}</label>
                    <input id="email" class="form-control form-control-lg form-control-solid"
                           value="{{ old('email', $request->email) }}"
                           type="email" name="email" required autocomplete="off" autofocus/>

                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                </div>

                <!-- Password -->
                <div class="fv-row mb-10">
                    <label class="form-label fw-bolder text-dark fs-6 mb-0"
                           for="password">{{__('messages.patient.password')}}</label>
                    <input id="password" class="form-control form-control-lg form-control-solid"
                           type="password"
                           name="password"
                           required autocomplete="off"/>
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="fv-row mb-5">
                    <label class="form-label fw-bolder text-dark fs-6"
                           for="password_confirmation">{{__('messages.patient.confirm_password')}}</label>
                    <input class="form-control form-control-lg form-control-solid" type="password"
                           id="password_confirmation" name="password_confirmation" autocomplete="off"/>
                    <div class="invalid-feedback">
                        {{ $errors->first('password_confirmation') }}
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                        <span class="indicator-label">{{ __('Reset Password') }}</span>
                        <span class="indicator-progress">{{__('messages.common.please_wait')}}
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>

                </div>

            </form>
        </div>
    </div>

    <!--end::Main-->
@endsection

