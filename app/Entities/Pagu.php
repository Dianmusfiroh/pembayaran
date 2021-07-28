<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Pagu.
 *
 * @package namespace App\Entities;
 */
class Pagu extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'year',
        'jumlah',
        'sumber_id'
    ];
    protected $table = 'pagu';
    public $timestamps = false;


    public function sumber()
    {
        return $this->belongsTo(Sumber::class);
    }
}
