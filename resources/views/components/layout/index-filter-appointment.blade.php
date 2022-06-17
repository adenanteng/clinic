<div class="me-4">
    <a href="javascript:void(0)" class="btn btn-flex btn-light fw-bolder" id="filterBtn"
       data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
       data-kt-menu-flip="top-end">
        <span class="svg-icon svg-icon-5 me-1">
            <i class="fad fa-filters"></i>
        </span>
        {{__('messages.common.filter')}}
    </a>
    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="filter">
        <div class="px-7 py-5">
            <div class="fs-5 text-dark fw-bolder">
                {{__('messages.common.filter_option')}}
            </div>
        </div>
        <div class="separator border-gray-200"></div>
        <div class="px-7 py-5">
            <div class="mb-10">
                <label class="form-label fw-bold">{{__('messages.appointment.date')}}</label>
                <div>
                    <input class="form-control form-control-solid" placeholder="Pick date rage" id="appointmentDate"/>
                </div>
            </div>
            <div class="mb-10">
                <label class="form-label fw-bold">Payment</label>
                <div>
                    {{ Form::select('payment_type', \App\Models\Appointment::PAYMENT_TYPE_ALL, \App\Models\Appointment::ALL_PAYMENT,['class' => 'form-control form-control-solid form-select', 'data-control'=>"select2", 'id' => 'paymentStatus']) }}
                </div>
            </div>
            <div class="mb-10">
                <label class="form-label fw-bold">{{__('messages.doctor.status')}}</label>
                <div>
                    {{ Form::select('status', $appointmentStatus, \App\Models\Appointment::ALL,['class' => 'form-control form-control-solid form-select', 'data-control'=>"select2", 'id' => 'appointmentStatus']) }}
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
