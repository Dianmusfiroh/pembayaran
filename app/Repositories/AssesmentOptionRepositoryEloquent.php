<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AssesmentOptionRepository;
use App\Entities\AssesmentOption;
use App\Validators\AssesmentOptionValidator;

/**
 * Class AssesmentOptionRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AssesmentOptionRepositoryEloquent extends BaseRepository implements AssesmentOptionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AssesmentOption::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AssesmentOptionValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
