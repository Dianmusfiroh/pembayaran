<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AssessmentDetailRepository;
use App\Entities\AssessmentDetail;
use App\Validators\AssessmentDetailValidator;

/**
 * Class AssessmentDetailRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AssessmentDetailRepositoryEloquent extends BaseRepository implements AssessmentDetailRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AssessmentDetail::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AssessmentDetailValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
