<script id="appointmentsTemplate" type="text/x-jsrender">
    {{if role == 1}}
    {{if canceled == 1}}

    <a href="javascript:void(0)" data-id="{{:id}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit-btn cancel-appointment"
     data-bs-custom-class="tooltip-dark" data-bs-placement="bottom" title="Cancel Appointment">
        <i class="fas fa-calendar-times text-danger fs-4"></i>
    </a>

    {{/if}}
    {{/if}}
    <a href="{{:visitUrl}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="tooltip" title="Layani">
        <i class="fas fa-stethoscope fs-4"></i>
    </a>

    <a href="{{:showUrl}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="tooltip" title="Show">
        <i class="fas fa-eye fs-4"></i>
    </a>

<!--    <a href="#" data-id="{{:id}}" class="delete-btn btn btn-icon btn-bg-light text-hover-primary btn-sm" data-bs-toggle="tooltip" title="Delete">-->
<!--        <span class="svg-icon svg-icon-3">-->
<!--        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www`.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">-->
<!--        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">-->
<!--        <rect x="0" y="0" width="24" height="24" />-->
<!--        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />-->
<!--        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" /></g></svg></span>-->
<!--    </a>-->



</script>
