<?php

namespace App\Entities;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class InvoiceDetail.
 *
 * @package namespace App\Entities;
 */
class InvoiceDetail extends Model implements Transformable
{
    use TransformableTrait, Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id', 'gtt_id', 'jumlah_bayar'
    ];
    public $incrementing = false;

    public function gtt()
    {
        return $this->belongsTo(Gtt::class);
    }

    public function incentive()
    {
        return $this->hasMany(Incentive::class, 'invoice_detail_id', 'id');
    }
}
