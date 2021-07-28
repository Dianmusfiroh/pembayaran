<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Kabupaten.
 *
 * @package namespace App\Entities;
 */
class  Kabupaten extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $timestamps = false;
    protected $fillable = ['name', 'province_id'];

    protected $table = 'districts';

    public function institute()
    {
        return $this->hasMany(Institute::class);
    }
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    public function sub_districts()
    {
        return $this->hasMany(Kecamatan::class);
    }
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
    public function gtt()
    {
        return $this->belongsTo(gtt::class);
    }
}
