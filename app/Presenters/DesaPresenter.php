<?php

namespace App\Presenters;

use App\Transformers\DesaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class DesaPresenter.
 *
 * @package namespace App\Presenters;
 */
class DesaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new DesaTransformer();
    }
}
