<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Educational_stageRepository;
use App\Entities\EducationalStage;
use App\Validators\EducationalStageValidator;

/**
 * Class EducationalStageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EducationalStageRepositoryEloquent extends BaseRepository implements EducationalStageRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EducationalStage::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return EducationalStageValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
