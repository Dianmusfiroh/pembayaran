<?php

namespace App\Presenters;

use App\Transformers\SkTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SkPresenter.
 *
 * @package namespace App\Presenters;
 */
class SkPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SkTransformer();
    }
}
