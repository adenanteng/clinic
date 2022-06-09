@php $styleCss = 'style'; @endphp
<div class="position-relative mb-5 mx-3 mt-2 sidebar-search-box">
{{--    <span class="svg-icon svg-icon-1 svg-icon-primary position-absolute top-50 translate-middle ms-9">--}}
{{--        <svg xmlns="http://www.w3.org/2000/svg" width="24"--}}
{{--             height="24" viewBox="0 0 24 24" fill="none">--}}
{{--            <rect opacity="0.5" x="17.0365" y="15.1223"--}}
{{--                  width="8.15546" height="2" rx="1"--}}
{{--                  transform="rotate(45 17.0365 15.1223)"--}}
{{--                  fill="black"></rect>--}}
{{--            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"--}}
{{--                  fill="black"></path>--}}
{{--        </svg>--}}
{{--    </span>--}}
{{--    <input type="text" class="form-control form-control-lg form-control-solid ps-15" id="menuSearch" name="search"--}}
{{--           placeholder="Search"--}}
{{--            {{ $styleCss }}="background-color: #2A2B3A;border: none;color: #FFFFFF"--}}
{{--    autocomplete="off">--}}
</div>
<div class="no-record text-white text-center d-none">{{ __('messages.no_matching_records_found') }}</div>
@can('manage_admin_dashboard')
    @role('clinic_admin')
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{ Request::is('admin/dashboard*') ? 'active' : '' }}"
           href="{{ route('admin.dashboard') }}">
        <span class="menu-icon">
            <i class="fas fa fa-digital-tachograph fs-3"></i>
        </span>
            <span class="menu-title">{{ __('messages.dashboard') }}</span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            <li class="{{ Request::is('dashboard*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('admin.dashboard') }}">
                    <span class="menu-title {{ Request::is('admin/dashboard*') ? 'text-primary' : '' }}">{{ __('messages.dashboard') }}</span>
                </a>
            </li>
        </ul>
    </div>
    @else
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{ Request::is('doctors/dashboard*') ? 'active' : '' }}"
           href="{{ route('doctors.dashboard') }}">
        <span class="menu-icon">
            <i class="fas fa fa-digital-tachograph fs-3"></i>
        </span>
            <span class="menu-title">{{ __('messages.dashboard') }}</span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            <li class="{{ Request::is('doctors/dashboard*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('doctors.dashboard') }}">
                    <span class="menu-title {{ Request::is('doctors/dashboard*') ? 'text-primary' : '' }}">{{ __('messages.dashboard') }}</span>
                </a>
            </li>
        </ul>
    </div>
    @endrole
@endcan
@can('manage_patients')
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{ Request::is('patients*') ? 'active' : '' }}"
           href="{{ route('patients.index') }}">
        <span class="menu-icon">
            <i class="fas fa-hospital-user fs-3"></i>
        </span>
            <span class="menu-title">{{ __('messages.administrations') }}</span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            <li class="{{ Request::is('patients*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('patients.index') }}">
                    <span class="menu-title {{ Request::is('patients*') ? 'text-primary' : '' }}">{{ __('messages.patients') }}</span>
                </a>
            </li>
        </ul>
    </div>
@endcan
@can('manage_appointments')
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{ (Request::is('appointments*') || Request::is('admin-appointments-calendar*')) ? 'active' : '' }}"
           href="{{ route('appointments.index') }}">
        <span class="menu-icon">
            <i class="fas fa-calendar-alt fs-3"></i>
        </span>
            <span class="menu-title">{{ __('messages.appointments') }}</span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            @foreach(getAllDepartment() as $depart)
            <li class="{{ (Request::is('appointments/'.$depart->slug.'*') || Request::is('admin-appointments-calendar*')) ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ url('appointments/'.$depart->slug) }}">
                    <span class="menu-title {{ (Request::is('appointments/'.$depart->slug.'*') || Request::is('admin-appointments-calendar*')) ? 'text-primary' : '' }}">{{ __('messages.appointment.'.$depart->slug) }}</span>
                </a>
            </li>
            @endforeach

{{--            <li class="{{ (Request::is('appointments/opd*') || Request::is('admin-appointments-calendar*')) ? 'menu-li-hover-color' : '' }}">--}}
{{--                <a class="menu-link py-3" href="{{ route('appointments.opd') }}">--}}
{{--                    <span class="menu-title {{ (Request::is('appointments/opd*') || Request::is('admin-appointments-calendar*')) ? 'text-primary' : '' }}">{{ __('messages.appointment.opd') }}</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="{{ (Request::is('appointments/ipd*') || Request::is('admin-appointments-calendar*')) ? 'menu-li-hover-color' : '' }}">--}}
{{--                <a class="menu-link py-3" href="{{ route('appointments.ipd') }}">--}}
{{--                    <span class="menu-title {{ (Request::is('appointments/ipd*') || Request::is('admin-appointments-calendar*')) ? 'text-primary' : '' }}">{{ __('messages.appointment.ipd') }}</span>--}}
{{--                </a>--}}
{{--            </li>--}}
        </ul>

    </div>
