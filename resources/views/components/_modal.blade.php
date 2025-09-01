@if(isset($formAction))
<div class="modal" id="danger-{{ $modalId }}" tabindex="-1">
    <div class="modal-dialog modal-sm" role="document">
        <form action="{{ $formAction }}" method="POST" class="modal-content">
            @csrf
            @method($formMethod ?? 'POST')
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 9v2m0 4v.01" />
                    <path
                        d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                </svg>
                <h3>{{ $modalTitle }}</h3>
                <div class="text-secondary">
                    {{ $modalDescription }}
                </div>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col">
                            <a href="#" class="btn w-100" data-bs-dismiss="modal"> Cancel </a>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-danger w-100"> {{ $modalButton }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endif

@if(isset($modalButton1) && isset($trainingId))
<div class="modal" id="success-{{ $modalId }}" tabindex="-1">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="modal-status bg-success"></div>
      <div class="modal-body text-center py-4">
        <h3>{{ $modalTitle }}</h3>
        <div class="text-secondary">
          {{ $modalDescription }}
        </div>
      </div>
      <div class="modal-footer">
        <div class="w-100">
          <div class="row">
            <div class="col">
              <form action="{{ route('training.reject', $trainingId) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn w-100">{{ $modalButton1 }}</button>
              </form>
            </div>
            <div class="col">
              <form action="{{ route('training.approve', $trainingId) }}" method="POST" class="d-inline">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-success w-100">{{ $modalButton2 }}</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endif
