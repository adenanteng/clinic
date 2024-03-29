<script id="userActionTemplate" type="text/x-jsrender">
    {{if emailVerified}}
        <a href="#"  data-id="{{:userId}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 email-verification
             data-bs-toggle="tooltip" title="Resend Email Verification">
            <span class="svg-icon svg-icon-3">
                <i class="fad fa-envelope"></i>
            </span>
        </a>
    {{/if}}

<a href="#"  data-id="{{:userId}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 add-qualification
 data-bs-toggle="tooltip" title="Add Qualification" data-bs-original-title="Cancel avatar" data-kt-image-input-action="cancel">
        <span class="svg-icon svg-icon-3">
        <i class="fad fa-plus"></i>
    </span>
</a>
<a href="{{:editUrl}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="tooltip" title="Edit">
    <span class="svg-icon svg-icon-3">
        <i class="fad fa-pen"></i>
    </span>
</a>
<a href="#" data-id={{:id}}" class="delete-btn btn btn-icon btn-bg-light text-hover-primary btn-sm" data-bs-toggle="tooltip" title="Delete">
    <span class="svg-icon svg-icon-3">
        <i class="fad fa-trash"></i>
    </span>
</a>

</script>

<script id="qualificationTemplateData" type="text/x-jsrender">
    <tr>
     <td>{{:id}}</td>
     <td>{{:degree}}</td>
    <td>{{:university}}</td>
    <td>{{:year}}</td>
    <td class="text-center">
     <a data-id="{{:id}}" class="btn edit-btn-qualification btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="tooltip" title="Edit">
                        <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                        <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                        </svg></span>
    </a>
    <a  data-id={{:id}}" class="delete-btn-qualification btn btn-icon btn-bg-light btn-active-color-primary btn-sm" data-bs-toggle="tooltip" title="Delete">
                        <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24" />
                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />
                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" /></g></svg></span>
    </a>
    </td>
    </tr>
</script>

<script id="sessionTemplateData" type="text/x-jsrender">
            <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
            <div class="fw-bold ms-5">
                <div class=" fs-7 mb-1"><?php echo __('messages.doctor_session.session_time_in_minutes') ?> :
                    <span class="fs-7 text-gray-400 text-uppercase">{{:time}}</span>
                </div>
                <div class="fs-7 text-gray-400"><?php echo __('messages.doctor_session.morning_session') ?> :
                    <a href="#">
    {{:morningSessionStart}} To {{:morningSessionEnd}}</a>
                </div>
                <div class="fs-7 text-gray-400"><?php echo __('messages.doctor_session.evening_session') ?> :
                    <a href="#">
    {{:eveningSessionStart}} To {{:eveningSessionEnd}}</a>
                </div>
            </div>


</script>

<script id="changeDoctorStatus" type="text/x-jsrender">
    <div class="form-check form-switch form-check-custom form-check-solid me-10">
        <input class="form-check-input h-20px w-30px doctor-status" data-id="{{:id}}" type="checkbox"  id="flexSwitch20x30"
            {{:status == 1 ? 'checked' : ''}}>
    </div>

</script>
