<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventGallery extends Model
{  
    protected $fillable = [
        'event_id','photos',
        ];


    protected $hidden = [
       
    ];

    public function event()
    {
        return $this->belongsTo(Events::class);
    }
}
