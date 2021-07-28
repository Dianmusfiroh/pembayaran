<?php

namespace App\Presenters;

use App\Transformers\KabupatenTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class KabupatenPresenter.
 *
 * @package namespace App\Presenters;
 */
class KabupatenPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new KabupatenTransformer();
    }
}
