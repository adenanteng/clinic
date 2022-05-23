<script id="visitsTemplate" type="text/x-jsrender">
    <a href="{{:editUrl}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit-btn" data-bs-toggle="tooltip" title="Edit">
                        <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                        <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                        </svg></span>
    </a>
    <a href="{{:showUrl}}" title="Show" class="btn btn-icon btn-bg-light text-hover-primary btn-sm me-1" data-bs-toggle="tooltip">
        <i class="fas fa-eye fs-4"></i>
    </a>
    <a href="#" data-id="{{:id}}" class="delete-btn btn btn-icon btn-bg-light text-hover-primary btn-sm" data-bs-toggle="tooltip" title="Delete">
                        <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24" />
                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />
                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" /></g></svg></span>
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
