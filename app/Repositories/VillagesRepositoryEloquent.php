<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\VillagesRepository;
use App\Entities\Villages;
use App\Validators\VillagesValidator;

/**
 * Class VillagesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class VillagesRepositoryEloquent extends BaseRepository implements VillagesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Villages::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return VillagesValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
