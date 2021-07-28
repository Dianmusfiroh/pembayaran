<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\FormationRepository;
use App\Entities\Formation;
use App\Validators\FormationValidator;

/**
 * Class FormationRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class FormationRepositoryEloquent extends BaseRepository implements FormationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Formation::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return FormationValidator::class;
    }

    protected $fieldSearchable = [
        'candidate.name',
        'candidate.candidateProfile.nik',
        'id'
    ];


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
