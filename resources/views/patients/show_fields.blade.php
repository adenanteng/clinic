<div class="col-12">
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-150px symbol-fixed position-relative align-items-center">
                        <img class="object-cover" src="{{ $patient->profile }}" alt="image"/>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <span class="text-gray-800 text-hover-primary fs-2 fw-bolder me-4">{{ $patient->user->full_name }}</span>
                                <a href="javascript:void(0)" class="btn btn-sm btn-light-success fw-bolder ms-2 fs-8 py-1 px-3"
                                   data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark"
                                   data-bs-placement="bottom"
                                   title="Patient Unique ID">{{ $patient->patient_unique_id }}
                                </a>
                            </div>
                            <div class="flex-wrap fw-bold fs-6 pe-2">
                                <span class="d-flex align-items-center text-gray-400 text-hover-primary mb-2 me-2">
                                     {{ !empty($patient->user->age) ? $patient->user->age . ' tahun' : __('messages.common.n/a') }}
                                </span>
                                <span class="d-flex align-items-center text-gray-400 text-hover-primary me-2">
                                    {{ !empty($patient->user->gender) ? $patient->user->gender  : __('messages.common.n/a') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap flex-stack">
                        <div class="d-flex flex-column flex-grow-1 pe-8">
                            <div class="d-flex flex-wrap">
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-book-medical fa-2x me-2 text-primary"></i>
                                        <div class="fs-2 fw-bolder text-gray-800" data-kt-countup="true"
                                             data-kt-countup-value="{{$data['todayAppointmentCount']}}">
                                            0
                                        </div>
                                    </div>
                                    <div class="fw-bold fs-6 text-gray-400">{{__('messages.patient_dashboard.today_appointments')}}</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-alt fa-2x me-2 text-dark"></i>
                                        <div class="fs-2 fw-bolder text-gray-800" data-kt-countup="true"
                                             data-kt-countup-value="{{$data['upcomingAppointmentCount']}}">0
                                        </div>
                                    </div>
                                    <div class="fw-bold fs-6 text-gray-400">{{__('messages.patient_dashboard.upcoming_appointments')}}</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-book-medical fa-2x me-2 text-warning"></i>
                                        <div class="fs-2 fw-bolder text-gray-800" data-kt-countup="true"
                                             data-kt-countup-value="{{$data['completedAppointmentCount']}}">0
                                        </div>
                                    </div>
                                    <div class="fw-bold fs-6 text-gray-400">{{__('messages.patient_dashboard.completed_appointments')}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dropdown">
                    <a class="btn btn-primary btn-active-primary my-1 " href="{{ url('appointments/create?patient='.$patient->patient_unique_id) }}">
                        Daftarkan Kunjungan
                    </a>
                </div>
            </div>
            <div class="d-flex overflow-auto h-55px">
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6 active" data-bs-toggle="tab" id="overview"
                           href="#poverview">{{ __('messages.common.overview') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary" data-bs-toggle="tab" id="appointments"
                           href="#pappointments">{{ __('messages.appointments') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0 cursor-pointer" role="button">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.common.overview')  }}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body border-top p-9">
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.patient.blood_group') }}</label>
                            <div class="col-lg-8 fv-row">
                                <span class="fw-bolder fs-6 text-gray-800 me-2">{{ !empty($patient->user->blood_group) ? \App\Models\Patient::BLOOD_GROUP_ARRAY[$patient->user->blood_group] : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.user.gender') }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800 me-2">{{ !empty($patient->user->gender) ? \App\Models\Patient::GENDER_GROUP_ARRAY[$patient->user->gender] : __('messages.common.n/a')  }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.doctor.dob') }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800 me-2">{{ !empty($patient->user->dob) ? \Carbon\Carbon::parse($patient->user->dob)->format('jS M, Y') : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.setting.address') }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800 me-2">{{ !empty($patient->address->address1) ? $patient->address->address1 : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.patient.registered_on') }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800 me-2 " data-bs-toggle="tooltip"
                                      data-bs-placement="right"
                                      title="{{\Carbon\Carbon::parse($patient->user->created_at)->format('jS M Y')}}">{{$patient->user->created_at->diffForHumans()}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.patient.last_updated') }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800 me-2" data-bs-toggle="tooltip"
                                      data-bs-placement="right"
                                      title="{{\Carbon\Carbon::parse($patient->user->updated_at)->format('jS M Y')}}">{{$patient->user->updated_at->diffForHumans()}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pappointments" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0 cursor-pointer" role="button">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.appointments')  }}</h3>
                    </div>
                </div>
                <div id="kt_content_container" class="container">
                    <div class="card">
                        <div class="card-header d-flex border-0">
                            @include('layouts.search-component')
                            <div class="card-toolbar ms-sm-auto w-sm-auto w-100">
                                <div class="d-flex justify-content-sm-end justify-content-between w-sm-auto w-100" data-kt-user-table-toolbar="base">
                                    <div class="d-flex">
                                        <div class="d-flex align-sm-items-center align-items-start flex-sm-row flex-column">
                                            <div class="d-flex align-items-center align-self-sm-center">
                                                <span class="w-10px h-10px bg-primary rounded-circle me-1"></span>
                                                <span class="me-4">{{\App\Models\Appointment::STATUS[1]}}</span>
                                            </div>
                                            <div class="d-flex align-items-center align-self-sm-center">
                                                <span class="w-10px h-10px bg-success rounded-circle me-1"></span>
                                                <span class="me-4">{{\App\Models\Appointment::STATUS[2]}}</span>
                                            </div>
                                            <div class="d-flex align-items-center align-self-sm-center">
                                                <span class="w-10px h-10px bg-warning rounded-circle me-1"></span>
                                                <span class="me-4">{{\App\Models\Appointment::STATUS[3]}}</span>
                                            </div>
                                            <div class="d-flex align-items-center align-self-sm-center">
                                                <span class="w-10px h-10px bg-danger rounded-circle me-1"></span>
                                                <span class="me-4">{{\App\Models\Appointment::STATUS[4]}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="me-4">
                                        <a href="javascript:void(0)" class="btn btn-flex btn-light fw-bolder"
                                           id="filterBtn"
                                           data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                           data-kt-menu-flip="top-end">
                                    <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
											<svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                 viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"/>
													<path d="M5,4 L19,4 C19.2761424,4 19.5,4.22385763 19.5,4.5 C19.5,4.60818511 19.4649111,4.71345191 19.4,4.8 L14,12 L14,20.190983 C14,20.4671254 13.7761424,20.690983 13.5,20.690983 C13.4223775,20.690983 13.3458209,20.6729105 13.2763932,20.6381966 L10,19 L10,12 L4.6,4.8 C4.43431458,4.5790861 4.4790861,4.26568542 4.7,4.1 C4.78654809,4.03508894 4.89181489,4 5,4 Z"
                                                          fill="#000000"/>
												</g>
											</svg>
										</span>{{__('messages.common.filter')}}</a>
                                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                             data-kt-menu="true"
                                             id="filter">
                                            <div class="px-7 py-5">
                                                <div class="fs-5 text-dark fw-bolder">{{__('messages.common.filter_option')}}</div>
                                            </div>
                                            <div class="separator border-gray-200"></div>
                                            <div class="px-7 py-5">
                                                <div class="mb-10">
                                                    <label class="form-label fw-bold">{{__('messages.appointment.date')}}</label>
                                                    <div>
                                                        <input class="form-control form-control-solid"
                                                               placeholder="Pick date rage" id="doctorAppointmentDateFilter"/>
                                                    </div>
                                                </div>
                                                <div class="mb-10">
                                                    <label class="form-label fw-bold">{{__('messages.doctor.status')}}</label>
                                                    <div>
                                                        {{ Form::select('status', $appointmentStatus, \App\Models\Appointment::BOOKED,['class' => 'form-control form-control-solid form-select', 'data-control'=>"select2", 'id' => 'appointmentStatus']) }}
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="reset" id="resetFilter"
                                                            class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                            data-kt-menu-dismiss="true">{{__('messages.common.reset')}}</button>
                                                    <button type="submit" class="btn btn-sm btn-primary"
                                                            data-kt-menu-dismiss="true">{{__('messages.common.apply')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <table class="table table-responsive-sm align-middle table-row-dashed fs-6 gy-5 dataTable no-footer w-100 whitespace-nowrap"
                                   id="patentAppointmentDataTable">
                                <thead>
                                @if(getLogInUser()->hasRole('doctor'))
                                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-100px">{{__('messages.appointment.appointment_at')}}</th>
                                        <th class="min-w-100px">{{__('messages.doctor.status')}}</th>
                                        <th class="min-w-100px text-center">{{__('messages.common.action')}}</th>
                                    </tr>
                                @else
                                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-100px">{{__('messages.doctor.doctor')}}</th>
                                        <th class="min-w-100px">{{__('messages.appointment.appointment_at')}}</th>
                                        <th class="min-w-100px">{{__('messages.doctor.status')}}</th>
                                        <th class="min-w-100px text-center">{{__('messages.common.action')}}</th>
                                    </tr>
                                @endif
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
