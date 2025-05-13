<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('live_program', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category'); // 'Nauha', 'Majlis'
            $table->date('event_date');
            $table->time('start_time');
            $table->string('duration');
            $table->time('video_url');
            $table->timestamps();
            $table->softDeletes();
        });;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_program');
    }
};
