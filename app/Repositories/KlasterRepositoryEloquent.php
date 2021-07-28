<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\KlasterRepository;
use App\Entities\Klaster;
use App\Validators\KlasterValidator;

/**
 * Class KlasterRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class KlasterRepositoryEloquent extends BaseRepository implements KlasterRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Klaster::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return KlasterValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
