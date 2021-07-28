<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\DesaRepository;
use App\Entities\Desa;
use App\Validators\DesaValidator;

/**
 * Class DesaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class DesaRepositoryEloquent extends BaseRepository implements DesaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Desa::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
