<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\kinerjaRepository;
use App\Entities\Kinerja;
use App\Validators\KinerjaValidator;

/**
 * Class KinerjaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class KinerjaRepositoryEloquent extends BaseRepository implements KinerjaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Kinerja::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return KinerjaValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    // protected $fieldSearchable = [
    //     'nik' => 'like',
    //     'full_name'=>'like',
    //     'id'
    // ];

}
