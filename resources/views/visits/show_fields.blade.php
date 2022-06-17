@php $styleCss = 'style'; @endphp
<x-layout.bar-patient :visit="$visit" />

<x-layout.bar-content>

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


