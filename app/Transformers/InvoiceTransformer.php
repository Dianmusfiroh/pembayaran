<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Invoice;

/**
 * Class InvoiceTransformer.
 *
 * @package namespace App\Transformers;
 */
class InvoiceTransformer extends TransformerAbstract
{
    /**
     * Transform the Invoice entity.
     *
     * @param \App\Entities\Invoice $model
     *
     * @return array
     */
    public function transform(Invoice $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
