<x-layout.form-field>
    <div class="col-lg-6 mb-5 ">
        {{ Form::label('dept_id',__('messages.pharmacy.unit').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::select('dept_id',$data['dept_type'], null,['class' => 'form-control form-control-solid form-select w-100%','placeholder' => 'Select Category','data-control'=>'select2','id'=>'dept_id']) }}
    </div>
    <div class="col-lg-6 mb-5">
        {{ Form::label('name', __('messages.common.name').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::text('name', null, ['class' => 'form-control form-control-solid text-uppercase', 'placeholder' => 'Name']) }}
    </div>
    @php $styleCss = 'style'; @endphp
    <div class="col-lg-6 mb-5">
        {{ Form::label('category_id',__('messages.service.category').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
{{--        <div class="input-group flex-nowrap">--}}
            {{ Form::select('category_id',$data['drug_category'], null,['class' => 'form-control form-control-solid form-select w-100%','placeholder' => 'Select Category','data-control'=>'select2','id'=>'category']) }}
{{--            <div class="input-group-append plus-icon-height d-flex w-45px"{{ $styleCss }}="height: 42px!important;margin-left: 3px;" id="createTreatmentCategory">--}}
{{--                <div class="input-group-text form-control form-control-solid">--}}
{{--                    <a href="#" class="btn btn-icon" data-toggle="modal" data-target="#createTreatmentCategoryModal"><i class="fa fa-plus"></i></a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    <div class="col-lg-6 mb-5">
        {{ Form::label('unit_id',__('messages.pharmacy.unit').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
        {{ Form::select('unit_id',$data['unit'], null,['class' => 'form-control form-control-solid form-select w-100%','placeholder' => 'Select Category','data-control'=>'select2','id'=>'unit']) }}
    </div>
    <div class="col-lg-12">
        {{ Form::label('short_description', __('messages.service.short_description').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Maximum 60 character allow"></i>
        {{ Form::textarea('short_description', null, ['class' => 'form-control form-control-solid', 'placeholder' => 'Short Description', 'rows'=> 5,'maxlength'=> 60]) }}
    </div>

    <x-layout.form-submit />
</x-layout.form-field>
