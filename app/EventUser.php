<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
    protected $table = 'event_users';

     protected $fillable = [
        'transaction_id','event_id','user_id','code','status_checkin',
    ];

    protected $hidden = [

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Events::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

}
