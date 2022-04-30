{{--@php $styleCss = 'style'; @endphp--}}
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
<div class="flex-lg-row-fluid ms-xl-14" >
    <!--begin::Card-->
    <div class="card card-flush mb-6 mb-xl-9">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h3 class="align-left m-0">{{ __('messages.visit.prescriptions') }}</h3>
                <div class="ml-auto d-flex align-items-center">
                    <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse"
                         href="#addVisitPrescription"
                         role="button" aria-expanded="false"
                         aria-controls="addVisitPrescription">
                        <a href="#" class="btn btn-primary text-right"><i class="fa fa-plus"></i>{{ __('messages.common.add') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-9 pt-4">
            @php $prescriptionRoute = getLogInUser()->hasRole('doctor') ? 'doctors.visits.add.prescription' : 'add.prescription' @endphp
            {{ Form::open(['route' => $prescriptionRoute, 'id' => 'addPrescription']) }}
            <div id="addVisitPrescription" class="collapse">
                {{ Form::hidden('visit_id',$visit->id) }}
                <div class="row">
                    {{ Form::hidden('prescription_id',null,['id' => 'prescriptionId']) }}
                    {{ Form::hidden('group_id',1,['id' => 'groupId']) }}
                    {{ Form::hidden('status',1,['id' => 'status']) }}
                    <div class="col-md-3 mb-5">
                        {{ Form::label('drug_id', 'Name:', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::select('drug_id', $prescription['drug'],null,['class' => 'form-select form-select-solid form-select-lg mb-3 mb-lg-0', 'placeholder' => 'Name', 'required', 'id' => 'drugId','data-control'=>'select2']) }}
                    </div>
                    <div class="col-md-3 mb-5">
                        {{ Form::label('frequency', 'Frequency:', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        <div class="input-group">
                            {{ Form::text('frequency', null, ['class' => 'form-control form-control-solid mb-3 mb-lg-0', 'placeholder' => 'Frequency', 'required', 'id' => 'frequencyId']) }}
                            <div class="input-group-text">
                                <a class="fw-bolder text-gray-500">x 1</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-5">
                        {{ Form::label('duration', 'Duration:', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        <div class="input-group">
                            {{ Form::text('duration', 6, ['class' => 'form-control form-control-solid mb-3 mb-lg-0', 'placeholder' => 'Duration','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'required', 'id' => 'durationId']) }}
                            <div class="input-group-text">
                                <a class="fw-bolder text-gray-500">Hari</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-5">
                        {{ Form::label('description', 'Description:', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::textarea('description', null, ['class' => 'form-control form-control-solid mb-3 mb-lg-0', 'placeholder' => 'Description','id' => 'descriptionId', 'rows'=> 5]) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-5 mt-5">
                        <div class="w-100 d-flex justify-content-end">
                            {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-3']) }}
                            {{ Form::button(__('messages.common.discard'),['class' => 'btn btn-light btn-active-light-primary reset-form']) }}
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
                        <th scope="col">Stok</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Status</th>
                        <th class="text-center" width="20%">{{ __('messages.common.action') }}</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-bold visit-prescriptions">
                    @if(!empty($visit))
                        @forelse($visit->prescriptions as $prescription)
                            @if($prescription->status === 3 || 4 || 5)
                            <tr id="prescriptionLists">
                                <td class="text-break text-wrap">{{$prescription->pharmacys->name}}</td>
                                <td class="text-break text-wrap">{{$prescription->frequency}} x 1</td>
                                <td class="text-break text-wrap">{{$prescription->duration}} Hari</td>
                                <td class="text-break text-wrap">{{$prescription->pharmacys->procurements->sum('remaining')}} {{ \App\Models\Pharmacy::UNIT_TYPE[$prescription->pharmacys->unit] }}</td>
                                <td class="text-break text-wrap">{{\App\Models\PharmacyProcurement::where('drug_id', $prescription->pharmacys->id)->where('remaining', '>=', $prescription->duration * $prescription->frequency)->get()->pluck('selling_price')[0] }}</td>
                                <td class="text-break text-wrap">
                                    <span class="badge badge-success">
                                        {{\App\Models\Pharmacy::PRESCRIPTION_STATUS[$prescription->status]}}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="#" data-id="{{$prescription->id}}"
                                       class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit-prescription-btn"
                                       :class="{{$prescription->status}} === 4||5 ? 'disabled' : ''"
                                       title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <a href="#" data-id="{{$prescription->id}}"
                                       class="delete-prescription-btn btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                       :class="{{$prescription->status}} === 4||5 ? 'disabled' : ''"
                                       title="Delete">
                                        <i class="fas fa-trash "></i>
                                    </a>
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
                    @if(\App\Models\VisitPrescription::where('visit_id', $visit->id)->where('status', 2)->count() > 0)
                    <a href="{{ route('pharmacys.show', $visit->id) }}" class="btn btn-primary btn-sm">
                        Kerjakan
                    </a>
                    @elseif(\App\Models\VisitPrescription::where('visit_id', $visit->id)->where('status', 3)->count() > 0)
                    <a href="{{ route('done.prescription', $visit->id) }}" class="btn btn-primary btn-sm">
                        Selesai
                    </a>
                    @else
{{--                    <a href="{{ route('billing', $visit->id) }}" class="btn btn-primary btn-sm">--}}
{{--                        Selesai--}}
{{--                    </a>--}}
                    @endif
                </div>

            </div>
        </div>
    </div>
    <!--end::Card-->
</div>


