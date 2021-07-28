<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\InvoiceDetailRepository;
use App\Entities\InvoiceDetail;
use App\Validators\InvoiceDetailValidator;

/**
 * Class InvoiceDetailRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class InvoiceDetailRepositoryEloquent extends BaseRepository implements InvoiceDetailRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return InvoiceDetail::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return InvoiceDetailValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
