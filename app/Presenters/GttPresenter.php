<?php

namespace App\Presenters;

use App\Transformers\GttTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class GttPresenter.
 *
 * @package namespace App\Presenters;
 */
class GttPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new GttTransformer();
    }
}
