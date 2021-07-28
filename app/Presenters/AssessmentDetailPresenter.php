<?php

namespace App\Presenters;

use App\Transformers\AssessmentDetailTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AssessmentDetailPresenter.
 *
 * @package namespace App\Presenters;
 */
class AssessmentDetailPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AssessmentDetailTransformer();
    }
}
