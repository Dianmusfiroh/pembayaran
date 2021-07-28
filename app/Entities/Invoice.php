<?php

namespace App\Entities;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Invoice.
 *
 * @package namespace App\Entities;
 */
class Invoice extends Model implements Transformable
{
    use TransformableTrait, Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no_spm',
        'no_sp2d',
        'date_sp2d',
        'invoice_date',
        'author_id',
        'status_id',
        'step'
    ];

    protected $table = 'invoice';
    public $timestamps = false;
    public $incrementing = false;
    public function invoicePeriod()
    {
        return $this->hasMany(InvoicePeriod::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function invoiceDetail()
    {
        return $this->hasMany(InvoiceDetail::class);
    }

}
