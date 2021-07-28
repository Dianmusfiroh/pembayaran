<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SkDetailRepository;
use App\Entities\SkDetail;
use App\Validators\SkDetailValidator;

/**
 * Class SkDetailRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SkDetailRepositoryEloquent extends BaseRepository implements SkDetailRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SkDetail::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SkDetailValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
