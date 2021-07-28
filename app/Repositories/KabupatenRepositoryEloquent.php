<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\KabupatenRepository;
use App\Entities\Kabupaten;
use App\Validators\KabupatenValidator;

/**
 * Class KabupatenRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class KabupatenRepositoryEloquent extends BaseRepository implements KabupatenRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Kabupaten::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return KabupatenValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
