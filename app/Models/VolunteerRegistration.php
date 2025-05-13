<?php


namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VolunteerRegistration extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'volunteer_registrations';
    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'profession',
        'caravan_type',
        'join_from',
        'visited_before',
        'additional_comments'
    ];
}
