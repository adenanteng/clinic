<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container">
        <div class="d-flex flex-column flex-lg-row">
            <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.errors')
                    </div>
                </div>
                <div class="">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