@endcan
@if(!getLogInUser()->hasRole('doctor'))
    @can('manage_patient_visits')
        <div class="menu-item menu-search sidebar-dropdown">
            <a class="menu-link {{ Request::is('visits*') ? 'active' : '' }}" href="{{ route('visits.index') }}">
                <span class="menu-icon">
                    <i class="fas fa-procedures fs-3"></i>
                </span>
                <span class="menu-title">{{__('messages.visits')}}</span>
            </a>
            <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
                <li class="{{ Request::is('visits*') ? 'menu-li-hover-color' : '' }}">
                    <a class="menu-link py-3" href="{{ route('visits.index') }}">
                        <span class="menu-title {{ Request::is('visits*') ? 'text-primary' : '' }}">{{ __('messages.visits') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    @endcan
@endif
@can('manage_pharmacys')
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{ Request::is('pharmacys*') ? 'active' : '' }}" href="{{ route('pharmacys.index') }}">
                <span class="menu-icon">
                    <i class="fas fa-capsules fs-3"></i>
                </span>
            <span class="menu-title">{{__('messages.pharmacys')}}</span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            <li class="{{ Request::is('visits*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('pharmacys.index') }}">
                    <span class="menu-title {{ Request::is('pharmacys*') ? 'text-primary' : '' }}">{{ __('messages.transactions') }}</span>
                </a>
            </li>
        </ul>
    </div>
@endcan
@can('manage_transactions')
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{ (Request::is('transactions*')) ? 'active' : '' }}"
           href="{{ route('transactions') }}">
        <span class="menu-icon">
            <i class="fas fa-money-bill-wave"></i>
        </span>
            <span class="menu-title">{{ __('messages.transactions') }}</span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            <li class="{{ Request::is('transactions*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('transactions') }}">
                    <span class="menu-title {{ Request::is('transactions*') ? 'text-primary' : '' }}">{{ __('messages.transactions') }}</span>
                </a>
            </li>
        </ul>
    </div>
@endcan
@can('manage_doctors')
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{(Request::is('doctors*')||Request::is('doctor-sessions*')||Request::is('doctor-sessions*')) ? 'active' : '' }}"
           href="{{ route('doctors.index') }}">
        <span class="menu-icon">
            <i class="fas fa-user-md fs-3"></i>
        </span>
        <span class="menu-title">{{ __('messages.doctors') }}
            <span class="d-none">{{ __('messages.doctor_sessions') }}</span>
        </span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            <li class="{{ Request::is('doctors*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('doctors.index') }}">
                    <span class="menu-title {{ Request::is('doctors*') ? 'text-primary' : '' }}">{{ __('messages.doctors') }}</span>
                </a>
            </li>
            <li class="{{ Request::is('doctor-sessions*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('doctor-sessions.index') }}">
                    <span class="menu-title {{ Request::is('doctor-sessions*') ? 'text-primary' : '' }}">{{ __('messages.doctor_sessions') }}</span>
                </a>
            </li>
        </ul>
    </div>
@endcan
@can('manage_staff')
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{ Request::is('staff*') ? 'active' : '' }}" href="{{ route('staff.index') }}">
        <span class="menu-icon">
            <i class="fas fa-users fs-3"></i>
        </span>
            <span class="menu-title">{{__('messages.staffs')}}</span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            <li class="{{ Request::is('staff*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('staff.index') }}">
                    <span class="menu-title {{ Request::is('staff*') ? 'text-primary' : '' }}">{{ __('messages.staffs') }}</span>
                </a>
            </li>
        </ul>
    </div>
@endcan
@can('manage_services')
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{ (Request::is('services*') || Request::is('service-categories*')) ? 'active' : '' }}"
           href="{{ route('services.index') }}">
        <span class="menu-icon">
            <i class="fas fa-user-cog fs-3"></i>
        </span>
            <span class="menu-title">{{__('messages.services')}}<span
                        class="d-none">{{ __('messages.service_categories') }}</span></span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            <li class="{{ Request::is('services*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('services.index') }}">
                    <span class="menu-title {{ Request::is('services*') ? 'text-primary' : '' }}">{{ __('messages.services') }}</span>
                </a>
            </li>
            <li class="{{ Request::is('service-categories*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('service-categories.index') }}">
                    <span class="menu-title {{ Request::is('service-categories*') ? 'text-primary' : '' }}">{{ __('messages.service_categories') }}</span>
                </a>
            </li>
        </ul>
    </div>
