<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CertificationRepository;
use App\Entities\Certification;
use App\Validators\CertificationValidator;

/**
 * Class CertificationRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CertificationRepositoryEloquent extends BaseRepository implements CertificationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Certification::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CertificationValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
