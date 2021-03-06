<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ClusterRepository;
use App\Entities\Cluster;
use App\Validators\ClusterValidator;

/**
 * Class ClusterRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ClusterRepositoryEloquent extends BaseRepository implements ClusterRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Cluster::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ClusterValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
