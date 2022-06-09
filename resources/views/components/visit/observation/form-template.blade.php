<div class="collapse" id="{{$collapse}}">
    {{ Form::open(['route' => "$route",'files' => 'true','id' => "$form"]) }}
    <div class="">
        {{ Form::hidden('visit_id',$visit->id) }}
        {{ Form::hidden('type_id',1) }}
        {{ Form::hidden('child_id',1) }}

        <div class="row mb-5">
            <div class="col-md-6 mb-5">
                {{ Form::label('observation_name',__('messages.visit.observation_name').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::text('observation_name','RAPT',['class' => 'form-control form-control-solid disabled','id' => 'observation_name', 'disabled']) }}
            </div>
            <div class="col-md-6 mb-5">
                {{ Form::label('anamnesa_method',__('messages.visit.anamnesa_method').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::text('anamnesa_method',null,['class' => 'form-control form-control-solid','id' => 'anamnesa_method','placeholder' => '']) }}
            </div>
        </div>

        @if(!empty($ppja_anamnesa))
        <div class="row mb-5">
            <h5 class="align-left mb-3 text-gray-900">Anamnesa</h5>
            <div class="col-md-6 mb-5">
                {{ Form::label('date_visit',__('messages.visit.date_visit').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::text('date_visit',null,['class' => 'form-control form-control-solid','id' => 'date_visit','placeholder' => '']) }}
            </div>
            <div class="col-md-6 mb-5">
                {{ Form::label('date_service',__('messages.visit.date_service').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::text('date_service',null,['class' => 'form-control form-control-solid','id' => 'date_service','placeholder' => '']) }}
            </div>
            <div class="col-md-6 mb-5">
                {{ Form::label('medical_history',__('messages.visit.medical_history').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::textarea('medical_history',null,['class' => 'form-control form-control-solid','id' => 'medical_history','placeholder' => '','rows'=>'3']) }}
            </div>
            <div class="col-md-6 mb-5">
                {{ Form::label('family_history',__('messages.visit.family_history').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::textarea('family_history',null,['class' => 'form-control form-control-solid','id' => 'family_history','placeholder' => '','rows'=>'3']) }}
            </div>
        </div>
        @endif

        @if(!empty($ppja_nyeri))
            <h5 class="align-left mb-3 text-gray-900">Skrining Nyeri</h5>
            <div class="row mb-5">
                <div class="col-md-6">
                    <div class=" mb-5">
                        {{ Form::label('pain_scale',__('messages.visit.pain_scale').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        <span class="far fa-4x fa-user text-center"/>
                        {{--                    {{ Form::input('pain_scale',null,['class' => 'form-range','id' => 'pain_scale','type'=>'range', 'min'=>'0', 'max'=>'10']) }}--}}
                        <input type="range" class="form-range" min="0" max="5" id="customRange2">

                    </div>
                </div>
                <div class="col-md-6 row">
                    <div class="col-md-6 mb-5">
                        {{ Form::label('date_service',__('messages.visit.date_service').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('date_service',null,['class' => 'form-control form-control-solid','id' => 'date_service','placeholder' => '']) }}
                    </div>
                    <div class="col-md-6 mb-5">
                        {{ Form::label('date_service',__('messages.visit.date_service').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('date_service',null,['class' => 'form-control form-control-solid','id' => 'date_service','placeholder' => '']) }}
                    </div>
                </div>
            </div>
        @endif

        @if(!empty($subjective))
            <div class="row mb-5">
                <h5 class="align-left mb-3 text-gray-900">Subjective</h5>
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
            </div>
        @endif

        @if(!empty($ttv))
            <div class="row mb-5">
                <h5 class="align-left mb-3 text-gray-900">Subjective</h5>
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
            </div>
        @endif

        @if(!empty($physic))
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
        @endif

        @if(!empty($allergic))
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
        @endif

        @if(!empty($idk))
        <div class="col-md-12 mb-5">
            {{ Form::label('assessment',__('messages.visit.assessment').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
            {{ Form::textarea('assessment',null,['class' => 'form-control form-control-solid','id' => 'assessment','rows'=>'3','placeholder' => 'Asesmen','required']) }}
        </div>

        <div class="col-md-12 mb-5">
            {{ Form::label('plan',__('messages.visit.plan').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
            {{ Form::textarea('plan',null,['class' => 'form-control form-control-solid','id' => 'plan','rows'=>'3','placeholder' => 'Rencana','required']) }}
        </div>
        @endif
        <div class="col-md-6 mb-5">
            {{ Form::label('staff_id',__('messages.visit.staff_id').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
            {{ Form::select('staff_id',$observation['staff'],null,['class' => 'form-select form-select-solid form-select-lg','id' => 'staff_id','placeholder' => 'Nama Staf','data-control'=>'select2','required']) }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-10 mt-5">
            <div class="w-100 d-flex justify-content-end">
                {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-3']) }}
                <button class="btn btn-secondary me-3" type="button" data-bs-toggle="collapse" data-bs-target="#{{$collapse}}" aria-expanded="false" aria-controls="{{$collapse}}">{{ __('messages.common.discard') }}</button>
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>
