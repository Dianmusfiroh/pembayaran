<?php

namespace App\Entities;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Incentive.
 *
 * @package namespace App\Entities;
 */
class Incentive extends Model implements Transformable
{
    use TransformableTrait,Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_detail_id',
        'kinerja',
        'volume'
    ];
    public $incrementing = false;

}
