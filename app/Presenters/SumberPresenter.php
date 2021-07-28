<?php

namespace App\Presenters;

use App\Transformers\SumberTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SumberPresenter.
 *
 * @package namespace App\Presenters;
 */
class SumberPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SumberTransformer();
    }
}
