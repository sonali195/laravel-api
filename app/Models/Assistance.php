<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assistance extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'assistance';
    protected $fillable = [
        'assistance_type',
        'full_name',
        'contact_number',
        'description',
        // 'whatsapp_no',
        // 'safety_rules',
        'image',
    ];

    protected $dates = ['deleted_at'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return $this->attributes['image'] != null ? Helper::assets(config('constant.assistance_url') . $this->attributes['image']) : Helper::assets('assets/images/logo.png');
    }
}
