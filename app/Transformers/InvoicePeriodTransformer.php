<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\InvoicePeriod;

/**
 * Class InvoicePeriodTransformer.
 *
 * @package namespace App\Transformers;
 */
class InvoicePeriodTransformer extends TransformerAbstract
{
    /**
     * Transform the InvoicePeriod entity.
     *
     * @param \App\Entities\InvoicePeriod $model
     *
     * @return array
     */
    public function transform(InvoicePeriod $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
