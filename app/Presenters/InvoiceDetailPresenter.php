<?php

namespace App\Presenters;

use App\Transformers\InvoiceDetailTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class InvoiceDetailPresenter.
 *
 * @package namespace App\Presenters;
 */
class InvoiceDetailPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new InvoiceDetailTransformer();
    }
}
