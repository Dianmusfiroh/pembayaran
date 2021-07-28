<?php

namespace App\Presenters;

use App\Transformers\IncentiveTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class IncentivePresenter.
 *
 * @package namespace App\Presenters;
 */
class IncentivePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new IncentiveTransformer();
    }
}
