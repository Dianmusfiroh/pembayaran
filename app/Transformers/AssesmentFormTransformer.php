<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\AssesmentForm;

/**
 * Class AssesmentFormTransformer.
 *
 * @package namespace App\Transformers;
 */
class AssesmentFormTransformer extends TransformerAbstract
{
    /**
     * Transform the AssesmentForm entity.
     *
     * @param \App\Entities\AssesmentForm $model
     *
     * @return array
     */
    public function transform(AssesmentForm $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
