<!--begin::dpjp-->
<x-visit.card-header>
    <x-slot name="title">{{ __('messages.visit.dpjp') }}</x-slot>
    <x-slot name="collapse">collapseObservation</x-slot>

    <x-slot name="content">
        <x-visit.observation.form-template :visit='$visit' :observation="$observation">
            <x-slot name="collapse">collapseObservation</x-slot>
            <x-slot name="route">add.observation</x-slot>
            <x-slot name="form">addObservation</x-slot>

            <x-slot name="ppja_anamnesis"></x-slot>
            <x-slot name="ppja_nyeri"></x-slot>

        </x-visit.observation.form-template>

{{--        <x-visit.observation.table-template>--}}
{{--            --}}
{{--        </x-visit.observation.table-template>--}}
    </x-slot>
</x-visit.card-header>
<!--end::dpjp-->
