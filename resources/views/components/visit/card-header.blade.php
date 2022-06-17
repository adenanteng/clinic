<div class="card card-flush mb-6 mb-xl-9" >
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center w-100">
            <h3 class="align-left m-0">{{ $title }}</h3>
            <div class="ml-auto d-flex align-items-center">
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                        data-bs-target="#{{$collapse}}" aria-expanded="false"
                        aria-controls="{{$collapse}}">
                    <i class="fa fa-plus"></i>{{ __('messages.common.add') }}
                </button>
            </div>
        </div>
    </div>
    <div class="card-body border-1 border-top border-secondary pb-9 ">
        {{ $content }}
    </div>
</div>
