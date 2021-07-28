<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\InvoicePeriodRepository;
use App\Entities\InvoicePeriod;
use App\Validators\InvoicePeriodValidator;

/**
 * Class InvoicePeriodRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class InvoicePeriodRepositoryEloquent extends BaseRepository implements InvoicePeriodRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return InvoicePeriod::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return InvoicePeriodValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
