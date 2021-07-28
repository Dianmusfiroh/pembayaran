<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\FormationNeedsRepository;
use App\Entities\FormationNeeds;
use App\Validators\FormationNeedsValidator;

/**
 * Class FormationNeedsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class FormationNeedsRepositoryEloquent extends BaseRepository implements FormationNeedsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return FormationNeeds::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return FormationNeedsValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
