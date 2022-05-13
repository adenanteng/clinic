@can('manage_admin_dashboard')
    @role('admin')
    <div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('dashboard*')) ? 'd-none' : '' }}">
        <div class="menu-item me-lg-1 {{ Request::is('dashboard*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('admin.dashboard') }}">
                <span class="menu-title">{{ __('messages.dashboard') }}</span>
            </a>
        </div>
    </div>
    @else
    <div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('dashboard*')) ? 'd-none' : '' }}">
        <div class="menu-item me-lg-1 {{ Request::is('dashboard*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('doctors.dashboard') }}">
                <span class="menu-title">{{ __('messages.dashboard') }}</span>
            </a>
        </div>
    </div>
    @endrole
@endcan

@can('manage_staff')
    <div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('staff*')) ? 'd-none' : '' }}"
         data-kt-menu="true">
        <div class="menu-item me-lg-1 {{ Request::is('staff*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('staff.index') }}">
                <span class="menu-title">{{ __('messages.staffs') }}</span>
            </a>
        </div>
    </div>
@endcan
@can('manage_doctors')
    <div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold
        {{ !(Request::is('doctors*') || Request::is('doctor-sessions*')) ? 'd-none' : '' }}">
        <div class="menu-item me-lg-1 {{ Request::is('doctors*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('doctors.index') }}">
                <span class="menu-title">{{ __('messages.doctors') }}</span>
            </a>
        </div>
    </div>
@endcan
@can('manage_doctor_sessions')
    <div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold w-0
{{ !(Request::is('doctors*') || Request::is('doctor-sessions*')) ? 'd-none' : '' }}">
        <div class="menu-item me-lg-1 {{ Request::is('doctor-sessions*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('doctor-sessions.index') }}">
                <span class="menu-title">
                    {{ (getLogInUser()->hasRole('doctor')) ? __('messages.doctor_session.my_schedule') : __('messages.doctor_sessions') }}
                </span>
            </a>
        </div>
    </div>
@endcan
@can('manage_patients')
    <div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('patients*')) ? 'd-none' : '' }}">
        <div class="menu-item me-lg-1 {{ Request::is('patients*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('patients.index') }}">
                <span class="menu-title">{{ __('messages.patients') }}</span>
            </a>
        </div>
    </div>
@endcan
<div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold
{{ !(Request::is('settings*') ||  Request::is('roles*') || Request::is('currencies*') || Request::is('clinic-schedules*') || Request::is('countries*') || Request::is('states*') || Request::is('cities*')) ? 'd-none' : '' }}">
    @can('manage_settings')
        <div class="menu-item me-lg-1 {{ Request::is('settings*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('setting.index') }}">
                <span class="menu-title">{{ __('messages.settings') }}</span>
            </a>
        </div>
        <div class="menu-item me-lg-1 whitespace-nowrap {{ Request::is('clinic-schedules*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('clinic-schedules.index') }}">
                <span class="menu-title">{{ __('messages.clinic_schedules') }}</span>
            </a>
        </div>
    @endcan
    @can('manage_roles')
        <div class="menu-item me-lg-1 {{ Request::is('roles*')  ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('roles.index') }}">
                <span class="menu-title">{{ __('messages.roles') }}</span>
            </a>
        </div>
    @endcan
    @can('manage_currencies')
        <div class="menu-item me-lg-1 {{ Request::is('currencies*')  ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('currencies.index') }}">
                <span class="menu-title">{{__('messages.currencies')}}</span>
            </a>
        </div>
    @endcan
    @can('manage_countries')
        <div class="menu-item me-lg-1 {{ Request::is('countries*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('countries.index') }}">
                <span class="menu-title">{{ __('messages.countries') }}</span>
            </a>
        </div>
    @endcan
    @can('manage_states')
        <div class="menu-item me-lg-1 {{ Request::is('states*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('states.index') }}">
                <span class="menu-title">{{ __('messages.states') }}</span>
            </a>
        </div>
    @endcan
    @can('manage_cities')
        <div class="menu-item me-lg-1 {{ Request::is('cities*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('cities.index') }}">
                <span class="menu-title">{{ __('messages.cities') }}</span>
            </a>
        </div>
    @endcan
</div>
@can('manage_specialities')
    <div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('specializations*')) ? 'd-none' : '' }}">
        <div class="menu-item me-lg-1 {{ Request::is('specializations*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('specializations.index') }}">
                <span class="menu-title">{{ __('messages.specializations') }}</span>
            </a>
        </div>
    </div>
@endcan
@can('manage_services')
    <div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold
{{ !(Request::is('services*') || Request::is('service-categories*')) ? 'd-none' : '' }}">
        <div class="menu-item me-lg-1 {{ (Request::is('services*')) ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('services.index') }}">
                <span class="menu-title">{{ __('messages.services') }}</span>
            </a>
        </div>
    </div>
    <div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold
{{ !(Request::is('services*') || Request::is('service-categories*')) ? 'd-none' : '' }}">
        <div class="menu-item me-lg-1 {{ Request::is('service-categories*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('service-categories.index') }}">
                <span class="menu-title">{{ __('messages.service_categories') }}</span>
            </a>
        </div>
    </div>
@endcan
<div id="department" class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold
{{ !(Request::is('appointments*') || Request::is('admin-appointments-calendar*')) ? 'd-none' : '' }}">
    @can('manage_appointments')
        @foreach(getAllDepartment() as $depa)
        <div class="menu-item me-lg-1 {{ Request::is('appointments/'.$depa->slug.'*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ url('appointments/'.$depa->slug) }}">
{{--                <span class="menu-title">{{ __('messages.appointment.'.$depa->slug) }}</span>--}}
                <span class="menu-title">{{ $depa->name }}</span>
            </a>
            <input class="{{ Request::is('appointments/'.$depa->slug.'*') ? 'asu' : ''  }}" hidden value="{{ $depa->slug }}" />
        </div>
        @endforeach
    @endcan
