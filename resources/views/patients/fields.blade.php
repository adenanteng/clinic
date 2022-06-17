<div class="card mb-10">
    <div class="card-body ">
        <div class="row gx-10 mb-5">
{{--            <div class="col-md-6 mb-5 visually-hidden">--}}
{{--                {{ Form::label('patientUniqueId',__('messages.patient.patient_unique_id').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}--}}
{{--                {{ Form::text('patient_unique_id',isset($data['patientUniqueId']) ? $data['patientUniqueId'] : null,['class' => 'form-control form-control-solid','required','maxLength' => '8','readonly']) }}--}}
{{--            </div>--}}
            <div class="col-md-6 mb-5">
                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3 required">{{ __('messages.patient.nric_type').':' }}</label>
                {{ Form::select('nric_type', $data['nricGroupList'] ,!empty($patient->user) ? $patient->user->nric_type : null, ['placeholder' => 'Jenis Kartu Identitas','required', 'class' => 'form-select form-select-solid form-select-lg', 'data-control'=>'select2']) }}
            </div>
            <div class="col-md-6 mb-5">
                {{ Form::label('nricId',__('messages.patient.nric_id').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                {{ Form::text('nric_id',!empty($patient->user) ? $patient->user->nric_id : null,['class' => 'form-control form-control-solid','placeholder' => 'Nomor Kartu Identitas','required', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
            </div>
            <div class="col-md-6 mb-5">
                {{ Form::label('fullName',__('messages.patient.name').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                {{ Form::text('full_name',!empty($patient->user) ? $patient->user->full_name : null,['class' => 'form-control form-control-solid text-capitalize','placeholder' => 'Nama Lengkap','required']) }}
            </div>
            <div class="col-md-6 mb-5">
                {{ Form::label('email',__('messages.patient.email').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::email('email',!empty($patient->user) ? $patient->user->email : null,['class' => 'form-control form-control-solid','placeholder' => 'Surel']) }}
            </div>
        {{--    @if(empty($patient))--}}
        {{--        <div class="col-md-6 mb-5">--}}
        {{--            <div class="fv-row" data-kt-password-meter="true">--}}
        {{--                <div class="mb-1">--}}
        {{--                    {{ Form::label('password',__('messages.patient.password').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}--}}
        {{--                    <span data-bs-toggle="tooltip"--}}
        {{--                          title="Use 8 or more characters with a mix of letters, numbers & symbols."><i--}}
        {{--                                class="fa fa-question-circle"></i></span>--}}
        {{--                    <div class="position-relative mb-3">--}}
        {{--                        <input class="form-control form-control-lg form-control-solid"--}}
        {{--                               type="password" placeholder="Password" name="password" autocomplete="off" required>--}}
        {{--                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"--}}
        {{--                              data-kt-password-meter-control="visibility">--}}
        {{--                        <i class="bi bi-eye-slash fs-2"></i>--}}
        {{--                        <i class="bi bi-eye fs-2 d-none"></i>--}}
        {{--                    </span>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">--}}
        {{--                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>--}}
        {{--                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>--}}
        {{--                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>--}}
        {{--                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--        <div class="col-md-6 mb-5">--}}
        {{--            <div class="fv-row" data-kt-password-meter="true">--}}
        {{--                <div class="mb-1">--}}
        {{--                    {{ Form::label('confirmPassword',__('messages.patient.confirm_password').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}--}}
        {{--                    <span data-bs-toggle="tooltip"--}}
        {{--                          title="Use 8 or more characters with a mix of letters, numbers & symbols."><i--}}
        {{--                                class="fa fa-question-circle"></i></span>--}}
        {{--                    <div class="position-relative mb-3">--}}
        {{--                        <input class="form-control form-control-lg form-control-solid"--}}
        {{--                               type="password" placeholder="Password" name="password_confirmation" autocomplete="off"--}}
        {{--                               required>--}}
        {{--                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"--}}
        {{--                              data-kt-password-meter-control="visibility">--}}
        {{--                        <i class="bi bi-eye-slash fs-2"></i>--}}
        {{--                        <i class="bi bi-eye fs-2 d-none"></i>--}}
        {{--                    </span>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">--}}
        {{--                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>--}}
        {{--                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>--}}
        {{--                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>--}}
        {{--                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--    @endif--}}
            <div class="col-md-6 mb-5">
                {{ Form::label('contactNo',__('messages.patient.contact_no').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                <br>
                {{ Form::tel('contact',!empty($patient->user) ? $patient->user->contact : null,['class' => 'form-control form-control-solid','placeholder' => 'No Telepon','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber']) }}
                {{ Form::hidden('region_code',!empty($patient->user) ? $patient->user->region_code : null,['id'=>'prefix_code']) }}
                <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
                <span id="error-msg" class="hide"></span>
            </div>
            <div class="col-md-6 mb-5">
                {{ Form::label('dob',__('messages.patient.dob').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3 required']) }}
                {{ Form::text('dob',!empty($patient->user) ? $patient->user->dob : null,['class' => 'form-control form-control-solid','id' => 'dob', 'placeholder' => 'Tanggal Lahir', 'required']) }}
            </div>
            <div class="col-md-6 mb-5">
                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('messages.patient.blood_group').':' }}</label>
                {{ Form::select('blood_group', $data['bloodGroupList'] ,!empty($patient->user) ? $patient->user->blood_group : null, ['placeholder' => 'Golongan Darah','class' => 'form-select form-select-solid form-select-lg', 'data-control'=>'select2']) }}
            </div>
            <div class="col-md-6 mb-5">
                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3 required">{{ __('messages.patient.gender').':' }}</label>
                {{ Form::select('gender', $data['genderGroupList'] ,!empty($patient->user) ? $patient->user->gender : null, ['placeholder' => 'Gender','class' => 'form-select form-select-solid form-select-lg', 'data-control'=>'select2', 'required']) }}
            </div>
            <div class="col-md-6 mb-5">
                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('messages.patient.marriage').':' }}</label>
                {{ Form::select('marriage', $data['marriageGroupList'] ,!empty($patient->user) ? $patient->user->marriage : null, ['placeholder' => 'Status Nikah','class' => 'form-select form-select-solid form-select-lg', 'data-control'=>'select2']) }}
            </div>
            <div class="col-md-6 mb-5">
                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('messages.patient.religion').':' }}</label>
                {{ Form::select('religion', $data['religionGroupList'] ,!empty($patient->user) ? $patient->user->religion : null, ['placeholder' => 'Agama','class' => 'form-select form-select-solid form-select-lg', 'data-control'=>'select2']) }}
            </div>
            <div class="col-md-6 mb-5">
                {{ Form::label('profession',__('messages.patient.profession').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::text('profession',!empty($patient->user) ? $patient->user->profession : null,['class' => 'form-control form-control-solid text-capitalize','placeholder' => 'Profesi']) }}
            </div>

{{--            <div class="col-lg-12">--}}
{{--                <div class="justify-content-center">--}}
{{--                    <label class="col-form-label fw-bolder fs-6">--}}
{{--                        <span>{{__('messages.patient.profile')}}: </span>--}}
{{--                        <i class="fa fa-question-circle ms-1 fs-7" data-bs-toggle="tooltip"--}}
{{--                           title="Best resolution for this profile will be 150X150"--}}
{{--                           data-bs-original-title="Phone number must be active"--}}
{{--                           aria-label="Phone number must be active"></i>--}}
{{--                    </label>--}}
{{--                </div>--}}
{{--                @php $styleCss = 'style'; @endphp--}}
{{--                <div class="image-input image-input-outline" data-kt-image-input="true">--}}
{{--                    <div class="image-input-wrapper w-125px h-125px" id="bgImage"--}}
{{--                    {{ $styleCss }}="--}}
{{--                    background-image: url({{ !empty($patient->profile) ? $patient->profile : asset('web/media/avatars/male.png') }}--}}
{{--                    )">--}}
{{--                </div>--}}
{{--                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"--}}
{{--                       data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""--}}
{{--                       data-bs-original-title="Change profile">--}}
{{--                    <i class="bi bi-pencil-fill fs-7">--}}
{{--                        <input type="file" name="profile" accept=".png, .jpg, .jpeg">--}}
{{--                    </i>--}}
{{--                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg" id="profilePicture">--}}
{{--                    <input type="hidden" name="avatar_remove">--}}
{{--                </label>--}}
{{--                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>--}}
{{--            </div>--}}
        </div>
    </div>
</div>

<div class="card mb-10">
    <div class="card-body ">
        <div class="row gx-10 mb-5" >
            <div class="fw-bolder fs-3 rotate collapsible mb-7 mt-5">
                {{ __('messages.patient.payment_information') }}
            </div>

            <div class="col-md-6 mb-5">
                {{ Form::label('paymentCard',__('messages.patient.nric_type').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::select('payment_gateway_id[]', $data['payment'] ,!empty($patient->user) ? $patient->user->payment : null, ['placeholder' => 'Jenis Asuransi','class' => 'form-select form-select-solid form-select-lg ', 'data-control'=>'select2']) }}
            </div>
            <div class="col-md-6 mb-5">
                {{ Form::label('paymentCard',__('messages.patient.nric_id').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::text('payment_card[]',!empty($patient->user) ? $patient->user->payment : null,['class' => 'form-control form-control-solid','placeholder' => 'Nomor Asuransi', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
            </div>
        </div>
    </div>

{{--    <div class="card-body ">--}}

{{--        <div id="form_payment">--}}
{{--            <div class="row payment_primary">--}}
{{--                <div class="col-md-6 mb-5">--}}
{{--                    {{ Form::label('paymentCard',__('messages.patient.nric_type').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}--}}
{{--                    {{ Form::select('payment_gateway_id[]', $data['payment'] ,null, ['placeholder' => 'Penyedia Asuransi','class' => 'form-select form-select-solid form-select-lg ', 'data-control'=>'select2']) }}--}}
{{--                </div>--}}
{{--                <div class="col-md-6 mb-5">--}}
{{--                    {{ Form::label('paymentCard',__('messages.patient.nric_id').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}--}}
{{--                    <div class="input-group mb-3">--}}
{{--                        {{ Form::text('payment_card[]',null,['class' => 'form-control form-control-solid','placeholder' => 'Nomor Asuransi', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}--}}
{{--                        <div class="input-group-append">--}}
{{--                            <button id="removeRow" type="button" class="btn btn-danger">Remove</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row payment_secondary" >--}}

{{--            </div>--}}
{{--        </div>--}}
{{--        <div id="newRow"></div>--}}
{{--        <button id="addRow" type="button" class="btn btn-info">Add Row</button>--}}
{{--    </div>--}}

</div>

<div class="card mb-10">
    <div class="card-body ">
        <div class="row gx-10 mb-5">
            <div class="fw-bolder fs-3 rotate collapsible mb-7 mt-5">
                {{ __('messages.patient.address_information') }}
            </div>

            <div class="d-flex col-md-6 flex-column mb-7 fv-row">
                {{ Form::label('address1',__('messages.patient.address').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                {{ Form::text('address1',!empty($patient->address) ? $patient->address->address1 : null,['class' => 'form-control form-control-solid text-capitalize','placeholder' => 'Alamat']) }}
            </div>
            {{--    <div class="d-flex col-md-6 flex-column mb-7 fv-row">--}}
            {{--        {{ Form::label('address2',__('messages.patient.address2').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}--}}
            {{--        {{ Form::text('address2',!empty($patient->address) ? $patient->address->address2 : null,['class' => 'form-control form-control-solid','placeholder' => 'Address 2']) }}--}}
            {{--    </div>--}}
            <div class="d-flex col-md-6 flex-column mb-7 fv-row">
                {{ Form::label('country_id',__('messages.country.country').':',['class'=>'form-label fs-6 fw-bolder text-gray-700 mb-2']) }}
                {{ Form::select('country_id', $data['countries'] , null, ['id' => 'countryId','data-placeholder' => 'Negara','class' => 'form-select form-select-solid form-select-lg', 'data-control'=>'select2']) }}
            </div>
            <div class="d-flex col-md-6 flex-column mb-7 fv-row">
                {{ Form::label('state_id',__('messages.state.state').':',['class'=>'form-label fs-6 fw-bolder text-gray-700 mb-2']) }}
                {{ Form::select('state_id', [], null, ['id' => 'stateId','class' => 'form-select form-select-solid form-select-lg','data-placeholder' => 'Provinsi', 'data-control'=>'select2']) }}
            </div>
            <div class="d-flex col-md-6 flex-column mb-7 fv-row">
                {{ Form::label('city_id',__('messages.city.city').':',['class'=>'form-label fs-6 fw-bolder text-gray-700 mb-2']) }}
                {{ Form::select('city_id', [], null, ['id' => 'cityId','class' => 'form-select form-select-solid form-select-lg', 'data-placeholder' => 'Kota', 'data-control'=>'select2']) }}
            </div>
            {{--    <div class="col-md-6 fv-row mb-7">--}}
            {{--        {{ Form::label('postalCode',__('messages.patient.postal_code').':' ,['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-2']) }}--}}
            {{--        {{ Form::text('postal_code',!empty($patient->address) ? $patient->address->postal_code : null,['class' => 'form-control form-control-solid','placeholder' => 'Postal Code']) }}--}}
            {{--    </div>--}}
            <x-layout.form-submit></x-layout.form-submit>
        </div>
    </div>
</div>
