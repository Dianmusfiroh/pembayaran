<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Jabatan.
 *
 * @package namespace App\Entities;
 */
class Jabatan extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'position_category_id',
        'author_id'
    ];
    public $timestamps = false;
    protected $table = 'position';

    public function formation_needs()
    {
        return $this->hasMany(FormationNeeds::class);
    }
    public function assesment_form()
    {
        return $this->hasMany(AssesmentForm::class,'position_id','id');
    }
    public function gtt()
    {
        return $this->hasMany(Gtt::class);
    }
    public function positionCategory()
    {
        return $this->belongsTo(PositionCategory::class);
    }
}
