<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{   
    use SoftDeletes;
    protected $fillable = [
        'name','slug','photos'
    ];


    protected $hidden = [
       
    ];


    public function event()
    {
        return $this->hasMany(Events::class);
    }
}
