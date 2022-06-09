<!--begin::Card-->
<x-visit.card-header>
    <x-slot name="title">{{ __('messages.visit.prescriptions') }}</x-slot>
    <x-slot name="collapse">collapsePrescription</x-slot>

    <x-slot name="content">
        <div id="collapsePrescription" class="collapse">
            {{ Form::open(['route' => 'add.prescription', 'id' => 'addPrescription']) }}
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
            {{ Form::close() }}
        </div>
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
    </x-slot>
</x-visit.card-header>

<!--end::Card-->
