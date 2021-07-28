<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Education.
 *
 * @package namespace App\Entities;
 */
class Education extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        'year_edu',
        'institution_id',
        'study_program_id',
        'department_id',
        'qualification_id',
        'user_id'
    ];
    protected $table = 'education';

    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
    public function study_program()
    {
        return $this->belongsTo(StudyProgram::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
