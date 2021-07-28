<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Qualification.
 *
 * @package namespace App\Entities;
 */
class Qualification extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        'name',
        'incentive',
        'description'
    ];
    protected $table = 'qualification';

    public function education()
    {
        return $this->hasMany(Education::class);
    }


    public function gtt()
    {
        return $this->hasMany(Gtt::class);
    }

    public function formationNeeds()
    {
        return $this->hasMany(FormationNeeds::class);
    }
    public function candidate_profile()
    {
        return $this->belongsTo(CandidateProfile::class);
    }
}
