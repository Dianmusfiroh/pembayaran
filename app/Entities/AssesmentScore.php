<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class AssesmentScore.
 *
 * @package namespace App\Entities;
 */
class AssesmentScore extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'score',
        'description',
        'assessment_option_id',
        'author_id'
    ];
    protected $table = 'assessment_score';
    public $timestamps = false;

    public function assessment_option()
    {
        return $this->belongsTo(AssesmentOption::class);
    }

}
