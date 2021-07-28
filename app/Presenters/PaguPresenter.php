<?php

namespace App\Presenters;

use App\Transformers\PaguTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PaguPresenter.
 *
 * @package namespace App\Presenters;
 */
class PaguPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PaguTransformer();
    }
}
