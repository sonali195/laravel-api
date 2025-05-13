<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelGuide extends Model
{

	use HasFactory, SoftDeletes;
	protected $table = 'travel_guides';
	protected $fillable = [
		'type',
		'title',
		'description_english',
		'description_urdu',
		'description_gujarati',
		'description_arbian',
		'slug',
		'time_spend',
		'meta_title',
		'meta_desc',
	];

	protected $dates = ['deleted_at'];
	public function scopeOfType($query, $type)
	{
		return $query->where(DB::raw('LOWER(type)'), strtolower($type));
	}
}
