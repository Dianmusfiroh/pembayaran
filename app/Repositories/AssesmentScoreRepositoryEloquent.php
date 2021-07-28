<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AssesmentScoreRepository;
use App\Entities\AssesmentScore;
use App\Validators\AssesmentScoreValidator;

/**
 * Class AssesmentScoreRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AssesmentScoreRepositoryEloquent extends BaseRepository implements AssesmentScoreRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AssesmentScore::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AssesmentScoreValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