@endcan
@can('manage_services')
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{ (Request::is('treatments*') || Request::is('treatment-categories*')) ? 'active' : '' }}"
           href="{{ route('treatments.index') }}">
        <span class="menu-icon">
            <i class="fas fa-user-cog fs-3"></i>
        </span>
            <span class="menu-title">{{__('messages.treatments')}}<span
                    class="d-none">{{ __('messages.treatment_categories') }}</span></span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            <li class="{{ Request::is('treatments*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('treatments.index') }}">
                    <span class="menu-title {{ Request::is('treatments*') ? 'text-primary' : '' }}">{{ __('messages.treatments') }}</span>
                </a>
            </li>
            <li class="{{ Request::is('treatment-categories*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('treatment-categories.index') }}">
                    <span class="menu-title {{ Request::is('treatment-categories*') ? 'text-primary' : '' }}">{{ __('messages.treatment_categories') }}</span>
                </a>
            </li>
        </ul>
    </div>
@endcan
@can('manage_specialities')
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{ Request::is('specializations*') ? 'active' : '' }}"
           href="{{ route('specializations.index') }}">
        <span class="menu-icon">
            <i class="fas fa-user-shield fs-3"></i>
        </span>
            <span class="menu-title">{{__('messages.specializations')}}</span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            <li class="{{ Request::is('specializations*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('specializations.index') }}">
                    <span class="menu-title {{ Request::is('specializations*') ? 'text-primary' : '' }}">{{ __('messages.specializations') }}</span>
                </a>
            </li>
        </ul>
    </div>
@endcan
@can('manage_front_cms')
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{ (Request::is('enquiries*') ? 'active' : '') }}"
           href="{{ route('enquiries.index') }}">
        <span class="menu-icon">
            <i class="fas fa-question-circle fs-3"></i>
        </span>
            <span class="menu-title">{{ __('messages.enquiries') }}</span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            <li class="{{ Request::is('enquiries*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('enquiries.index') }}">
                    <span class="menu-title {{ Request::is('enquiries*') ? 'text-primary' : '' }}">{{ __('messages.enquiries') }}</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{ (Request::is('subscribers*') ? 'active' : '') }}"
           href="{{ route('subscribers.index') }}">
        <span class="menu-icon">
            <i class="fab fa-stripe-s fs-3"></i>
        </span>
            <span class="menu-title">{{ __('messages.subscribers') }}</span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            <li class="{{ Request::is('subscribers*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('subscribers.index') }}">
                    <span class="menu-title {{ Request::is('subscribers*') ? 'text-primary' : '' }}">{{ __('messages.subscribers') }}</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{ (Request::is('sliders*') || Request::is('faqs*') || Request::is('front-medical-services*') || Request::is('front-patient-testimonials*') || Request::is('cms*') ? 'active' : '') }}"
           href="{{ route('cms.index') }}">
        <span class="menu-icon">
            <i class="fas fa-tasks fs-3"></i>
        </span>
            <span class="menu-title">{{ __('messages.front_cms') }}
                <span class="d-none">{{ __('messages.sliders') }} {{ __('messages.faqs') }} {{ __('messages.front_patient_testimonials') }}</span>
            </span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            <li class="{{ Request::is('cms*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('cms.index') }}">
                    <span class="menu-title {{ Request::is('cms*') ? 'text-primary' : '' }}">{{ __('messages.cms.cms') }}</span>
                </a>
            </li>
            <li class="{{ Request::is('sliders*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('sliders.index') }}">
                    <span class="menu-title {{ Request::is('sliders*') ? 'text-primary' : '' }}">{{ __('messages.sliders') }}</span>
                </a>
            </li>
            <li class="{{ Request::is('faqs*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('faqs.index') }}">
                    <span class="menu-title {{ Request::is('faqs*') ? 'text-primary' : '' }}">{{ __('messages.faqs') }}</span>
                </a>
            </li>
            <li class="{{ Request::is('front-patient-testimonials*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('front-patient-testimonials.index') }}">
                    <span class="menu-title {{ Request::is('front-patient-testimonials*') ? 'text-primary' : '' }}">{{ __('messages.front_patient_testimonials') }}</span>
                </a>
            </li>
        </ul>
    </div>
