<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class BankAccount.
 *
 * @package namespace App\Entities;
 */
class BankAccount extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'bank_account';
    protected $fillable = [
        'bank_name',
        'account_name',
        'account_number',
        'gtt_id'

    ];

    public $timestamps = false;

    public function gtt()
    {
        return $this->belongsTo(gtt::class);
    }

}
