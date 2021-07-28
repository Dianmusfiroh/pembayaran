<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\AssesmentOption;

/**
 * Class AssesmentOptionTransformer.
 *
 * @package namespace App\Transformers;
 */
class AssesmentOptionTransformer extends TransformerAbstract
{
    /**
     * Transform the AssesmentOption entity.
     *
     * @param \App\Entities\AssesmentOption $model
     *
     * @return array
     */
    public function transform(AssesmentOption $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
