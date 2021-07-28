<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Cluster.
 *
 * @package namespace App\Entities;
 */
class Cluster extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];
    protected $table = 'cluster';
    public $timestamps = false;
    public function institute()
    {
        return $this->hasMany(Institute::class);
    }

}
