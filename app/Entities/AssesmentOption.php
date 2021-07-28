<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class AssesmentOption.
 *
 * @package namespace App\Entities;
 */
class AssesmentOption extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','author_id'];
    protected $table = 'assessment_option';
    public $timestamps = false;

    // public function assesment()
    // {
    //     return $this->hasMany(Assesment::class);
    // }
    public function assesment_score()
    {
        return $this->hasMany(AssesmentScore::class,'assessment_option_id','id');
    }
    public function assesment_form()
    {
        return $this->hasMany(AssesmentForm::class);
    }

}
