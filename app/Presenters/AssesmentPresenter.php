<?php

namespace App\Presenters;

use App\Transformers\AssesmentTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AssesmentPresenter.
 *
 * @package namespace App\Presenters;
 */
class AssesmentPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AssesmentTransformer();
    }
}
