<!--begin::Card-->
<div class="card card-flush mb-6 mb-xl-9" x-data="{ create: false }">
    <div class="card-header align-items-center">
        <h3 class="align-left m-0">{{ __('messages.visit.labs') }}</h3>
        <div class="ml-auto d-flex align-items-center">
            <button class="btn btn-primary" role="button" @click="create=!create" x-show="!create">
                <i class="fa fa-plus"></i>{{ __('messages.common.add') }}
            </button>
        </div>
    </div>
    <div class="card-body p-9 pt-4">
        {{ Form::open(['route' => 'add.lab','files' => 'true','id' => 'addLab']) }}
        <div class="p-0 visit-detail-card" >
            <div class="card-body border-1 border-top border-secondary" id="addVisitLab" x-show="create" x-transition>
                <div class="row" >
                    {{ Form::hidden('visit_id',$visit->id) }}
                    '{{ Form::hidden('type', 1) }}
                    <div class="col-md-12 mb-5">
                        {{ Form::label('date',__('messages.lab.date').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                        {{ Form::text('date',null,['class' => 'form-control form-control-solid','id' => 'date','placeholder' => 'Tanggal','required']) }}
                    </div>
                    <div class="col-md-12 mb-5">
                        {{ Form::label('treatment_id',__('messages.lab.treatment').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                        {{ Form::select('treatment_id',$lab['name'],null,['class' => 'form-control form-control-solid','id' => 'treatment_id','placeholder' => 'Jasa lab','required','data-control'=>'select2']) }}
                    </div>
                    <div class="col-md-12 mb-5">
                        {{ Form::label('klinis',__('messages.lab.klinis').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                        {{ Form::textarea('klinis',null,['class' => 'form-control form-control-solid','id' => 'klinis','rows'=>'3','placeholder' => 'Klinis','required']) }}
                    </div>

                    <div class="col-md-12 mb-5">
                        {{ Form::label('description',__('messages.lab.desc').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                        {{ Form::textarea('description',null,['class' => 'form-control form-control-solid','id' => 'description','rows'=>'3','placeholder' => 'Deskripsi','required']) }}
                    </div>

                    <div class="col-md-12 mt-3 d-flex align-items-center py-1 ms-auto">
                        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-3', '@click'=>'create=!create']) }}
                        <button class="btn btn-secondary me-3" @click="create=!create" >
                            {{ __('messages.common.discard') }}
                        </button>
                    </div>
                </div>
            </div>
            <table class="table align-middle overflow-auto table-row-dashed fs-6 gy-5 mt-5 whitespace-nowrap">
                <thead>
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    <th scope="col">{{ __('messages.lab.date') }}</th>
                    <th scope="col">{{ __('messages.lab.type') }}</th>
                    <th scope="col">{{ __('messages.lab.treatment') }}</th>
                    <th scope="col">{{ __('messages.common.status') }}</th>
                    <th class="text-center" width="20%">{{ __('messages.common.action') }}</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold visit-labs">
                @if(!empty($visit->labs))
                    @forelse($visit->labs as $key => $lab)
                        @if($loop->first)
                            <tr>
                                <td colspan="5" class="text-center">{{$lab->created_at->format('j F Y')}}</td>
                            </tr>
                        @else
                            @if($visit->labs[$key-1]->created_at->format('j F Y') !== $lab->created_at->format('j F Y'))
                                <tr>
                                    <td colspan="5" class="text-center">{{$lab->created_at->format('j F Y')}}</td>
                                </tr>
                            @endif
                        @endif
                        <tr id="labLists">
                            <td class="text-break text-wrap">{{$lab->date}}</td>
                            <td class="text-break text-wrap">{{$lab->type_name}}</td>
                            <td class="text-break text-wrap">{{$lab->treatment}}</td>
                            <td class="text-break text-wrap"><span class="badge badge-success">{{$lab->status_name}}</span></td>
                            <td class="text-center">
                                <a href="#" data-id="{{$lab->id}}"
                                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit-lab-btn"
                                   :class="{{$lab->status}} !== 1 ? 'disabled' : ''"
                                   title="Edit" @click="create=true">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <a href="#" data-id="{{$lab->id}}"
                                   class="delete-lab-btn btn btn-icon btn-bg-light text-hover-danger btn-sm"
                                   :class="{{$lab->status}} !== 1 ? 'disabled' : ''"
                                   title="Delete">
                                    <i class="fas fa-trash "></i>
                                </a>
                            </td>
                        </tr>
                        @if($loop->last)
                            <tr>
                                <td>
                                    <button role="button" data-id="{{$visit->id}}" class="btn btn-primary send-lab-btn">
                                        Kirim
                                    </button>
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr id="nolabLists">
                            <td colspan="5" class="text-center font-text-muted text-gray-600" >
                                {{ __('messages.common.no_data_available_in_table') }}
                            </td>
                        </tr>
                    @endforelse
                @endif
                </tbody>
            </table>
        </div>
        {{ Form::close() }}
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
