<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\PositionCategory;

/**
 * Class PositionCategoryTransformer.
 *
 * @package namespace App\Transformers;
 */
class PositionCategoryTransformer extends TransformerAbstract
{
    /**
     * Transform the PositionCategory entity.
     *
     * @param \App\Entities\PositionCategory $model
     *
     * @return array
     */
    public function transform(PositionCategory $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
