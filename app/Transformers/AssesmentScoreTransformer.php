<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\AssesmentScore;

/**
 * Class AssesmentScoreTransformer.
 *
 * @package namespace App\Transformers;
 */
class AssesmentScoreTransformer extends TransformerAbstract
{
    /**
     * Transform the AssesmentScore entity.
     *
     * @param \App\Entities\AssesmentScore $model
     *
     * @return array
     */
    public function transform(AssesmentScore $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
