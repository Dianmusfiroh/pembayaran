<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Education;

/**
 * Class EducationTransformer.
 *
 * @package namespace App\Transformers;
 */
class EducationTransformer extends TransformerAbstract
{
    /**
     * Transform the Education entity.
     *
     * @param \App\Entities\Education $model
     *
     * @return array
     */
    public function transform(Education $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
