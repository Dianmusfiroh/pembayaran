<?php

namespace App\Presenters;

use App\Transformers\FormationNeedsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class FormationNeedsPresenter.
 *
 * @package namespace App\Presenters;
 */
class FormationNeedsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new FormationNeedsTransformer();
    }
}
