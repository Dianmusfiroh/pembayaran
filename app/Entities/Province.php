<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Province.
 *
 * @package namespace App\Entities;
 */
class Province extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $timestamps = false;
    protected $fillable = ['name'];

    protected $table = 'province';
    public function institute()
    {
        return $this->hasMany(Institute::class);
    }
    public function kabupatens()
    {
        return $this->hasMany(Kabupaten::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
