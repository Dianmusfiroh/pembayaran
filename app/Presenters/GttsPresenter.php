<?php

namespace App\Presenters;

use App\Transformers\GttsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class GttsPresenter.
 *
 * @package namespace App\Presenters;
 */
class GttsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new GttsTransformer();
    }
}
