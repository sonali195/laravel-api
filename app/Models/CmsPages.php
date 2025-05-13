<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsPages extends Model
{

	protected $fillable = [
		'page_name', 'contents', 'slug',
	];

	public $timestamps = false;


	/**
	 * GetContentsAttribute
	 *
	 * @return void
	 */
	public function getContentsAttribute()
	{
		return $this->attributes['contents'] ? json_decode($this->attributes['contents'], true) : [];
	}
}
