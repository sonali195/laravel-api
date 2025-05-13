<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'title',
		'description',
		'image',
		'slug',
		'time_spend',
		'meta_title',
		'meta_desc',
	];

	protected $dates = ['deleted_at'];

	protected $appends = ['image_url'];

	public function getImageUrlAttribute()
	{
		return $this->attributes['image'] != null ? Helper::assets(config('constant.blog_url') . $this->attributes['image']) : Helper::assets('assets/images/logo.png');
	}
}
