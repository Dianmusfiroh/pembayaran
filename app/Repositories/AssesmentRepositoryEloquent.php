<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AssesmentRepository;
use App\Entities\Assesment;
use App\Validators\AssesmentValidator;

/**
 * Class AssesmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AssesmentRepositoryEloquent extends BaseRepository implements AssesmentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Assesment::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AssesmentValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
