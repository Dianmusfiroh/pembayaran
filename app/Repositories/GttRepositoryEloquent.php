<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\GttRepository;
use App\Entities\Gtt;
use App\Validators\GttValidator;

/**
 * Class GttRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class GttRepositoryEloquent extends BaseRepository implements GttRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Gtt::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return GttValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    protected $fieldSearchable = [
        'nik' => 'like',
        'full_name'=>'like',
        'id'
    ];
    
}
