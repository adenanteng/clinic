<!--begin::Card-->
<x-visit.card-header>
    <x-slot name="title">{{ __('messages.visit.billings') }}</x-slot>
    <x-slot name="collapse">collapseBilling</x-slot>

    <x-slot name="content">
        <div id="collapseBilling" class="collapse">
            {{ Form::open(['route' => 'add.billing', 'id' => 'addBilling']) }}
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
            {{ Form::close() }}
        </div>
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
    </x-slot>
</x-visit.card-header>
<!--end::Card-->
