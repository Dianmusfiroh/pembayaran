<?php

namespace App\Presenters;

use App\Transformers\StudyProgramTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class StudyProgramPresenter.
 *
 * @package namespace App\Presenters;
 */
class StudyProgramPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new StudyProgramTransformer();
    }
}
