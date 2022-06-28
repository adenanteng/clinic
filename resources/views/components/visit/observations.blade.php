<!--begin::dpjp-->
<x-visit.card-header>
    <x-slot name="title">{{ __('messages.visit.dpjp') }}</x-slot>
    <x-slot name="collapse">collapseDpjp</x-slot>

    <x-slot name="content">
        <x-visit.observation.form-template :visit='$visit' :observation="$observation">
            <x-slot name="collapse">collapseDpjp</x-slot>
            <x-slot name="route">add.observation</x-slot>
            <x-slot name="form">addDpjp</x-slot>

            <x-slot name="ppja_anamnesis"></x-slot>
            <x-slot name="subjective"></x-slot>
            <x-slot name="idk"></x-slot>
            <x-slot name="ttv"></x-slot>

        </x-visit.observation.form-template>

        <x-visit.observation.table-template :visit="$visit"/>
    </x-slot>
</x-visit.card-header>
<!--end::dpjp-->

<!--begin::dpjp-->
<x-visit.card-header>
    <x-slot name="title">{{ __('messages.visit.ppja') }}</x-slot>
    <x-slot name="collapse">collapsePpja</x-slot>

    <x-slot name="content">
        <x-visit.observation.form-template :visit='$visit' :observation="$observation">
            <x-slot name="collapse">collapsePpja</x-slot>
            <x-slot name="route">add.observation</x-slot>
            <x-slot name="form">addPpja</x-slot>

            <x-slot name="ppja_anamnesis"></x-slot>
            <x-slot name="subjective"></x-slot>
            <x-slot name="idk"></x-slot>

        </x-visit.observation.form-template>

        <x-visit.observation.table-template :visit="$visit"/>
    </x-slot>
</x-visit.card-header>
<!--end::dpjp-->
