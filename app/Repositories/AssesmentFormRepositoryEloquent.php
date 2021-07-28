<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AssesmentFormRepository;
use App\Entities\AssesmentForm;
use App\Validators\AssesmentFormValidator;

/**
 * Class AssesmentFormRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AssesmentFormRepositoryEloquent extends BaseRepository implements AssesmentFormRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AssesmentForm::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AssesmentFormValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
