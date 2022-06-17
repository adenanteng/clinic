<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container">
        {{ $status ?? '' }}
        <div class="card ">
            <div class="card-header d-flex border-0 pt-6">
                @include('layouts.search-component')
                <div class="card-toolbar ms-auto">
                    {{ $filter ?? '' }}
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        @if(!empty($button_title))
                        <a type="button" class="btn btn-primary" href="{{ $button_url ?? '#' }}" id="{{ $button_id ?? '' }}">
                            <i class="fad fa-plus"></i>
                            {{ $button_title }}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            {{ $slot }}
        </div>
    </div>
</div>
