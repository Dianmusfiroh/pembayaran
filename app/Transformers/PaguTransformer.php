<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Pagu;

/**
 * Class PaguTransformer.
 *
 * @package namespace App\Transformers;
 */
class PaguTransformer extends TransformerAbstract
{
    /**
     * Transform the Pagu entity.
     *
     * @param \App\Entities\Pagu $model
     *
     * @return array
     */
    public function transform(Pagu $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
