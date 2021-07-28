<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\opsekolahRepository;
use App\Entities\Opsekolah;
use App\Validators\OpsekolahValidator;

/**
 * Class OpsekolahRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OpsekolahRepositoryEloquent extends BaseRepository implements OpsekolahRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Opsekolah::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return OpsekolahValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
