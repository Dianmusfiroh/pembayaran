<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PositionCategoryRepository;
use App\Entities\PositionCategory;
use App\Validators\PositionCategoryValidator;

/**
 * Class PositionCategoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PositionCategoryRepositoryEloquent extends BaseRepository implements PositionCategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PositionCategory::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PositionCategoryValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
