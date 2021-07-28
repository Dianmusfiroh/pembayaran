<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Sk.
 *
 * @package namespace App\Entities;
 */
class Sk extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = true;
    protected $fillable = [
        'no_sk',
        'start_date',
        'end_date',
        'author_id'
    ];

    protected $table = 'sk';

    public function sk_detail()
    {
        return $this->hasMany(SkDetail::class);
    }
    public function invoice_period()
    {
        return $this->hasMany(InvoicePeriod::class);
    }

}
