<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Department.
 *
 * @package namespace App\Entities;
 */
class Department extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $timestamps = false;
    protected $table = 'department';
    protected $fillable = [
        'name', 'study_program_id'
    ];

    public function studyProgram()
    {
        return $this->belongsTo(Department::class);
    }
    public function education()
    {
        return $this->hasMany(Education::class);
    }
}
