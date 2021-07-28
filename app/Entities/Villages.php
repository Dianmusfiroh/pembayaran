<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Villages.
 *
 * @package namespace App\Entities;
 */
class Villages extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $timestamps = false;
    protected $fillable = ['name', 'sub_districts_id'];

    protected $table = 'villages';

    public function sub_districts()
    {
       return $this->belongsTo(kecamatan::class);
    }
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

}
