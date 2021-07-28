<?php

namespace App\Presenters;

use App\Transformers\FormationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class FormationPresenter.
 *
 * @package namespace App\Presenters;
 */
class FormationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new FormationTransformer();
    }
}
