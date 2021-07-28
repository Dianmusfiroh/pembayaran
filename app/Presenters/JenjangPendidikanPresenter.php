<?php

namespace App\Presenters;

use App\Transformers\JenjangPendidikanTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class JenjangPendidikanPresenter.
 *
 * @package namespace App\Presenters;
 */
class JenjangPendidikanPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new JenjangPendidikanTransformer();
    }
}
