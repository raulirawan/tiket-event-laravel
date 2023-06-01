<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = [
        'transaction_id','event_id','code_transaction','price','status'
    ];

    protected $hidden = [

    ];
    
    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
    
    public function event()
    {
        return $this->hasOne(Event::class);
    }
}
