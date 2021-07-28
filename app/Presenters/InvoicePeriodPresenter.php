<?php

namespace App\Presenters;

use App\Transformers\InvoicePeriodTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class InvoicePeriodPresenter.
 *
 * @package namespace App\Presenters;
 */
class InvoicePeriodPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new InvoicePeriodTransformer();
    }
}
