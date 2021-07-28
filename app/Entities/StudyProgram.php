<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class StudyProgram.
 *
 * @package namespace App\Entities;
 */
class StudyProgram extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $table = 'study_program';
    protected $fillable = [
        'name', 'institution_id'
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function education()
    {
        return $this->hasMany(Education::class);
    }
}
