@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Nearby Facilities</h2>

    @if($nearbyfacility->isNotEmpty())
        <div class="accordion" id="facilityAccordion">
            @foreach ($nearbyfacility as $index => $facility)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $index }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $index }}" aria-expanded="false" aria-controls="collapse-{{ $index }}">
                            {{ $index + 1 }}. {{ $facility->title }}
                        </button>
                    </h2>
                    <div id="collapse-{{ $index }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $index }}" data-bs-parent="#facilityAccordion">
                        <div class="accordion-body">
                            {!! $facility->description !!}
                            @if($facility->icon)
                                <div class="mt-2">
                                    <i class="{{ $facility->icon }}"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-muted">No nearby facilities available at the moment.</p>
    @endif
</div>
@endsection
