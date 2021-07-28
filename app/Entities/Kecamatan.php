<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Kecamatan.
 *
 * @package namespace App\Entities;
 */
class Kecamatan extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = ['name', 'districts_id'];

    protected $table = 'sub_districts';

    public function districts()
    {
        return $this->belongsTo(Kabupaten::class);
    }
    public function institute()
    {
        return $this->hasMany(Institute::class);
    }

    public function villages()
    {
        return $this->hasMany(villages::class);
    }
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
