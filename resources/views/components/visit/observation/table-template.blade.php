<div class="d-grid gap-3 visit-observations accordion" id="accordionExample">
    @if(!empty($visit->observations))
        @forelse($visit->observations as $key => $val)
            <div class="card d-flex border-1 border border-secondary accordion-item">
                <div class="accordion-header" id="heading{{$key}}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <div class="">
                                <h3 class="card-title d-inline me-5">{{ $val->observation_name }}</h3>
                                <span class="text-muted d-inline me-3" >{{ $val->updated_at }}</span>
                                <span class="badge badge-success">{{ $val->create_user }}</span>
                            </div>
                            <div>
                                <a href="#" data-id="{{$val->id}}" class="edit-observation text-hover-primary me-2" title="Edit">
                                    <i class="fas fa-pen "></i>
                                </a>
                                <a href="#" data-id="{{$val->id}}" class="remove-observation text-hover-danger me-2" title="Delete">
                                    <i class="fas fa-trash "></i>
                                </a>
                            </div>
                        </div>
                    </button>
                </div>
                <div class="card-body border-1 border-top border-secondary accordion-collapse collapse" aria-labelledby="heading{{$key}}" data-bs-parent="#accordionExample" id="collapse{{$key}}">
                    <div class="accordion-body">
                        <div class="">
                            <h6 class="text-decoration-underline">Subjective</h6>
                            <div class="ps-5 mt-5">
                                <p class="card-text"><span class="text-muted">Symptoms : </span> {{ $val->symptoms }}</p>
                                <p class="card-text"><span class="text-muted">Anamnesis : </span> {{ $val->anamnesis }}</p>
                                <p class="card-text"><span class="text-muted">Prognosis : </span> {{ $val->prognosis }}</p>
                                <p class="card-text"><span class="text-muted">Anamnesis : </span> {{ $val->anamnesis }}</p>
                            </div>
                        </div>
                        <div class="mt-8">
                            <h6 class="text-decoration-underline">Objective</h6>
                            <div class="ps-5 mt-5 row">
                                <div class="col">
                                    <p class="card-text"><span class="text-muted">Temperature : </span> {{ $val->temperature }}</p>
                                    <p class="card-text"><span class="text-muted">Awareness : </span> {{ $val->awareness }}</p>
                                    <p class="card-text"><span class="text-muted">Height : </span> {{ $val->height }}</p>
                                    <p class="card-text"><span class="text-muted">Weight : </span> {{ $val->weight }}</p>
                                </div>
                                <div class="col">
                                    <p class="card-text"><span class="text-muted">Systole : </span> {{ $val->systole }}</p>
                                    <p class="card-text"><span class="text-muted">Diastole : </span> {{ $val->diastole }}</p>
                                    <p class="card-text"><span class="text-muted">Respiratory Rate : </span> {{ $val->respiratory_rate }}</p>
                                    <p class="card-text"><span class="text-muted">Heart Rate : </span> {{ $val->heart_rate }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-8">
                            <h6 class="text-decoration-underline">Assessment</h6>
                            <div class="ps-5 mt-5 row">
                                <p class="card-text">{{ $val->assessment }}</p>
                            </div>
                        </div>
                        <div class="mt-8">
                            <h6 class="text-decoration-underline">Plan</h6>
                            <div class="ps-5 mt-5 row">
                                <p class="card-text">{{ $val->plan }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center fw-bold mt-3 text-muted text-gray-600">{{ __('messages.common.no_records_found') }}</p>
        @endforelse
    @endif
</div>
