<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Sumber;

/**
 * Class SumberTransformer.
 *
 * @package namespace App\Transformers;
 */
class SumberTransformer extends TransformerAbstract
{
    /**
     * Transform the Sumber entity.
     *
     * @param \App\Entities\Sumber $model
     *
     * @return array
     */
    public function transform(Sumber $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
