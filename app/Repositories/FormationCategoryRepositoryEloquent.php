<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\FormationCategoryRepository;
use App\Entities\FormationCategory;
use App\Validators\FormationCategoryValidator;

/**
 * Class FormationCategoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class FormationCategoryRepositoryEloquent extends BaseRepository implements FormationCategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return FormationCategory::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return FormationCategoryValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
