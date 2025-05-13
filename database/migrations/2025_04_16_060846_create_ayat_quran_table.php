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
        Schema::create('ayat_quran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surah_id')->constrained('surahs_quran')->onDelete('cascade');
            $table->string('title_ar')->nullable();
            $table->string('title_translation')->nullable();
            $table->string('title_transliteration')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ayat_quran');
    }
};
