<?php

namespace App\Presenters;

use App\Transformers\KlasterTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class KlasterPresenter.
 *
 * @package namespace App\Presenters;
 */
class KlasterPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new KlasterTransformer();
    }
}
