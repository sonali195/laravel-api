{{-- resources/views/schedule.blade.php --}}
@extends('layouts.app')
@section('title') Schedule of Mawkib  @endsection

@section('breadcrumb')
    <div class="row page-title align-items-center">
        <div class="col-sm-6 col-xl-6">
            <h4 class="mb-1 mt-0 font-weight-medium">Ziyarat & Dua</h4>
        </div>
    </div>
@endsection

@section('content')
@php
    use Carbon\Carbon;

    // Group the schedules by date
    $grouped = $schedules->groupBy(fn($s) => Carbon::parse($s->event_date)->format('Y-m-d'));

    // Category map
    $categoryMap = [
        1 => ['name' => 'Majlis', 'class' => 'category-majlis'],
        2 => ['name' => 'Nauha',  'class' => 'category-nauha'],
    ];
@endphp

<style>
    body.pb-0.left-side-menu-dark.no-sidebar{
        margin: 92px 32px !important;
    }
    .schedule-wrapper {
      max-width: 400px;
      margin: 0 auto;
      padding: 16px;
      font-family: sans-serif;
    }
    .date-header {
      color: #555;
      font-weight: 500;
      margin: 24px 0 8px;
    }
    .schedule-card {
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 12px 16px;
      margin-bottom: 12px;
      background: #fff;
    }
    .schedule-title {
      font-size: 16px;
      font-weight: 600;
      color: #222;
      margin-bottom: 6px;
    }
    .schedule-info {
      font-size: 14px;
      color: #666;
      display: flex;
      align-items: center;
      gap: 4px;
    }
    .category-majlis { color: #198754; font-weight: 500; }
    .category-nauha  { color: #0d6efd; font-weight: 500; }
    .separator { /* the “•” bullet */ }
</style>

<div class="schedule-wrapper">
  <h2 style="text-align:center; margin-bottom:16px;">Schedule of Mawkib</h2>

  @forelse($grouped as $date => $items)
    <div class="date-header">
      {{ Carbon::parse($date)->format('D d M') }}
    </div>

    @foreach($items as $item)
      @php
        $cat = $categoryMap[$item->category] 
             ?? ['name'=>'Unknown','class'=>'category-unknown'];
      @endphp

      <div class="schedule-card">
        <div class="schedule-title">
          Recite with {{ $item->title }}
        </div>
        <div class="schedule-info">
          <span class="{{ $cat['class'] }}">{{ $cat['name'] }}</span>
          <span class="separator">•</span>
          <span>Starts from {{ Carbon::parse($item->start_time)->format('g:ia') }}</span>
        </div>
      </div>
    @endforeach

  @empty
    <p style="text-align:center; color:#888;">No schedules available.</p>
  @endforelse
</div>
