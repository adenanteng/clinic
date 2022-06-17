<div class="collapse" id="{{$collapse}}">
    {{ Form::open(['route' => "$route",'files' => 'true','id' => "form"]) }}
    <div class="row" >
        {{ Form::hidden('visit_id',$visit->id) }}
        {{ Form::hidden('type_id', 1) }}
        {{ Form::hidden('create_user_id', 1) }}
        <div class="col-md-6 mb-5">
            {{ Form::label('date',__('messages.lab.date').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
            {{ Form::text('date',null,['class' => 'form-control form-control-solid','id' => 'date','placeholder' => 'date','required']) }}
        </div>
        <div class="col-md-12 mb-5">
            {{ Form::label('treatment_id',__('messages.lab.treatment').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
            <div class="row">
            @foreach($lab['name'] as $key => $asu)
            <div class="col-md-6  mb-3">
                {{Form::checkbox('treatment_id[]', $asu->id, false,['class' => 'form-check-input ', 'id'=>"treatment_id[]"])}}
                {{Form::label('treatment_id[]', $asu->name,['class' => 'form-check-label text-gray-700 ms-2'])}}
            </div>
            @endforeach
            </div>
        </div>
        <div class="col-md-12 mb-5">
            {{ Form::label('clinical',__('messages.lab.klinis').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
            {{ Form::textarea('clinical',null,['class' => 'form-control form-control-solid','id' => 'clinical','rows'=>'3','placeholder' => 'Klinis','required']) }}
        </div>
        <div class="col-md-12 mt-3 d-flex align-items-center py-1 ms-auto">
            {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-3']) }}
            <button class="btn btn-secondary me-3" data-bs-toggle="collapse" data-bs-target="#{{$collapse}}" aria-expanded="false" aria-controls="{{$collapse}}" >
                {{ __('messages.common.discard') }}
            </button>
        </div>
    </div>
    {{ Form::close() }}
</div>
