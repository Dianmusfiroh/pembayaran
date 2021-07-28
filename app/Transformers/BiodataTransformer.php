<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Biodata;

/**
 * Class BiodataTransformer.
 *
 * @package namespace App\Transformers;
 */
class BiodataTransformer extends TransformerAbstract
{
    /**
     * Transform the Biodata entity.
     *
     * @param \App\Entities\Biodata $model
     *
     * @return array
     */
    public function transform(Biodata $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
