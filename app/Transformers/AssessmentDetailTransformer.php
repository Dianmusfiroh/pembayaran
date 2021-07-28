<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\AssessmentDetail;

/**
 * Class AssessmentDetailTransformer.
 *
 * @package namespace App\Transformers;
 */
class AssessmentDetailTransformer extends TransformerAbstract
{
    /**
     * Transform the AssessmentDetail entity.
     *
     * @param \App\Entities\AssessmentDetail $model
     *
     * @return array
     */
    public function transform(AssessmentDetail $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
