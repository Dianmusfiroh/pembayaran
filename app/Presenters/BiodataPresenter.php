<?php

namespace App\Presenters;

use App\Transformers\BiodataTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BiodataPresenter.
 *
 * @package namespace App\Presenters;
 */
class BiodataPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BiodataTransformer();
    }
}
