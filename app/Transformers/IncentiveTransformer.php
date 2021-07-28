<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Incentive;

/**
 * Class IncentiveTransformer.
 *
 * @package namespace App\Transformers;
 */
class IncentiveTransformer extends TransformerAbstract
{
    /**
     * Transform the Incentive entity.
     *
     * @param \App\Entities\Incentive $model
     *
     * @return array
     */
    public function transform(Incentive $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
