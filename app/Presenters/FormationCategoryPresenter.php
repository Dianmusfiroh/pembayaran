<?php

namespace App\Presenters;

use App\Transformers\FormationCategoryTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class FormationCategoryPresenter.
 *
 * @package namespace App\Presenters;
 */
class FormationCategoryPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new FormationCategoryTransformer();
    }
}
