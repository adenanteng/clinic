@php $styleCss = 'style'; @endphp
<x-layout.bar-patient :visit="$visit" />

<x-layout.bar-content>

{{--    <nav>--}}
{{--        <div class="nav nav-tabs" id="nav-tab" role="tablist">--}}
{{--            <button class="nav-link active" id="nav-home-tab"  data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home</button>--}}
{{--            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>--}}
{{--            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button>--}}
{{--        </div>--}}
{{--    </nav>--}}
{{--    <div class="tab-content" id="nav-tabContent">--}}
{{--        <div class="tab-pane fade " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">...</div>--}}
{{--        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>--}}
{{--        <div class="tab-pane fade" id="nav-contact"  aria-labelledby="nav-contact-tab">...</div>--}}
{{--    </div>--}}

    <!--begin:::Tabs-->
    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8" id="nav-tab" role="tablist">
        <li class="nav-item">
            <button class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" role="tab" data-bs-target="#nav-observation" aria-selected="true">{{ __('messages.visit.observations') }}</button>
        </li>
        <li class="nav-item">
            <button class="nav-link text-active-primary pb-4" data-bs-toggle="tab" role="tab" data-bs-target="#nav-problem" aria-selected="false">{{ __('messages.visit.problems') }}</button>
        </li>
        <li class="nav-item">
            <button class="nav-link text-active-primary pb-4" data-bs-toggle="tab" role="tab" data-bs-target="#nav-prescription" aria-selected="false">{{ __('messages.visit.prescriptions') }}</button>
        </li>
        <li class="nav-item">
            <button class="nav-link text-active-primary pb-4" data-bs-toggle="tab" role="tab" data-bs-target="#nav-billing" aria-selected="false">{{ __('messages.visit.billings') }}</button>
        </li>
        <li class="nav-item">
            <button class="nav-link text-active-primary pb-4" data-bs-toggle="tab" role="tab" data-bs-target="#nav-lab" aria-selected="false">{{ __('messages.visit.documents') }}</button>
        </li>
    </ul>
    <!--end:::Tabs-->

    <!--begin:::Tab content-->
    <div class="tab-content" id="myTabContent">
        <div id="nav-observation" class="tab-pane fade show active" role="tabpanel" data-bs-parent="#myTabContent">
            <x-visit.observations :visit="$visit" :observation="$observation" />
        </div>
        <div id="nav-problem" class="tab-pane fade" role="tabpanel" data-bs-parent="#myTabContent">
            <x-visit.problems :visit="$visit" />
        </div>
        <div id="nav-prescription" class="tab-pane fade" role="tabpanel" data-bs-parent="#myTabContent">
            <x-visit.prescriptions :visit="$visit" :prescription="$prescription" />
        </div>
        <div id="nav-billing" class="tab-pane fade" role="tabpanel" data-bs-parent="#myTabContent">
            <x-visit.billings :visit="$visit" :treatment="$treatment" />
        </div>
        <div id="nav-lab" class="tab-pane fade" role="tabpanel" data-bs-parent="#myTabContent">
            <x-visit.labs :visit="$visit" :lab="$lab" />
        </div>
    </div>
    <!--end:::Tab content-->
</x-layout.bar-content>


