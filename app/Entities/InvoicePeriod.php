<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class InvoicePeriod.
 *
 * @package namespace App\Entities;
 */
class InvoicePeriod extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */

     protected $fillable = [
         'period','invoice_id'
     ];
     protected $table = 'invoice_period';
     public $timestamps = false;

     public function sk()
     {
        return $this->belongsTo(Sk::class);
     }
     public function invoice()
     {
        return $this->belongsTo(Invoice::class);
     }

}
