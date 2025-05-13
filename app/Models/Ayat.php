<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ayat extends Model
{

    use HasFactory, SoftDeletes;
    protected $table = 'ayat_quran';
    protected $fillable = [
        'surah_id',
        'title_ar',
        'title_translation',
        'title_transliteration',
    ];

    protected $dates = ['deleted_at'];

    public function surah()
    {
        return $this->belongsTo(Surah::class, 'surah_id');
    }
}
