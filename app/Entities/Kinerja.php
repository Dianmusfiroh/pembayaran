<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Kinerja.
 *
 * @package namespace App\Entities;
 */
class Kinerja extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'presentase',
        'month',
        'year',
        'gtt_id'
    ];
    protected $table ='kinerja';
    public $timestamps = false;

    public function gtt()
    {
        return $this->belongsTo(gtt::class);
    }
}
