<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\SkDetail;

/**
 * Class SkDetailTransformer.
 *
 * @package namespace App\Transformers;
 */
class SkDetailTransformer extends TransformerAbstract
{
    /**
     * Transform the SkDetail entity.
     *
     * @param \App\Entities\SkDetail $model
     *
     * @return array
     */
    public function transform(SkDetail $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
