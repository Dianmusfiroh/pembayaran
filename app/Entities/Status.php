<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Status.
 *
 * @package namespace App\Entities;
 */
class Status extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = ['name','description','status_for'];

    protected $table = 'status';
    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }

}
