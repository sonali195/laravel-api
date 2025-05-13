<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'slug'];

    protected $dates = ['deleted_at'];

    // public function subCategory() {
    //     return $this->hasMany('App\Models\SubCategory', 'category_id', 'id');
    // }

    // This is a recommended way to declare event handlers
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            // if(isset($model->subCategory) && !empty($model->subCategory)){
            //     foreach($model->subCategory as $subCategory){
            //         $subCategory->delete();
            //     }
            // }
        });
    }
}
