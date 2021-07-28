<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\EducationalStage;

/**
 * Class EducationalStageTransformer.
 *
 * @package namespace App\Transformers;
 */
class EducationalStageTransformer extends TransformerAbstract
{
    /**
     * Transform the EducationalStage entity.
     *
     * @param \App\Entities\EducationalStage $model
     *
     * @return array
     */
    public function transform(EducationalStage $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
