<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\GttsRepository;
use App\Entities\Gtts;
use App\Validators\GttsValidator;

/**
 * Class GttsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class GttsRepositoryEloquent extends BaseRepository implements GttsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Gtts::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return GttsValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
