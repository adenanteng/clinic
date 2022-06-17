<div class="col-md-12 mb-5 mt-5">
    <div class="w-100 d-flex justify-content-end">
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-3']) }}
        <a href="{{ url()->previous() }}" class="btn btn-secondary me-3 "  >
            {{ __('messages.common.discard') }}
        </a>
    </div>
</div>
