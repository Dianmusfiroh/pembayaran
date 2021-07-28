<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class PositionCategory.
 *
 * @package namespace App\Entities;
 */
class PositionCategory extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function position()
    {
        return $this->hasMany(Jabatan::class);
    }

    public function assesmentForm()
    {
        return $this->hasMany(AssesmentForm::class);
    }

}
