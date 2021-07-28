<?php

namespace App\Presenters;

use App\Transformers\SkDetailTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SkDetailPresenter.
 *
 * @package namespace App\Presenters;
 */
class SkDetailPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SkDetailTransformer();
    }
}
