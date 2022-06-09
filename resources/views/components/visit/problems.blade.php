<!--begin::Card-->
    <div class="card card-flush mb-6 mb-xl-9"  >
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h3 class="align-left m-0">{{ __('messages.visit.diagnosis') }}</h3>
                <div class="ml-auto d-flex align-items-center">
                    {{ Form::open(['route' => 'add.problem', 'id' => 'addVisitProblem']) }}
                    {{ Form::hidden('visit_id',$visit->id) }}
                    {{ Form::hidden('type',\App\Models\VisitProblem::ICD10) }}
                    {{ Form::text('diagnosis_name', null, ['class' => 'form-control form-control-solid form-control-sm', 'placeholder' => 'Enter problem','id' => 'diagnosisName','required']) }}
                    <div class="col-md-12 text-center mt-3 visually-hidden">
                        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary','id'=> 'problemSubmitBtn']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="card-body pt-4">
            <div class="p-0 visit-detail-card">
                <div class="px-2">
                    <div class="col-md-12">
                        <ul class="list-group list-group-flush" id="diagnosisLists">
                            @if(!empty($visit))
                                @forelse($visit->problems as $val)
                                    @if($val->type === 10)
                                        <li class="list-group-item text-wrap text-break d-flex justify-content-between align-items-center py-5">
                                            {{ $val->problem_name }}

                                            <span class="remove-problem" data-id="{{ $val->id }}" title="Delete">
                                                <a href="javascript:void(0)">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </a>
                                                </span>
                                        </li>
                                    @endif
                                @empty
                                    <p class="text-center fw-bold mt-3 text-muted text-gray-600">{{ __('messages.common.no_records_found') }}</p>
                                @endforelse
                            @endif
                        </ul>
                    </div>
                    <select id="select-icd10" class="form-select form-select-md form-select-solid" placeholder="ICD-10" multiple="multiple"></select>
                </div>
            </div>

        </div>
    </div>

    <div class="card card-flush mb-6 mb-xl-9"  >
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h3 class="align-left m-0">{{ __('messages.visit.procedure') }}</h3>
                <div class="ml-auto d-flex align-items-center">
                    {{ Form::open(['route' => 'add.problem', 'id' => 'addVisitProblem']) }}
                    {{ Form::hidden('visit_id',$visit->id) }}
                    {{ Form::hidden('type',\App\Models\VisitProblem::ICD9) }}
                    {{ Form::text('procedure_name', null, ['class' => 'form-control form-control-solid form-control-sm', 'placeholder' => 'Enter problem','id' => 'procedureName','required']) }}
                    <div class="col-md-12 text-center mt-3 visually-hidden">
                        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary','id'=> 'problemSubmitBtn']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="card-body pt-4">
            <div class="p-0 visit-detail-card">
                <div class="px-2">
                    <div class="col-md-12">
                        <ul class="list-group list-group-flush" id="procedureLists">
                            @if(!empty($visit))
                                @forelse($visit->problems as $val)
                                    @if($val->type === 9)
                                        <li class="list-group-item text-wrap text-break d-flex justify-content-between align-items-center py-5">{{ $val->problem_name }}
                                            <span class="remove-problem" data-id="{{ $val->id }}" title="Delete">
                                                <a href="javascript:void(0)">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </a>
                                            </span>
                                        </li>
                                    @endif
                                @empty
                                    <p class="text-center fw-bold mt-3 text-muted text-gray-600">{{ __('messages.common.no_records_found') }}</p>
                                @endforelse
                            @endif
                        </ul>
                    </div>
                    <select id="select-icd9" class="form-select form-select-md form-select-solid" placeholder="ICD-" multiple="multiple"></select>
                </div>
            </div>

        </div>
    </div>
<!--end::Card body-->
