<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\JenjangPendidikanRepository;
use App\Entities\JenjangPendidikan;
use App\Validators\JenjangPendidikanValidator;

/**
 * Class JenjangPendidikanRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class JenjangPendidikanRepositoryEloquent extends BaseRepository implements JenjangPendidikanRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return JenjangPendidikan::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return JenjangPendidikanValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
