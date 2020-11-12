<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Transaction extends Model
{
    // use SoftDeletes;

    protected $fillable = [
        'user_id','total_price','code_transaction','status'
    ];

    protected $hidden = [

    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
