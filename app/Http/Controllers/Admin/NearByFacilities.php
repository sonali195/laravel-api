<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NearByFacilities extends Model
{

	use HasFactory, SoftDeletes;
	protected $table = 'near_by_facilities';    
	protected $fillable = [
		'title',
		'description',
	];
}
