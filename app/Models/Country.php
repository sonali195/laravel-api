<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'short_code',
        'iso_code',
        'status',
        'flag',
        'currency',
        'currency_symbol'
    ];

    /**
     * getFlagAttribute
     *
     * @return void
     */
    public function getFlagAttribute()
    {
        return isset($this->attributes['flag']) && $this->attributes['flag'] != null ? Helper::assets(config('constant.flag_url') . $this->attributes['flag']) : "";
    }
}
