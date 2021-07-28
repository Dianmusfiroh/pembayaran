<?php

namespace App\Presenters;

use App\Transformers\OpsekolahTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class OpsekolahPresenter.
 *
 * @package namespace App\Presenters;
 */
class OpsekolahPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new OpsekolahTransformer();
    }
}
