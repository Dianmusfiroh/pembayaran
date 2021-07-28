<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class EducationalStage.
 *
 * @package namespace App\Entities;
 */
class EducationalStage extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'author_id'
    ];

    public $timestamps = false;

    public function institute()
    {
        return $this->hasMany(Institute::class);
    }
    protected $table = 'educational_stage';
}
