@extends('layouts.app')

@section('content')
@php
    use Carbon\Carbon;
@endphp

<style>
        body.pb-0.left-side-menu-dark.no-sidebar {
    margin-top: 86px;
}
    .live-program-container {
        max-width: 400px;
        margin: 0 auto;
        padding: 16px;
    }

    .live-card {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 16px;
        margin-bottom: 20px;
        overflow: hidden;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .live-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .live-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #dc3545;
        color: #fff;
        font-size: 12px;
        padding: 4px 10px;
        border-radius: 20px;
        font-weight: bold;
    }

    .live-card-body {
        padding: 16px;
    }

    .program-title {
        font-weight: 600;
        font-size: 16px;
        margin-bottom: 6px;
    }

    .program-meta {
        font-size: 13px;
        color: #6c757d;
        margin-bottom: 10px;
    }

    .listen-now {
        color: #0d6efd;
        font-weight: 600;
        text-decoration: none;
    }

    .listen-now:hover {
        text-decoration: underline;
    }

    .position-relative {
        position: relative;
    }
</style>

<div class="live-program-container">
    <h4 class="text-center mb-4">Live Programs</h4>

    @forelse ($liveProgram as $program)
        @php
            // Parse start_time and convert it to Asia/Kolkata timezone
            $startTime = Carbon::parse($program->start_time);


            // Assuming the duration is in minutes (for example, 45 minutes)
            $durationInMinutes = isset($program->duration) ? (int) $program->duration : 0; // Duration in minutes
           
            $endTime = $durationInMinutes > 0 ? $startTime->copy()->addMinutes($durationInMinutes) : $startTime;  // Fallback if no duration
            // echo $endTime;
            // echo $startTime;
            // Get the current time in Asia/Kolkata timezone
            $now = Carbon::now('Asia/Kolkata');

            // Check if the event is live
            $eventDate = Carbon::parse($program->event_date);
            $isLive = $eventDate->isToday()  && $now->lte($endTime); 
            $isLiveStart = $eventDate->isToday() && $now->gte($startTime); 
            
             // Event is live if current time is within the event's time range

            // Extract YouTube Video ID
            preg_match('/(?:youtube\.com.*(?:\\?|&)v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $program->video_url, $matches);
            $videoId = $matches[1] ?? null;
            $thumbnail = $videoId
                ? "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg"
                : asset('images/default-thumbnail.jpg'); // fallback image
        @endphp

        <div class="live-card">
            <div class="position-relative">
                <img src="{{ $thumbnail }}" alt="{{ $program->title }}">
                @if ($isLive || $isLiveStart)
                    <span class="live-badge">🔴 Live</span>
                @endif
            </div>
            <div class="live-card-body">
                <div class="program-title">{{ $program->title }}</div>
                <div class="program-meta">
                    {{ $eventDate->format('d M') }} • Starts from {{ $startTime->format('g:ia') }}
                </div>
                @if ($program->video_url)
                    <a href="{{ $program->video_url }}" class="listen-now" target="_blank" rel="noopener noreferrer">
                        ▶️ Listen now
                    </a>
                @endif
            </div>
        </div>
    @empty
        <p class="text-center text-muted">No live programs available.</p>
    @endforelse
</div>
