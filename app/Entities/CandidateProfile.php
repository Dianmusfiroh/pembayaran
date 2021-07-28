<?php

namespace App\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class CandidateProfile.
 *
 * @package namespace App\Entities;
 */
class CandidateProfile extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $timestamps = false;
    protected $fillable = [
        'nik',
        'nuptk',
        'full_name',
        'title_ahead',
        'back_title',
        'date_of_birth',
        'place_of_birth',
        'tmt_start',
        'tmt_end',
        'user_id',
        'jenis_kelamin'
    ];

    protected $table = 'candidate_profile';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }
    public function assesment()
    {
        return $this->hasMany(Assesment::class);
    }

    public function rekening()
    {
        return $this->belongsTo(BankAccount::class,'user_id','user_id');
    }
}
