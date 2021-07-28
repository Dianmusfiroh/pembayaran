<?php

namespace App\Presenters;

use App\Transformers\PositionCategoryTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PositionCategoryPresenter.
 *
 * @package namespace App\Presenters;
 */
class PositionCategoryPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PositionCategoryTransformer();
    }
}
