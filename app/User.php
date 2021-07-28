<?php

namespace App;

use App\Entities\Address;
use App\Entities\CandidateProfile;
use App\Entities\Certification;
use App\Entities\Education;
use App\Entities\Formation;
use App\Entities\Institute;
use App\Entities\Role;

use App\Traits\Uuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable,Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id','institute_id','avatar','status'
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

    public $incrementing = false;
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
  public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function certification()
    {
        return $this->hasOne(Certification::class);
    }

    public function education()
    {
        return $this->hasOne(Education::class);
    }

    public function candidateProfile()
    {
        return $this->hasOne(CandidateProfile::class);
    }

    public function formation()
    {
        return $this->hasOne(Formation::class);
    }

}
