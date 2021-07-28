<?php

namespace App\Presenters;

use App\Transformers\CertificationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CertificationPresenter.
 *
 * @package namespace App\Presenters;
 */
class CertificationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CertificationTransformer();
    }
}
