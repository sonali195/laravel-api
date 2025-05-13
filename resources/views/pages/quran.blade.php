@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Surah & Ayah Viewer</h2>

    <!-- Tabs -->
    <ul class="nav nav-tabs" id="quranTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="surah-tab" data-bs-toggle="tab" href="#surah" role="tab" aria-controls="surah" aria-selected="true">All Surahs</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="ayah-tab" data-bs-toggle="tab" href="#ayah" role="tab" aria-controls="ayah" aria-selected="false">All Ayahs</a>
        </li>
    </ul>

    <div class="tab-content mt-3">
        <!-- Surahs Tab -->
      <!-- Surahs Tab -->
<div class="tab-pane fade show active" id="surah" role="tabpanel" aria-labelledby="surah-tab">
    <div class="accordion" id="surahAccordion">
        @foreach ($schedules as $index => $surah)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{ $index }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="false" aria-controls="collapse{{ $index }}">
                        {{ $surah->title_en }} ({{ $surah->ayats->count() }} Ayahs)
                    </button>
                </h2>
                <div id="collapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $index }}" data-bs-parent="#surahAccordion">
                    <div class="accordion-body">
                        <ul class="list-group">
                         
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>English Title:</strong>  {{ $surah->title_en }}
                                        <br>
                                        <strong>Arbic Title:</strong> {{ $surah->title_ar }}
                                        <br>
                                        <strong>Description:</strong> {{ strip_tags($surah->description) }}
                                    </div>
                                </li>
                          
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


        <!-- Ayah Viewer with Dropdown -->
        <div class="tab-pane fade" id="ayah" role="tabpanel" aria-labelledby="ayah-tab">
            <div class="mb-3 mt-3">
                <label for="surahSelect">Select a Surah</label>
                <select id="surahSelect" class="form-select">
                    <option value="">-- Choose Surah --</option>
                    @foreach ($schedules as $surah)
                        <option value="{{ $surah->id }}">{{ $surah->title_en }}</option>
                    @endforeach
                </select>
            </div>

            <div id="ayahContainer"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const schedules = @json($schedules);

        // Function to display Ayahs based on selected Surah
        function displayAyahs(surahId) {
            const surah = schedules.find(s => s.id == surahId);
            const container = $('#ayahContainer');

            if (surah && surah.ayats.length > 0) {
                let html = `
                    <div class="card mt-3">
                        <div class="card-header bg-primary text-white">
                            ${surah.title_en} - ${surah.ayats.length} Ayahs
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                `;
                surah.ayats.forEach(ayah => {
                    html += `<li class="list-group-item"><strong>Ayah ${ayah.ayah_number}:</strong> ${ayah.text}</li>`;
                });
                html += `</ul></div></div>`;
                container.html(html);
            } else {
                container.html('<p class="text-muted mt-3">No Ayahs available for this Surah.</p>');
            }
        }

        // Bind change event to Surah select dropdown
        $('#surahSelect').on('change', function() {
            const selectedId = $(this).val();
            displayAyahs(selectedId);
        });

        // Optional: Trigger change event on tab activation
        $('#ayah-tab').on('shown.bs.tab', function() {
            const selectedId = $('#surahSelect').val();
            if (selectedId) {
                displayAyahs(selectedId);
            }
        });
    });
</script>
@endsection
