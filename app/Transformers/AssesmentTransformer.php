<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Assesment;

/**
 * Class AssesmentTransformer.
 *
 * @package namespace App\Transformers;
 */
class AssesmentTransformer extends TransformerAbstract
{
    /**
     * Transform the Assesment entity.
     *
     * @param \App\Entities\Assesment $model
     *
     * @return array
     */
    public function transform(Assesment $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
