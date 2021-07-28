<?php

namespace App\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Address.
 *
 * @package namespace App\Entities;
 */
class Address extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'province_id', 'districts_id', 'sub_districts_id', 'village_id', 'user_id'];

    protected $table = 'addresses';

    public $timestamps = false;

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    public function districts()
    {
        return $this->belongsTo(Kabupaten::class);
    }
    public function sub_districts()
    {
        return $this->belongsTo(Kecamatan::class);
    }
    public function villages()
    {
        return $this->belongsTo(Villages::class, 'village_id','id');
    }

    public function candidateProfile()
    {
        return $this->belongsToMany(CandidateProfile::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
