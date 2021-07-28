<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class SkDetail.
 *
 * @package namespace App\Entities;
 */
class SkDetail extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        'gtt_id',
        'sk_id'
    ];
    protected $table = 'sk_detail';

    public function sk()
    {
        return $this->belongsTo(Sk::class);
    }

    public function gtt()
    {
        return $this->belongsTo(Gtt::class);
    }

}
