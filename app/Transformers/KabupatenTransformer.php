<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Kabupaten;

/**
 * Class KabupatenTransformer.
 *
 * @package namespace App\Transformers;
 */
class KabupatenTransformer extends TransformerAbstract
{
    /**
     * Transform the Kabupaten entity.
     *
     * @param \App\Entities\Kabupaten $model
     *
     * @return array
     */
    public function transform(Kabupaten $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
