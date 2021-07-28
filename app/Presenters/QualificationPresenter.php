<?php

namespace App\Presenters;

use App\Transformers\QualificationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class QualificationPresenter.
 *
 * @package namespace App\Presenters;
 */
class QualificationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new QualificationTransformer();
    }
}
