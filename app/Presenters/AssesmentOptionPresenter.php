<?php

namespace App\Presenters;

use App\Transformers\AssesmentOptionTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AssesmentOptionPresenter.
 *
 * @package namespace App\Presenters;
 */
class AssesmentOptionPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AssesmentOptionTransformer();
    }
}
