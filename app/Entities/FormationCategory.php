<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class FormationCategory.
 *
 * @package namespace App\Entities;
 */
class FormationCategory extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'formation_category';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','slug'];

}
