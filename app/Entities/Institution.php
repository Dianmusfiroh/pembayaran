<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Ramsey\Uuid\Codec\TimestampLastCombCodec;

/**
 * Class Institution.
 *
 * @package namespace App\Entities;
 */
class Institution extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $timestamps = false;
    protected $fillable = ['name'];
    protected $table = 'institution';

    public function studyPrograms()
    {
        return $this->hasMany(StudyProgram::class);
    }
    public function education()
    {
        return $this->hasMany(Education::class);
    }
}
