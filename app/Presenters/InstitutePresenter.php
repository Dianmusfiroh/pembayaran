<?php

namespace App\Presenters;

use App\Transformers\InstituteTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class InstitutePresenter.
 *
 * @package namespace App\Presenters;
 */
class InstitutePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new InstituteTransformer();
    }
}
