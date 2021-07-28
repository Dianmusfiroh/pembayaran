<?php

namespace App\Presenters;

use App\Transformers\EducationalStageTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class EducationalStagePresenter.
 *
 * @package namespace App\Presenters;
 */
class EducationalStagePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new EducationalStageTransformer();
    }
}
