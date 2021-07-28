<?php

namespace App\Entities;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Gtt.
 *
 * @package namespace App\Entities;
 */
class Gtt extends Model implements Transformable
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
        'bank_name',
        'account_name',
        'account_number',
        'bank_account_id',
        'institute_id',
        'qualification_id',
        'position_id',
        'jenis_kelamin'
    ];

    public $incrementing = false;

    protected $table = 'gtt';

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }
    public function position()
    {
        return $this->belongsTo(Jabatan::class);
    }
    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }
    public function sk_detail()
    {
        return $this->belongsTo(SkDetail::class);
    }
    public function sk()
    {
        return $this->belongsTo(Sk::class);
    }

    public function education()
    {
        return $this->belongsTo(Education::class, 'user_id', 'user_id');
    }

    public function rekening()
    {
        return $this->belongsTo(BankAccount::class, 'user_id', 'user_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'user_id', 'user_id');
    }
    public function bankAccount()
    {
        return $this->hasOne(BankAccount::class);
    }
    public function kinerja()
    {
        return $this->hasMany(kinerja::class);
    }
    public function kabupatens()
    {
        return $this->hasMany(Kabupaten::class);
    }

}
