<?php

namespace App\Presenters;

use App\Transformers\AssesmentFormTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AssesmentFormPresenter.
 *
 * @package namespace App\Presenters;
 */
class AssesmentFormPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AssesmentFormTransformer();
    }
}
