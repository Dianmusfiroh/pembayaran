<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SettingsRepository;
use App\Entities\Settings;
use App\Validators\SettingsValidator;

/**
 * Class SettingsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SettingsRepositoryEloquent extends BaseRepository implements SettingsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Settings::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SettingsValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
