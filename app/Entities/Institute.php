<?php

namespace App\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Institute.
 *
 * @package namespace App\Entities;
 */
class Institute extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        'npsn',
        'name',
        'address',
        'educational_stage_id',
        'province_id',
        'districts_id',
        'sub_districts_id',
        'cluster_id',
        'author_id'
    ];

    protected $table = 'institute';

    public function formation_needs()
    {
        return $this->hasMany(FormationNeeds::class);
    }
    public function user()
    {
        return $this->hasMany(User::class);
    }
    public function gtt()
    {
        return $this->hasMany(Gtt::class);
    }
    public function educational_stage()
    {
        return $this->belongsTo(JenjangPendidikan::class);
    }
    public function cluster()
    {
        return $this->belongsTo(Klaster::class);
    }
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    public function districts()
    {
        return $this->belongsTo(Kabupaten::class);
    }
    public function sub_districts()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function candidate_profile()
    {
        return $this->belongsTo(CandidateProfile::class);
    }
}
