<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container">
        {{ $status ?? '' }}
        <div class="card">
            <div class="card-header d-flex border-0 pt-6">
                @include('layouts.search-component')
                <div class="card-toolbar ms-auto">
                    {{ $filter ?? '' }}
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        @if(!empty($button_title))
                        <a type="button" class="btn btn-primary" href="{{ $button_url ?? '#' }}" id="{{ $button_id ?? '' }}">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/><rect fill="#000000" opacity="0.5" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000)" x="4" y="11" width="16" height="2" rx="1"/></svg>
                            </span>
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
