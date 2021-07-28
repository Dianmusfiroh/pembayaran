<?php

namespace App\Entities;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class FormationNeeds.
 *
 * @package namespace App\Entities;
 */
class FormationNeeds extends Model implements Transformable
{
    use TransformableTrait, Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'quantity', 'formation_year', 'institute_id', 'qualification_id', 'position_id', 'author_id', 'start_date', 'end_date','formation_category_id'
    ];
    public $incrementing = false;

    protected $table = 'formation_needs';

    public function position()
    {
        return $this->belongsTo(Jabatan::class);
    }
    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }
    public function formation()
    {
        return $this->hasMany(Formation::class);
    }

    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }

    public function countPendaftar()
    {
        return Formation::whereFormationNeedsId($this->attributes['id'])->count('id');
    }

    public function countDinilai()
    {
        return Formation::join('assesment','formation.id','=','assesment.formation_id')
                    ->whereFormationNeedsId($this->attributes['id'])
                    ->count('assesment.id');
    }

    public function formation_category()
    {
        return $this->belongsTo(FormationCategory::class);
    }
}
