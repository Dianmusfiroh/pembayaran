<?php

namespace App\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Formation.
 *
 * @package namespace App\Entities;
 */
class Formation extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $table = 'formation';
    protected $fillable = [
        'id',
        'candidate_id',
        'status_id',
        'formation_needs_id',
        'formation_year'
    ];

    public function formation_needs()
    {
        return $this->belongsTo(FormationNeeds::class);
    }
    public function candidate()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function assesment()
    {
        return $this->hasOne(Assesment::class,'formation_id');
    }
}
