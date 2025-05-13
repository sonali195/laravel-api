<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{

	use HasFactory, SoftDeletes;
	protected $table = 'schedule';    
	protected $fillable = [
		'title',
		'category',
		'event_date',
		'start_time',  
		'end_time'
	];
}
