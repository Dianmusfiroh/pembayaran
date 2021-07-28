<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BiodataRepository;
use App\Entities\Biodata;
use App\Validators\BiodataValidator;

/**
 * Class BiodataRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BiodataRepositoryEloquent extends BaseRepository implements BiodataRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Biodata::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return BiodataValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
