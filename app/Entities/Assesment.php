<?php

namespace App\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Assesment.
 *
 * @package namespace App\Entities;
 */
class Assesment extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'score',
    'formation_id',
    'assessment_date',
    'assessor_id',
    'nilai_test',
    'candidate_id'];
    protected $table = 'assesment';

    public $timestamps = false;

    public function candidate()
    {
        return $this->belongsTo(CandidateProfile::class,'candidate_id', 'id');
    }
    public function assessor()
    {
        return $this->belongsTo(User::class,'assessor_id','id');
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }


}
