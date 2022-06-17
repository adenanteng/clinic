<script id="visitsTemplate" type="text/x-jsrender">
    <a href="{{:editUrl}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit-btn" data-bs-toggle="tooltip" title="Edit">
    <span class="svg-icon svg-icon-3">
        <i class="fad fa-pen"></i>
    </span>
    </a>
    <a href="{{:showUrl}}" title="Show" class="btn btn-icon btn-bg-light text-hover-primary btn-sm me-1" data-bs-toggle="tooltip">
    <span class="svg-icon svg-icon-3">
        <i class="fad fa-eye"></i>
    </span>
    </a>
    <a href="#" data-id="{{:id}}" class="delete-btn btn btn-icon btn-bg-light text-hover-primary btn-sm" data-bs-toggle="tooltip" title="Delete">
    <span class="svg-icon svg-icon-3">
        <i class="fad fa-trash"></i>
    </span>
    </a>






</script>

<script id="visitsObservationTblTemplate" type="text/x-jsrender">
<div class="card d-flex border-1 border border-secondary" x-data="{collapse: false}">
        <div class="card-body" role="button" @click="collapse=!collapse">
            <div class="d-inline">
                <h3 class="card-title d-inline me-5">{{:name}}</h3>
                <span class="text-muted d-inline me-3" >{{:date}}</span>
                <span class="badge badge-success">{{:user}}</span>

            </div>
            <span class="d-inline float-end">
                <i class="fas fa fa-angle-down" x-show="!collapse" ></i>
                <i class="fas fa fa-angle-up" x-show="collapse" ></i>
            </span>
        </div>
        <div class="card-body border-1 border-top border-secondary" x-show="collapse" x-transition>
            <div class="">
                <h6 class="text-decoration-underline">Subjective</h6>
                <div class="ps-5 mt-5">
                    <p class="card-text"><span class="text-muted">Symptoms : </span> {{:symptoms}}</p>
                    <p class="card-text"><span class="text-muted">Anamnesis : </span> {{:anamnesis}}</p>
                    <p class="card-text"><span class="text-muted">Prognosis : </span> {{:prognosis}}</p>
                    <p class="card-text"><span class="text-muted">Anamnesis : </span> {{:anamnesis}}</p>
                </div>
            </div>
            <div class="mt-8">
                <h6 class="text-decoration-underline">Objective</h6>
                <div class="ps-5 mt-5 row">
                    <div class="col">
                        <p class="card-text"><span class="text-muted">Temperature : </span> {{:temperature}}</p>
                        <p class="card-text"><span class="text-muted">Awareness : </span> {{:}}awareness</p>
                        <p class="card-text"><span class="text-muted">Height : </span> {{:height }}</p>
                        <p class="card-text"><span class="text-muted">Weight : </span> {{:weight }}</p>
                    </div>
                    <div class="col">
                        <p class="card-text"><span class="text-muted">Systole : </span> {{:systole}}</p>
                        <p class="card-text"><span class="text-muted">Diastole : </span> {{:diastole}}</p>
                        <p class="card-text"><span class="text-muted">Respiratory Rate : </span> {{:respiratory}}</p>
                        <p class="card-text"><span class="text-muted">Heart Rate : </span> {{:heart}}</p>
                    </div>
                </div>
            </div>
            <div class="mt-8">
                <h6 class="text-decoration-underline">Assessment</h6>
                <div class="ps-5 mt-5 row">
                    <p class="card-text">{{:assessment}}</p>
                </div>
            </div>
            <div class="mt-8">
                <h6 class="text-decoration-underline">Plan</h6>
                <div class="ps-5 mt-5 row">
                    <p class="card-text">{{:plan}}</p>
                </div>
            </div>

        </div>
    </div>
</script>

<script id="visitsPrescriptionTblTemplate" type="text/x-jsrender">
    <tr>
        <td class="text-break text-wrap">{{:name}}</td>
        <td class="text-break text-wrap">{{:frequency}} x 1</td>
        <td class="text-break text-wrap">{{:duration}} Hari</td>
        <td class="text-break text-wrap"><span class='badge badge-success'>{{:status}}</span></td>
        <td class="text-center">
            <a href="#" data-id="{{:id}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit-prescription-btn"
            title="Edit" @click="create=true">
                <i class="fas fa-pen"></i>
            </a>
            <a href="#" data-id="{{:id}}" class="delete-prescription-btn btn btn-icon btn-bg-light text-hover-danger btn-sm" title="Delete">
             <i class="fas fa-trash "></i>
             </a>
        </td>
    </tr>
</script>

<script id="visitsBillingTblTemplate" type="text/x-jsrender">
    <tr>
        <td class="text-break text-wrap">{{:name}}</td>
        <td class="text-break text-wrap"><span class='badge badge-success'>{{:type}}</span></td>
        <td class="text-break text-wrap text-center">{{:unit}}</td>
        <td class="text-break text-wrap">{{:unit_price}}</td>
        <td class="text-break text-wrap"><span class='badge badge-success'>{{:subtotal}}</span></td>
        <td class="text-center">
            <a href="#" data-id="{{:id}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit-billing-btn"
            title="Edit" @click="create=true">
                <i class="fas fa-pen"></i>
            </a>
            <a href="#" data-id="{{:id}}" class="delete-billing-btn btn btn-icon btn-bg-light text-hover-danger btn-sm" title="Delete">
             <i class="fas fa-trash "></i>
             </a>
        </td>
    </tr>

</script>
