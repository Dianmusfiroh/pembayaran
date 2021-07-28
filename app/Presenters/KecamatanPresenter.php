<?php

namespace App\Presenters;

use App\Transformers\KecamatanTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class KecamatanPresenter.
 *
 * @package namespace App\Presenters;
 */
class KecamatanPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new KecamatanTransformer();
    }
}
