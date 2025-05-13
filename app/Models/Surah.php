<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Surah extends Model
{

    use HasFactory, SoftDeletes;
    protected $table = 'surahs_quran';
    protected $fillable = [
        'title_en',
        'title_ar',
        'description',
        'total_number',
    ];

    protected $dates = ['deleted_at'];
    public function ayats()
    {
        return $this->hasMany(Ayat::class);
    }
    // public function ayahs()
    // {
    //     return $this->hasMany(Ayat::class, 'surah_id'); // or 'schedule_id' if that's the key
    // }
}
