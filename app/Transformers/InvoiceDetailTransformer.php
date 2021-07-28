<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\InvoiceDetail;

/**
 * Class InvoiceDetailTransformer.
 *
 * @package namespace App\Transformers;
 */
class InvoiceDetailTransformer extends TransformerAbstract
{
    /**
     * Transform the InvoiceDetail entity.
     *
     * @param \App\Entities\InvoiceDetail $model
     *
     * @return array
     */
    public function transform(InvoiceDetail $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
