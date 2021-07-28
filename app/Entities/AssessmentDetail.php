<?php

namespace App\Entities;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class AssessmentDetail.
 *
 * @package namespace App\Entities;
 */
class AssessmentDetail extends Model implements Transformable
{
    use TransformableTrait,Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'assesment_id',
        'assessment_option_id',
        'assessment_score_id',
        'score',
        'description'
    ];

    public $incrementing = false;

    public function assesment()
    {
        return $this->belongsTo(Assesment::class);
    }

    public function assessmentOption()
    {
        return $this->belongsTo(AssesmentOption::class);
    }

    public function assessmentScore()
    {
        return $this->belongsTo(AssesmentScore::class);
    }

}
