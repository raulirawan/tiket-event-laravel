<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Events extends Model
{
    use SoftDeletes;
    protected $table = 'events';

    
    protected $fillable = [
        'user_id','category_id','name','slug','price',
        'description','date_time','event_type','location','location_details','event_stock',
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

    public function galleries()
    {
        return $this->hasMany(EventGallery::class, 'event_id', 'id');
    }

    public function event_user()
    {
        return $this->hasMany(EventUser::class,'event_id','id');
    }


}
