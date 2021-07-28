<?php

namespace App\Presenters;

use App\Transformers\AssesmentScoreTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AssesmentScorePresenter.
 *
 * @package namespace App\Presenters;
 */
class AssesmentScorePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AssesmentScoreTransformer();
    }
}
