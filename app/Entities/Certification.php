<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Certification.
 *
 * @package namespace App\Entities;
 */
class Certification extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'certification';
    protected $fillable = ['no_cert',
    'no_part',
    'nrg',
    'year_cert',
    'user_id'

    ];

    public $timestamps = false;

}