</div>
@can('manage_patient_visits')
    <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('visits*')) ? 'd-none' : '' }}">
        <div class="menu-item me-lg-1 {{ Request::is('visits*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('visits.index') }}">
                <span class="menu-title">{{ __('messages.visits') }}</span>
            </a>
        </div>
    </div>

    <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('pharmacys*')) ? 'd-none' : '' }}">
        <div class="menu-item me-lg-1 {{ Request::is('pharmacys*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('pharmacys.index') }}">
                <span class="menu-title">{{ __('messages.pharmacys') }}</span>
            </a>
        </div>
    </div>
@endcan
<div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('profile/edit*')) ? 'd-none' : '' }}">
    <div class="menu-item me-lg-1 {{ Request::is('profile/edit*') ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ route('profile.setting') }}">
            <span class="menu-title">{{ __('messages.user.profile_details') }}</span>
        </a>
    </div>
</div>
@can('manage_front_cms')
    <div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('sliders*')) && (!Request::is('front-services*')) && (!Request::is('faqs*')) && (!Request::is('front-patient-testimonials*')) && (!Request::is('cms*')) ? 'd-none' : '' }}">
        <div class="menu-item me-lg-1 {{ Request::is('cms*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('cms.index') }}">
                <span class="menu-title">{{ __('messages.cms.cms') }}</span>
            </a>
        </div>
        <div class="menu-item me-lg-1 {{ Request::is('sliders*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('sliders.index') }}">
                <span class="menu-title">{{ __('messages.sliders') }}</span>
            </a>
        </div>
        <div class="menu-item me-lg-1 {{ Request::is('faqs*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('faqs.index') }}">
                <span class="menu-title">{{ __('messages.faqs') }}</span>
            </a>
        </div>
        <div class="menu-item me-lg-1 whitespace-nowrap {{ Request::is('front-patient-testimonials*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('front-patient-testimonials.index') }}">
                <span class="menu-title">{{ __('messages.front_patient_testimonials') }}</span>
            </a>
        </div>
    </div>
    <div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('enquiries*'))  ? 'd-none' : '' }}">
        <div class="menu-item me-lg-1 {{ Request::is('enquiries*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('enquiries.index') }}">
                <span class="menu-title">{{ __('messages.enquiries') }}</span>
            </a>
        </div>
    </div>
    <div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('subscribers*'))  ? 'd-none' : '' }}">
        <div class="menu-item me-lg-1 {{ Request::is('subscribers*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('subscribers.index') }}">
                <span class="menu-title">{{ __('messages.subscribers') }}</span>
            </a>
        </div>
    </div>
@endcan
@can('manage_transactions')
    <div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('transactions*')) ? 'd-none' : '' }}"
         data-kt-menu="true">
        <div class="menu-item me-lg-1 {{ Request::is('transactions*') ? 'show' : ''  }}">
            <a class="menu-link py-3" href="{{ route('transactions') }}">
                <span class="menu-title">{{ __('messages.transactions') }}</span>
            </a>
        </div>
    </div>
@endcan

@role('patient')
<div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('patients/dashboard*')) ? 'd-none' : '' }}">
    <div class="menu-item me-lg-1 {{ Request::is('patients/dashboard*') ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ route('patients.dashboard') }}">
            <span class="menu-title">{{ __('messages.dashboard') }}</span>
        </a>
    </div>
</div>
<div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold
{{ !(Request::is('patients/appointments*') || (Request::is('patients/patient-appointments-calendar*'))) ? 'd-none' : '' }}">
    <div class="menu-item me-lg-1 {{ (Request::is('patients/appointments*') || Request::is('patients/patient-appointments-calendar*') || Request::is('admin-appointments-calendar*')) ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ route('patients.appointments.index') }}">
            <span class="menu-title">{{ __('messages.appointments') }}</span>
        </a>
    </div>
</div>
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('patients/patient-visits*')) ? 'd-none' : '' }}">
    <div class="menu-item me-lg-1 {{ Request::is('patients/patient-visits*') ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ route('patients.patient.visits.index') }}">
            <span class="menu-title">{{ __('messages.visits') }}</span>
        </a>
    </div>
</div>
<div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('patients/transactions*')) ? 'd-none' : '' }}"
     data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('patients/transactions*') ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ route('patients.transactions') }}">
            <span class="menu-title">{{ __('messages.transactions') }}</span>
        </a>
    </div>
</div>
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('patients/connect-google-calendar*')) ? 'd-none' : '' }}">
    <div class="menu-item me-lg-1 {{ Request::is('patients/connect-google-calendar*') ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ route('patients.googleCalendar.index') }}">
            <span class="menu-title">{{__('messages.setting.connect_google_calendar')}}</span>
        </a>
    </div>
</div>
<div class="menu menu-lg-rounded menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('patients/reviews*')) ? 'd-none' : '' }}"
     data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('patients/reviews*') ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ route('patients.reviews.index') }}">
            <span class="menu-title">{{ __('messages.reviews') }}</span>
        </a>
    </div>
</div>
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary fw-bold {{ (!Request::is('patients/live-consultation*')) ? 'd-none' : '' }}">
    <div class="menu-item me-lg-1 {{ Request::is('patients/live-consultation*') ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ route('patients.live-consultation.index') }}">
            <span class="menu-title">{{__('messages.live_consultations')}}</span>
        </a>
    </div>
</div>
@endrole
