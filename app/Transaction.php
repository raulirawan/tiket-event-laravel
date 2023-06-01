<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'event_id','user_id','total_price','code_transaction','status','payment_url'
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

    public function event_user()
    {
        return $this->hasMany(EventUser::class,'transaction_id','id');
    }


}
