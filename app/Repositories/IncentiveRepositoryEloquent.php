<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\IncentiveRepository;
use App\Entities\Incentive;
use App\Validators\IncentiveValidator;

/**
 * Class IncentiveRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class IncentiveRepositoryEloquent extends BaseRepository implements IncentiveRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Incentive::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return IncentiveValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
