<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CandidateProfileRepository;
use App\Entities\CandidateProfile;
use App\Validators\CandidateProfileValidator;

/**
 * Class CandidateProfileRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CandidateProfileRepositoryEloquent extends BaseRepository implements CandidateProfileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CandidateProfile::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CandidateProfileValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
