<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class AssesmentForm.
 *
 * @package namespace App\Entities;
 */
class AssesmentForm extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'position_category_id',
        'assessment_option_id',
        'formation_category_id'
    ];
    protected $table = 'assesment_form';
    public $timestamps = false;

    public function assessment_option()
    {
        return $this->belongsTo(AssesmentOption::class);
    }
    public function positionCategory()
    {
        return $this->belongsTo(PositionCategory::class);
    }

    public function formation_category()
    {
        return $this->belongsTo(FormationCategory::class);
    }

}
