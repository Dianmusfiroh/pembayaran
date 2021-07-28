<?php

namespace App\Presenters;

use App\Transformers\VillagesTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class VillagesPresenter.
 *
 * @package namespace App\Presenters;
 */
class VillagesPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new VillagesTransformer();
    }
}
