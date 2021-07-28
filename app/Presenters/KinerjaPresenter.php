<?php

namespace App\Presenters;

use App\Transformers\KinerjaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class KinerjaPresenter.
 *
 * @package namespace App\Presenters;
 */
class KinerjaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new KinerjaTransformer();
    }
}
