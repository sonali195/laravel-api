@extends('layouts.app')
@section('title') Ziyarat & Dua  @endsection

@section('breadcrumb')
    <div class="row page-title align-items-center">
        <div class="col-sm-6 col-xl-6">
            <h4 class="mb-1 mt-0 font-weight-medium">Ziyarat & Dua</h4>
        </div>
    </div>
@endsection

@section('content')
<section class="mb-2" style="margin: 92PX;">
    <div class="row justify-content-center">
@php
    $typeLabels = [
        'ziyarat' => 'Ziyarat',
        'dua'     => 'Dua',
        'amaal'   => 'Amaal',
    ];
    $languages = [
        'english'  => 'English',
        'urdu'     => 'Urdu',
        'gujarati' => 'Gujarati',
        'arbian'   => 'Arabic',
    ];
@endphp

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  @if(!empty($data))
    {{-- Tabs Nav --}}
    <ul class="nav nav-tabs" id="travelTabs" role="tablist">
      @foreach($data as $key => $items)
        <li class="nav-item">
          <button class="nav-link @if($loop->first) active @endif"
                  data-bs-toggle="tab"
                  data-bs-target="#{{ $key }}">
            {{ $typeLabels[$key] }}
          </button>
        </li>
      @endforeach
    </ul>

    {{-- Tabs Content --}}
    <div class="tab-content mt-3">
      @foreach($data as $key => $items)
        <div class="tab-pane fade @if($loop->first) show active @endif" id="{{ $key }}">
          <div class="accordion" id="acc-{{ $key }}">
            @foreach($items as $index => $item)
              <div class="accordion-item mb-2">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed"
                          data-bs-toggle="collapse"
                          data-bs-target="#collapse-{{ $key }}-{{ $index }}">
                    {{ $index + 1 }}. {{ $item->title }}
                  </button>
                </h2>
                <div id="collapse-{{ $key }}-{{ $index }}"
                     class="accordion-collapse collapse"
                     data-bs-parent="#acc-{{ $key }}">
                  <div class="accordion-body">
                    {{-- Per-item language buttons --}}
                    <div class="mb-2">
                      @foreach($languages as $langKey => $langName)
                        <button type="button"
                                class="btn btn-sm btn-outline-primary lang-btn @if($langKey==='english') active @endif"
                                data-lang="{{ $langKey }}">
                          {{ $langName }}
                        </button>
                      @endforeach
                    </div>

                    {{-- Descriptions --}}
                    @foreach($languages as $langKey => $langName)
                      <div class="desc-{{ $langKey }} @if($langKey!=='english') d-none @endif">
                        <strong>{{ $langName }}:</strong><br>
                        {!! str_replace(['<pre>','</pre>'], '', $item->{'description_'.$langKey}) !!}
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endforeach
    </div>
  @else
    <p>No Travel Guide content available.</p>
  @endif

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // For each accordion-body, wire up its own lang-btns
      document.querySelectorAll('.accordion-body').forEach(body => {
        const btns = body.querySelectorAll('.lang-btn');
        btns.forEach(btn => {
          btn.addEventListener('click', () => {
            // activate this button only
            btns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const lang = btn.getAttribute('data-lang');
            // show/hide descriptions in this body only
            body.querySelectorAll('[class^="desc-"]').forEach(desc => {
              const key = desc.className.match(/desc-([a-z]+)/)[1];
              desc.classList.toggle('d-none', key !== lang);
            });
          });
        });
      });
    });
  </script>
  </section>
</div>