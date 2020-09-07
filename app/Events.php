<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Events extends Model
{
    use SoftDeletes;
    protected $table = 'events';

    
    protected $fillable = [
        'user_id','category_id','name','price','description','date_time','location',
    ];

    protected $hidden = [

    ];
    

    protected $dates = [
        'date_time'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);

    }
}
