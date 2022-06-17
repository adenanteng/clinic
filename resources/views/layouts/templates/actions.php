<script id="actionsTemplates" type="text/x-jsrender">

    {{if emailVerified}}
        <a href="#"  data-id="{{:userId}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 email-verification
             data-bs-toggle="tooltip" title="Resend Email Verification">
            <span class="svg-icon svg-icon-3">
                <i class="fad fa-envelope"></i>
            </span>
        </a>
    {{/if}}

    <a href="{{:editUrl}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit-btn" data-bs-toggle="tooltip" title="Edit">
        <span class="svg-icon svg-icon-3">
                <i class="fad fa-pen"></i>
            </span>
    </a>

    {{if !hideDelete}}
    <a href="#" data-id="{{:id}}" class="delete-btn btn btn-icon btn-bg-light text-hover-primary btn-sm" data-bs-toggle="tooltip" title="Delete">
        <span class="svg-icon svg-icon-3">
                <i class="fad fa-trash"></i>
            </span>
    </a>
    {{/if}}

</script>

<script id="sliderActionsTemplates" type="text/x-jsrender">
    <a href="{{:editUrl}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit-btn" data-bs-toggle="tooltip" title="Edit">
        <span class="svg-icon svg-icon-3">
            <i class="fad fa-pen"></i>
        </span>
    </a>
</script>