@endcan
@can('manage_settings')
    <div class="menu-item menu-search sidebar-dropdown">
        <a class="menu-link {{ (Request::is('settings*') || Request::is('roles*') || Request::is('currencies*') || Request::is('clinic-schedules*') || Request::is('countries*') || Request::is('states*') ||Request::is('cities*')) ? 'active' : '' }}"
           href="{{ route('setting.index') }}">
        <span class="menu-icon">
            <i class="fas fa-cogs fs-3"></i>
        </span>
            <span class="menu-title">{{__('messages.settings')}}<span
                        class="d-none">{{ __('messages.roles') }} {{ __('messages.countries') }} {{ __('messages.clinic_schedules') }} {{ __('messages.currencies') }} {{ __('messages.states') }} {{ __('messages.cities') }}</span></span>
        </a>
        <ul class="ps-md-0 hoverable-dropdown list-unstyled shadow">
            <li class="{{ Request::is('settings*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('setting.index') }}">
                    <span class="menu-title {{ Request::is('settings*') ? 'text-primary' : '' }}">{{ __('messages.settings') }}</span>
                </a>
            </li>
            <li class="{{ Request::is('clinic-schedules*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('clinic-schedules.index') }}">
                    <span class="menu-title {{ Request::is('clinic-schedules*') ? 'text-primary' : '' }}">{{ __('messages.clinic_schedules') }}</span>
                </a>
            </li>
            <li class="{{ Request::is('roles*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('roles.index') }}">
                    <span class="menu-title {{ Request::is('roles*') ? 'text-primary' : '' }}">{{ __('messages.roles') }}</span>
                </a>
            </li>
            <li class="{{ Request::is('currencies*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('currencies.index') }}">
                    <span class="menu-title {{ Request::is('currencies*') ? 'text-primary' : '' }}">{{__('messages.currencies')}}</span>
                </a>
            </li>
            <li class="{{ Request::is('countries*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('countries.index') }}">
                    <span class="menu-title {{ Request::is('countries*') ? 'text-primary' : '' }}">{{__('messages.countries')}}</span>
                </a>
            </li>
            <li class="{{ Request::is('states*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('states.index') }}">
                    <span class="menu-title {{ Request::is('states*') ? 'text-primary' : '' }}">{{__('messages.states')}}</span>
                </a>
            </li>
            <li class="{{ Request::is('cities*') ? 'menu-li-hover-color' : '' }}">
                <a class="menu-link py-3" href="{{ route('cities.index') }}">
                    <span class="menu-title {{ Request::is('cities*') ? 'text-primary' : '' }}">{{__('messages.cities')}}</span>
                </a>
            </li>
        </ul>
    </div>
@endcan

@role('patient')
<div class="menu-item menu-search">
    <a class="menu-link {{ Request::is('patients/dashboard*') ? 'active' : '' }}"
       href="{{ route('patients.dashboard') }}">
        <span class="menu-icon">
            <i class="fas fa fa-digital-tachograph fs-3"></i>
        </span>
        <span class="menu-title">{{ __('messages.dashboard') }}</span>
    </a>
</div>
<div class="menu-item menu-search">
    <a class="menu-link {{ (Request::is('patients/appointments*') || Request::is('patients/patient-appointments-calendar*')||Request::is('patients/doctors*')) ? 'active' : '' }}"
       href="{{ route('patients.appointments.index') }}">
        <span class="menu-icon"><i class="fas fa-calendar-alt fs-3" aria-hidden="true"></i></span>
        <span class="menu-title">{{__('messages.appointment.appointments')}}</span>
    </a>
</div>
<div class="menu-item menu-search">
    <a class="menu-link {{ (Request::is('patients/transactions*')) ? 'active' : '' }}"
       href="{{ route('patients.transactions') }}">
        <span class="menu-icon">
            <i class="fas fa-money-bill-wave"></i>
        </span>
        <span class="menu-title">{{ __('messages.transactions') }}</span>
    </a>
</div>
<div class="menu-item menu-search">
    <a class="menu-link {{ (Request::is('patients/reviews*')) ? 'active' : '' }}"
       href="{{ route('patients.reviews.index') }}">
        <span class="menu-icon">
            <i class="fas fa-star"></i>
        </span>
        <span class="menu-title">{{ __('messages.reviews') }}</span>
    </a>
</div>
<div class="menu-item menu-search">
    <a class="menu-link {{ (Request::is('patients/patient-visits*')) ? 'active' : '' }}"
       href="{{ route('patients.patient.visits.index') }}">
        <span class="menu-icon"><i class="fas fa-procedures fs-3" aria-hidden="true"></i></span>
        <span class="menu-title">{{__('messages.visits')}}</span>
    </a>
</div>
<div class="menu-item menu-search">
    <a class="menu-link {{ Request::is('patients/live-consultation*') ? 'active' : '' }}"
       href="{{ route('patients.live-consultation.index') }}">
    <span class="menu-icon">
        <i class="fas fa-video fs-3"></i>
    </span>
        <span class="menu-title">{{__('messages.live_consultations')}}</span>
    </a>
</div>
<div class="menu-item menu-search">
    <a class="menu-link {{ Request::is('patients/connect-google-calendar*') ? 'active' : '' }}"
       href="{{ route('patients.googleCalendar.index') }}">
    <span class="menu-icon">
        <i class="fas fa-calendar-day fs-3"></i>
    </span>
        <span class="menu-title">{{__('messages.setting.connect_google_calendar')}}</span>
    </a>
</div>
@endrole
