<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\StudyProgramRepository;
use App\Entities\StudyProgram;
use App\Validators\StudyProgramValidator;

/**
 * Class StudyProgramRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class StudyProgramRepositoryEloquent extends BaseRepository implements StudyProgramRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return StudyProgram::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return StudyProgramValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
