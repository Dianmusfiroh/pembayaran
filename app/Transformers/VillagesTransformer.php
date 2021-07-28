<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Villages;

/**
 * Class VillagesTransformer.
 *
 * @package namespace App\Transformers;
 */
class VillagesTransformer extends TransformerAbstract
{
    /**
     * Transform the Villages entity.
     *
     * @param \App\Entities\Villages $model
     *
     * @return array
     */
    public function transform(Villages $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
