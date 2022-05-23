@php $styleCss = 'style'; @endphp
<div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
    <div class="card mb-5 mb-xl-8">
        <div class="card-body pt-0 pt-lg-1">
            <div class="card">
                <div class="card-body d-flex flex-center flex-column pt-12 p-9 px-0">
                    <div class="symbol symbol-100px symbol-circle mb-7">
                        <img src="{{ $visit->visitPatient->profile }}" class="object-cover" alt="image"/>
                    </div>
                    <a href="{{ getLogInUser()->hasRole('doctor') ?  url('doctors/patients/'.$visit->visitPatient->id) :  route('patients.show', $visit->visitPatient->id) }}"
                       class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-3">{{ $visit->visitPatient->user->full_name }}</a>
                    <span>#{{ $visit->visitPatient->patient_unique_id }}</span>
                </div>
            </div>
            <div class="separator"></div>
            <div id="kt_user_view_details" class="collapse show">
                <div class="pb-5 fs-6">
                    <div class="fw-bolder mt-5">{{__('messages.visit.visit_date')}}</div>
                    <div class="text-gray-600">{{\Carbon\Carbon::parse($visit->visit_date)->format('jS M Y')}}</div>
                    @if(!getLogInUser()->hasRole('doctor'))
                        <div class="fw-bolder mt-5">{{__('messages.visit.doctor')}}</div>
                        <div class="text-gray-600">{{$visit->visitDoctor->user->full_name }}</div>
                    @endif
                    <div class="fw-bolder mt-5">{{__('messages.visit.description')}}</div>
                    <div class="text-gray-600 mh-150px overflow-auto">{{!empty($visit->description) ? $visit->description : 'N/A'}}</div>
                    <div class="fw-bolder mt-5">{{__('messages.doctor.created_at')}}</div>
                    <span class="text-gray-600" data-bs-toggle="tooltip" data-bs-placement="right"
                          title="{{\Carbon\Carbon::parse($visit->created_at)->format('jS M Y')}}">{{$visit->created_at->diffForHumans()}}</span>
                    <div class="fw-bolder mt-5">{{__('messages.doctor.created_at')}}</div>
                    <span class="text-gray-600" data-bs-toggle="tooltip" data-bs-placement="right"
                          title="{{\Carbon\Carbon::parse($visit->updated_at)->format('jS M Y')}}">{{$visit->updated_at->diffForHumans()}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="flex-lg-row-fluid ms-xl-14" x-data="{ tab: $persist(1) }">
    <!--begin:::Tabs-->
    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">
        <li class="nav-item">
            <button class="nav-link text-active-primary pb-4" :class="tab===1 ? 'active' : ''" @click="tab = 1">{{ __('messages.visit.observations') }}</button>
        </li>
        <li class="nav-item">
            <button class="nav-link text-active-primary pb-4" :class="tab===2 ? 'active' : ''" @click="tab = 2">{{ __('messages.visit.problems') }}</button>
        </li>
        <li class="nav-item">
            <button class="nav-link text-active-primary pb-4" :class="tab===3 ? 'active' : ''" @click="tab = 3">{{ __('messages.visit.prescriptions') }}</button>
        </li>
        <li class="nav-item">
            <button class="nav-link text-active-primary pb-4" :class="tab===4 ? 'active' : ''" @click="tab = 4">{{ __('messages.visit.billing') }}</button>
        </li>
        <li class="nav-item">
            <button class="nav-link text-active-primary pb-4" :class="tab===5 ? 'active' : ''" @click="tab = 5">{{ __('messages.visit.history') }}</button>
        </li>
    </ul>
    <!--end:::Tabs-->
    <!--begin:::Tab content-->
    <div class="tab-content" id="myTabContent">
        <!--begin::Card-->
        <div class="card card-flush mb-6 mb-xl-9" x-show="tab===1" x-data="{ create: false }">
                <div class="card-header align-items-center">
                    <h3 class="align-left m-0">{{ __('messages.visit.observations') }}</h3>
                    <div class="ml-auto d-flex align-items-center">
                        <button class="btn btn-primary" role="button" @click="create=!create" x-show="!create">
                            <i class="fa fa-plus"></i>{{ __('messages.common.add') }}
                        </button>
                    </div>
                </div>
                <div class="card-body p-9 pt-4">
                    @php $observationRoute = getLogInUser()->hasRole('doctor') ? 'doctors.visits.add.observation' : 'add.observation' @endphp

                    {{ Form::open(['route' => 'add.observation','files' => 'true','id' => 'addVisitObservation']) }}
                    <div class="p-0 visit-detail-card" >
                        <div class="gap-5 visit-observations" x-show="!create" x-transition>
                            @if(!empty($visit))
                                @forelse($visit->observations as $val)
                                    <div class="card d-flex border-1 border border-secondary" x-data="{collapse: false}">
                                        <div class="card-body" role="button" @click="collapse=!collapse">
                                            <div class="d-inline">
                                                <h3 class="card-title d-inline me-5">{{ $val->observation_name }}</h3>
                                                <span class="text-muted d-inline me-3" >{{ $val->updated_at }}</span>
                                                <span class="badge badge-success">{{ $val->create_user }}</span>

                                            </div>
                                            <span class="d-inline float-end">
                                                <i class="fas fa fa-angle-down" x-show="!collapse" ></i>
                                                <i class="fas fa fa-angle-up" x-show="collapse" ></i>
                                            </span>
                                        </div>
                                        <div class="card-body border-1 border-top border-secondary" x-show="collapse" x-transition>
                                            <div class="">
                                                <h6 class="text-decoration-underline">Subjective</h6>
                                                <div class="ps-5 mt-5">
                                                    <p class="card-text"><span class="text-muted">Symptoms : </span> {{ $val->symptoms }}</p>
                                                    <p class="card-text"><span class="text-muted">Anamnesis : </span> {{ $val->anamnesis }}</p>
                                                    <p class="card-text"><span class="text-muted">Prognosis : </span> {{ $val->prognosis }}</p>
                                                    <p class="card-text"><span class="text-muted">Anamnesis : </span> {{ $val->anamnesis }}</p>
                                                </div>
                                            </div>
                                            <div class="mt-8">
                                                <h6 class="text-decoration-underline">Objective</h6>
                                                <div class="ps-5 mt-5 row">
                                                    <div class="col">
                                                        <p class="card-text"><span class="text-muted">Temperature : </span> {{ $val->temperature }}</p>
                                                        <p class="card-text"><span class="text-muted">Awareness : </span> {{ $val->awareness }}</p>
                                                        <p class="card-text"><span class="text-muted">Height : </span> {{ $val->height }}</p>
                                                        <p class="card-text"><span class="text-muted">Weight : </span> {{ $val->weight }}</p>
                                                    </div>
                                                    <div class="col">
                                                        <p class="card-text"><span class="text-muted">Systole : </span> {{ $val->systole }}</p>
                                                        <p class="card-text"><span class="text-muted">Diastole : </span> {{ $val->diastole }}</p>
                                                        <p class="card-text"><span class="text-muted">Respiratory Rate : </span> {{ $val->respiratory_rate }}</p>
                                                        <p class="card-text"><span class="text-muted">Heart Rate : </span> {{ $val->heart_rate }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-8">
                                                <h6 class="text-decoration-underline">Assessment</h6>
                                                <div class="ps-5 mt-5 row">
                                                    <p class="card-text">{{ $val->assessment }}</p>
                                                </div>
                                            </div>
                                            <div class="mt-8">
                                                <h6 class="text-decoration-underline">Plan</h6>
                                                <div class="ps-5 mt-5 row">
                                                    <p class="card-text">{{ $val->plan }}</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @empty
                                    <p class="text-center fw-bold mt-3 text-muted text-gray-600">{{ __('messages.common.no_records_found') }}</p>
                                @endforelse
                            @endif
                        </div>
                        <div class="card-body border-1 border-top border-secondary" x-show="create" x-transition>
                            <div class="row" >
                                {{ Form::hidden('visit_id',$visit->id) }}
                                <div class="col-md-12 mb-5 visually-hidden">
                                    {{ Form::label('observation_name',__('messages.visit.observation_name').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                                    {{ Form::hidden('observation_name','CPPT',['class' => 'form-control form-control-solid','id' => 'observation_name', 'placeholder' => 'Name','required']) }}
                                </div>
                                <div class="col-md-12 mb-5">
                                    {{ Form::label('symptoms',__('messages.visit.symptoms').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                                    {{ Form::text('symptoms',null,['class' => 'form-control form-control-solid','id' => 'symptoms','placeholder' => 'Gejala','required']) }}
                                </div>
                                <div class="col-md-12 mb-5">
                                    {{ Form::label('anamnesis',__('messages.visit.anamnesis').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                                    {{ Form::text('anamnesis',null,['class' => 'form-control form-control-solid','id' => 'anamnesis','placeholder' => 'Anamnesa','required']) }}
                                </div>
                                <div class="col-md-6 mb-5">
                                    {{ Form::label('prognosis',__('messages.visit.prognosis').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                                    {{ Form::select('prognosis',$observation['prognosis'],null,['class' => 'form-select form-select-solid form-select-lg','id' => 'prognosis','placeholder' => 'Prognosa','data-control'=>'select2','required']) }}
                                </div>
                                <div class="col-md-6 mb-5">
                                    {{ Form::label('awareness',__('messages.visit.awareness').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                                    {{ Form::select('awareness',$observation['awareness'],null,['class' => 'form-select form-select-solid form-select-lg','id' => 'awareness','placeholder' => 'Kesadaran','data-control'=>'select2','required']) }}
                                </div>
                                <div class="col-md-3 mb-5">
                                    {{ Form::label('temperature',__('messages.visit.temperature').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                                    <div class="input-group">
                                    {{ Form::text('temperature',null,['class' => 'form-control form-control-solid','id'=>'temperature','maxlength'=>'2','placeholder'=>'Temperatur','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','required']) }}
                                        <div class="input-group-text border-0">
                                            <a class="fw-bolder text-gray-500">°C</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-5">
                                    {{ Form::label('height',__('messages.visit.height').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                                    <div class="input-group">
                                        {{ Form::text('height',null,['class' => 'form-control form-control-solid','id' =>'height','maxlength'=>'3','placeholder' => 'Tinggi Badan','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','required']) }}
                                        <div class="input-group-text border-0">
                                            <a class="fw-bolder text-gray-500">Cm</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-5">
                                    {{ Form::label('weight',__('messages.visit.weight').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                                    <div class="input-group">
                                        {{ Form::text('weight',null,['class' => 'form-control form-control-solid','id' => 'weight','maxlength'=>'3','placeholder' => 'Berat Badan','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','required']) }}
                                        <div class="input-group-text border-0">
                                            <a class="fw-bolder text-gray-500">Kg</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-5">
                                    {{ Form::label('belly',"Belly :" ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                                    <div class="input-group">
                                        {{ Form::text('belly',null,['class' => 'form-control form-control-solid','id' => 'belly','maxlength'=>'3','placeholder' => 'Lingkar Perut','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','required']) }}
                                        <div class="input-group-text border-0">
                                            <a class="fw-bolder text-gray-500">Au</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-5">
                                    {{ Form::label('systole',__('messages.visit.systole').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                                    <div class="input-group">
                                        {{ Form::text('systole',null,['class' => 'form-control form-control-solid','id' => 'systole','maxlength'=>'3','placeholder' => 'Sistol','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','required']) }}
                                        <div class="input-group-text border-0">
                                            <a class="fw-bolder text-gray-500">Au</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-5">
                                    {{ Form::label('diastole',__('messages.visit.diastole').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                                    <div class="input-group">
                                        {{ Form::text('diastole',null,['class' => 'form-control form-control-solid','id' => 'diastole','maxlength'=>'3','placeholder' => 'Diastol','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','required']) }}
                                        <div class="input-group-text border-0">
                                            <a class="fw-bolder text-gray-500">Au</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-5">
                                    {{ Form::label('respiratory_rate',__('messages.visit.respiratory_rate').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                                    <div class="input-group">
                                        {{ Form::text('respiratory_rate',null,['class' => 'form-control form-control-solid','id'=>'respiratory_rate','maxlength'=>'3','placeholder' => 'Pernapasan','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','required']) }}
                                        <div class="input-group-text border-0">
                                            <a class="fw-bolder text-gray-500">Au</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-5">
                                    {{ Form::label('heart_rate',__('messages.visit.heart_rate').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                                    <div class="input-group">
                                        {{ Form::text('heart_rate',null,['class' => 'form-control form-control-solid','id' => 'heart_rate','maxlength'=>'3','placeholder' => 'Nadi','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','required']) }}
                                        <div class="input-group-text border-0">
                                            <a class="fw-bolder text-gray-500">Au</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-5">
                                    {{ Form::label('assessment',__('messages.visit.assessment').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                                    {{ Form::textarea('assessment',null,['class' => 'form-control form-control-solid','id' => 'assessment','rows'=>'3','placeholder' => 'Asesmen','required']) }}
                                </div>

                                <div class="col-md-12 mb-5">
                                    {{ Form::label('plan',__('messages.visit.plan').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                                    {{ Form::textarea('plan',null,['class' => 'form-control form-control-solid','id' => 'plan','rows'=>'3','placeholder' => 'Rencana','required']) }}
                                </div>

                                <div class="col-md-6 mb-5">
                                    {{ Form::label('staff_id',__('messages.visit.staff_id').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                                    {{ Form::select('staff_id',$observation['staff'],null,['class' => 'form-select form-select-solid form-select-lg','id' => 'staff_id','placeholder' => 'Nama Staf','data-control'=>'select2','required']) }}
                                </div>

                                <div class="col-md-12 mt-3 d-flex align-items-center py-1 ms-auto">
                                    {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-3', '@click'=>'create=!create']) }}
                                    <button class="btn btn-secondary me-3" @click="create=!create" >
                                        {{ __('messages.common.discard') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
                <!--end::Card body-->
            </div>
        <!--end::Card-->

        <!--begin::Card-->
        <div class="card card-flush mb-6 mb-xl-9" x-show="tab===2">
                <div class="card-header align-items-center">
                    <h3 class="align-left m-0">{{ __('messages.visit.problems') }}</h3>
                </div>
                <div class="card-body pt-4">
                    @php $problemRoute = getLogInUser()->hasRole('doctor') ? 'doctors.visits.add.problem' : 'add.problem'  @endphp
                    {{ Form::open(['route' => $problemRoute, 'id' => 'addVisitProblem']) }}
                    <div class="p-0 visit-detail-card">
                        <div class="px-2">
                            <div class="col-md-12">
                                <ul class="list-group list-group-flush problem-list" id="problemLists">
                                    @if(!empty($visit))
                                        @forelse($visit->problems as $val)
                                            <li class="list-group-item text-wrap text-break d-flex justify-content-between align-items-center py-5">{{ $val->problem_name }}
                                                <span class="remove-problem" data-id="{{ $val->id }}" title="Delete">
                                                    <a href="javascript:void(0)">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </a>
                                                </span>
                                            </li>
                                        @empty
                                            <p class="text-center fw-bold mt-3 text-muted text-gray-600">{{ __('messages.common.no_records_found') }}</p>
                                        @endforelse
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row gap-5">
                                {{ Form::hidden('visit_id',$visit->id) }}
                                <div class="col-md-12">
                                    <div class="form-group mb-0">
                                        <label for="title" class="sr-only">{{ __('messages.common.title') }}</label>
                                        {{ Form::text('problem_name', null, ['class' => 'form-control form-control-solid', 'placeholder' => 'Enter problem','id' => 'problemName','required']) }}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-0">
                                        <label for="title" class="sr-only">{{ __('messages.common.title') }}</label>
                                        <select id="select-icd10" class="form-select form-select-lg form-select-solid" placeholder="ICD-10" multiple="multiple"></select>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center mt-3">
                                    {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary','id'=> 'problemSubmitBtn']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
                <!--end::Card body-->
            </div>

        <!--begin::Card-->
        <div class="card card-flush mb-6 mb-xl-9" x-show="tab===3" x-data="{create:false}">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h3 class="align-left m-0">{{ __('messages.visit.prescriptions') }}</h3>
                    <div class="ml-auto d-flex align-items-center">
                        <button class="btn btn-primary" role="button" @click="create=!create" x-show="!create" >
                            <i class="fa fa-plus"></i>{{ __('messages.common.add') }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body p-9 pt-4">
                @php $prescriptionRoute = getLogInUser()->hasRole('doctor') ? 'doctors.visits.add.prescription' : 'add.prescription' @endphp
                {{ Form::open(['route' => $prescriptionRoute, 'id' => 'addPrescription']) }}
                <div id="addVisitPrescription" class="" x-show="create" x-transition>
                    {{ Form::hidden('visit_id',$visit->id) }}
                    <div class="row">
                        {{ Form::hidden('prescription_id',null,['id' => 'prescriptionId']) }}
                        {{ Form::hidden('status',1,['id' => 'status']) }}
                        <div class="col-md-5 mb-5">
                            {{ Form::label('drug_id', 'Name:', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                            {{ Form::select('drug_id', $prescription['drug'],null,['class' => 'form-select form-select-solid form-select-lg mb-3 mb-lg-0', 'placeholder' => 'Name', 'required', 'id' => 'drugId','data-control'=>'select2']) }}
                        </div>
                        <div class="col-md-2 mb-5">
                            {{ Form::label('frequency', 'Frequency:', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                            <div class="input-group">
                                {{ Form::text('frequency', null, ['class' => 'form-control form-control-solid mb-3 mb-lg-0', 'placeholder' => ' ', 'required', 'id' => 'frequencyId']) }}
                                <div class="input-group-text">
                                    <a class="fw-bolder text-gray-500">x 1</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-5">
                            {{ Form::label('duration', 'Duration:', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                            <div class="input-group">
                            {{ Form::text('duration', null, ['class' => 'form-control form-control-solid mb-3 mb-lg-0', 'placeholder' => ' ','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'required', 'id' => 'durationId']) }}
                            <div class="input-group-text">
                                    <a class="fw-bolder text-gray-500">Hari</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-5">
                            {{ Form::label('description', 'Description:', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                            {{ Form::textarea('description', null, ['class' => 'form-control form-control-solid mb-3 mb-lg-0', 'placeholder' => 'Deskripsi','id' => 'descriptionId', 'rows'=> 5]) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-5 mt-5">
                            <div class="w-100 d-flex justify-content-end">
                                {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-3','id'=>'prescriptionSubmitBtn']) }}
                                <button class="btn btn-secondary me-3 reset-form" @click="create=!create" >
                                    {{ __('messages.common.discard') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
                <div class="overflow-auto">
                    <table class="table align-middle overflow-auto table-row-dashed fs-6 gy-5 mt-5 whitespace-nowrap">
                        <thead>
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th scope="col">{{ __('messages.prescription.name') }}</th>
                            <th scope="col">{{ __('messages.prescription.frequency') }}</th>
                            <th scope="col">{{ __('messages.prescription.duration') }}</th>
                            <th scope="col">{{ __('messages.common.status') }}</th>
                            <th class="text-center" width="20%">{{ __('messages.common.action') }}</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-bold visit-prescriptions">
                        @if(!empty($visit->prescriptions))
                            @forelse($visit->prescriptions as $key => $prescription)
                                @if($loop->first)
                                    <tr>
                                        <td colspan="5" class="text-center">{{$prescription->created_at->format('j F Y')}}</td>
                                    </tr>
                                @else
                                    @if($visit->prescriptions[$key-1]->created_at->format('j F Y') !== $prescription->created_at->format('j F Y'))
                                        <tr>
                                            <td colspan="5" class="text-center">{{$prescription->created_at->format('j F Y')}}</td>
                                        </tr>
                                    @endif
                                @endif
                                <tr id="prescriptionLists">
                                    <td class="text-break text-wrap">{{$prescription->pharmacys->name}}</td>
                                    <td class="text-break text-wrap">{{$prescription->frequency}} x 1</td>
                                    <td class="text-break text-wrap">{{$prescription->duration}} Hari</td>
                                    <td class="text-break text-wrap"><span class="badge badge-success">{{$prescription->status_name}}</span></td>
                                    <td class="text-center">
                                        <a href="#" data-id="{{$prescription->id}}"
                                           class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit-prescription-btn"
                                           :class="{{$prescription->status}} !== 1 ? 'disabled' : ''"
                                           title="Edit" @click="create=true">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="#" data-id="{{$prescription->id}}"
                                           class="delete-prescription-btn btn btn-icon btn-bg-light text-hover-danger btn-sm"
                                           :class="{{$prescription->status}} !== 1 ? 'disabled' : ''"
                                           title="Delete">
                                            <i class="fas fa-trash "></i>
                                        </a>
                                    </td>
                                </tr>
                                @if($loop->last)
                                    <tr>
                                        <td>
                                            <button role="button" data-id="{{$visit->id}}" class="btn btn-primary send-prescription-btn">
                                                Kirim
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr id="noPrescriptionLists">
                                    <td colspan="5" class="text-center font-text-muted text-gray-600" >
                                    {{ __('messages.common.no_data_available_in_table') }}
                                    </td>
                                </tr>
                            @endforelse
                        @endif
                        </tbody>
                    </table>
                    <div>

                    </div>
                </div>
            </div>
        </div>
        <!--end::Card-->

        <!--begin::Card-->
        <div class="card card-flush mb-6 mb-xl-9" x-show="tab===4" x-data="{create:false}">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h3 class="align-left m-0">{{ __('messages.visit.billing') }}</h3>
                    <div class="ml-auto d-flex align-items-center">
                        <button class="btn btn-primary" role="button" @click="create=!create" x-show="!create" >
                            <i class="fa fa-plus"></i>{{ __('messages.common.add') }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body p-9 pt-4">
                {{ Form::open(['route' => 'add.billing', 'id' => 'addBilling']) }}
                <div id="addVisitBilling" class="" x-show="create" x-transition>
                    {{ Form::hidden('visit_id',$visit->id) }}
                    <div class="row">
                        {{ Form::hidden('billing_id',null,['id' => 'billingId']) }}
                        {{ Form::hidden('status',1,['id' => 'status']) }}
                        <div class="col-md-5 mb-5">
                            {{ Form::label('treatment_name', 'Nama:', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                            {{ Form::select('treatment_name', $treatment['name'],null,['class' => 'form-select form-select-solid form-select-lg mb-3 mb-lg-0', 'placeholder' => 'Name', 'required', 'id' => 'treatmentName','data-control'=>'select2']) }}
                        </div>
                        <div class="col-md-2 mb-5">
                            {{ Form::label('treatment_unit', 'Jumlah:', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                            {{ Form::text('treatment_unit', 1,['class' => 'form-control form-control-solid mb-3 mb-lg-0', 'placeholder' => 'jumlah', 'required', 'id' => 'treatmentUnit']) }}
                        </div>
                        <div class="col-md-3 mb-5">
                            {{ Form::label('treatment_type', 'Tipe:', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                            {{ Form::select('treatment_type', $treatment['type'], null,['class' => 'form-control form-control-solid mb-3 mb-lg-0','disabled', 'placeholder' => 'Tipe', 'id' => 'treatmentType','data-control'=>'select2']) }}
                        </div>
                        <div class="col-md-2 mb-5">
                            {{ Form::label('treatment_charges', 'Tarif:', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
{{--                            <div class="input-group">--}}
{{--                                <div class="input-group-text border-0">--}}
{{--                                    <a class="fw-bolder text-gray-500">Rp</a>--}}
                                    {{ Form::select('treatment_charges', $treatment['charges'], null,['class' => 'form-control form-control-solid mb-3 mb-lg-0','disabled', 'placeholder' => 'Tarif', 'id' => 'treatmentCharges','data-control'=>'select2']) }}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-5 mt-5">
                            <div class="w-100 d-flex justify-content-end">
                                {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-3','id'=>'billingSubmitBtn']) }}
                                <button class="btn btn-secondary me-3" @click="create=!create" >
                                    {{ __('messages.common.discard') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
                <div class="overflow-auto">
                    <table class="table align-middle overflow-auto table-row-dashed fs-6 gy-5 mt-5 whitespace-nowrap">
                        <thead>
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th scope="col">{{ __('messages.billing.name') }}</th>
                            <th scope="col">{{ __('messages.billing.type') }}</th>
                            <th scope="col">{{ __('messages.billing.unit') }}</th>
                            <th scope="col">{{ __('messages.billing.unit_price') }}</th>
                            <th scope="col">{{ __('messages.billing.subtotal') }}</th>
                            <th class="text-center" >{{ __('messages.common.action') }}</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-bold visit-billings">
                        @if(!empty($visit->billings))
                            @forelse($visit->billings as $billing)
                                <tr id="billingLists">
                                    <td class="text-break text-wrap">{{$billing->name_text}}</td>
                                    <td class="text-break text-wrap"><span class='badge badge-success'>{{$billing->type_text}}</span></td>
                                    <td class="text-break text-wrap text-center">{{$billing->unit}}</td>
                                    <td class="text-break text-wrap">{{$billing->unit_price}}</td>
                                    <td class="text-break text-wrap"><span class='badge badge-success'>{{$billing->subtotal}}</span></td>
                                    <td class="text-center">
                                        <a href="#" data-id="{{$billing->id}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit-billing-btn"
                                           title="Edit" @click="create=true">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="#" data-id="{{$billing->id}}" class="delete-billing-btn btn btn-icon btn-bg-light text-hover-danger btn-sm" title="Delete">
                                            <i class="fas fa-trash "></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr id="noPrescriptionLists">
                                    <td colspan="5" class="text-center font-text-muted text-gray-600" >
                                        {{ __('messages.common.no_data_available_in_table') }}
                                    </td>
                                </tr>
                            @endforelse
                        @endif

                        @if(!empty($visit->prescriptions))
                            @foreach($visit->prescriptions as $key => $prescription)
                                <tr id="billingLists">
                                    <td class="text-break text-wrap">{{$prescription->pharmacys->name}}</td>
                                    <td class="text-break text-wrap"><span class='badge badge-success'>Obat</span></td>
                                    <td class="text-break text-wrap text-center">{{$prescription->total_unit}}</td>
                                    <td class="text-break text-wrap">20000</td>
                                    <td class="text-break text-wrap"><span class='badge badge-success'>20000</span></td>
                                    <td class="text-center">
                                        <a href="#" data-id="{{$prescription->id}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit-billing-btn"
                                           title="Edit" @click="create=true">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="#" data-id="{{$prescription->id}}" class="delete-billing-btn btn btn-icon btn-bg-light text-hover-danger btn-sm" title="Delete">
                                            <i class="fas fa-trash "></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!--end::Card-->

    </div>
    <!--end:::Tab content-->
</div>


