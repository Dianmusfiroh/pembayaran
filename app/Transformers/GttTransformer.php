<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Gtt;

/**
 * Class GttTransformer.
 *
 * @package namespace App\Transformers;
 */
class GttTransformer extends TransformerAbstract
{
    /**
     * Transform the Gtt entity.
     *
     * @param \App\Entities\Gtt $model
     *
     * @return array
     */
    public function transform(Gtt $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
