<!--begin::Card-->
<x-visit.card-header >
    <x-slot name="title">{{ __('messages.visit.labs') }}</x-slot>
    <x-slot name="collapse">collapseLab</x-slot>

    <x-slot name="content">
        <x-visit.boilerplate.form-template :visit='$visit' :lab="$lab">
            <x-slot name="collapse">collapseLab</x-slot>
            <x-slot name="route">add.lab</x-slot>
            <x-slot name="form">addLab</x-slot>

        </x-visit.boilerplate.form-template>

        <table class="table align-middle overflow-auto table-row-dashed fs-6 gy-5 mt-5 whitespace-nowrap">
                <thead>
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    <th scope="col">{{ __('messages.lab.date') }}</th>
                    <th scope="col">{{ __('messages.lab.type') }}</th>
                    <th scope="col">{{ __('messages.lab.treatment') }}</th>
                    <th scope="col">{{ __('messages.common.status') }}</th>
                    <th class="text-center" width="20%">{{ __('messages.common.action') }}</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold visit-labs">
                @if(!empty($visit->labs))
                    @forelse($visit->labs as $key => $lab)
                        <tr id="labLists">
                            <td class="text-break text-wrap">{{$lab->date}}</td>
                            <td class="text-break text-wrap">{{$lab->type_id}}</td>
                            <td class="text-break text-wrap">{{$lab->treatment_id}}</td>
                            <td class="text-break text-wrap"><span class="badge badge-success">{{$lab->status}}</span></td>
                            <td class="text-center">
                                <a href="#" data-id="{{$lab->id}}"
                                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit-lab-btn"
                                   :class="{{$lab->status}} === 1 ? 'disabled' : ''" title="Edit">
                                    <i class="fad fa-pen"></i>
                                </a>
                                <a href="#" data-id="{{$lab->id}}"
                                   class="delete-lab-btn btn btn-icon btn-bg-light text-hover-danger btn-sm"
                                   :class="{{$lab->status}} === 1 ? 'disabled' : ''" title="Delete">
                                    <i class="fad fa-trash "></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr id="nolabLists">
                            <td colspan="5" class="text-center font-text-muted text-gray-600" >
                                {{ __('messages.common.no_data_available_in_table') }}
                            </td>
                        </tr>
                    @endforelse
                @endif
                </tbody>
            </table>

    </x-slot>
    <!--end::Card body-->
</x-visit.card-header>
<!--end::Card-->
