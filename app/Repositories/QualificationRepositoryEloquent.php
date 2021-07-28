<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\QualificationRepository;
use App\Entities\Qualification;
use App\Validators\QualificationValidator;

/**
 * Class QualificationRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class QualificationRepositoryEloquent extends BaseRepository implements QualificationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Qualification::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return QualificationValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
