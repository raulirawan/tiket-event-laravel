<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','roles','address','province_id','regency_id','district_id',
        'village_id','zip_code','position','mobile_number',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // public function province()
    // {
    //     return $this->hasOne(Province::class,'id','province_id');
    // }

    
    public function province()
    {
        return $this->belongsTo(Province::class,'province_id','id');
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class,'regency_id','id');
    }

    public function district()
    {
        return $this->belongsTo(District::class,'district_id','id');
    }

    public function village()
    {
        return $this->belongsTo(Village::class,'village_id','id');
    }
}
