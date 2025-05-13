<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LiveProgram extends Model
{

	use HasFactory, SoftDeletes;
	protected $table = 'live_program';
	protected $fillable = [
		'title',
		'event_date',
		'start_time',
		'duration',
		'video_url'
	];
}
