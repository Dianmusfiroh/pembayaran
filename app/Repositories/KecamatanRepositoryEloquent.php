<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\KecamatanRepository;
use App\Entities\Kecamatan;
use App\Validators\KecamatanValidator;

/**
 * Class KecamatanRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class KecamatanRepositoryEloquent extends BaseRepository implements KecamatanRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Kecamatan::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return KecamatanValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
