<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Sumber.
 *
 * @package namespace App\Entities;
 */
class Sumber extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama'];
    protected $table = 'sumber';
    public $timestamps = false;

    public function pagu()
    {
        return $this->hasMany(Pagu::class);
    }
}
