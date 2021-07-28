<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Institute;

/**
 * Class InstituteTransformer.
 *
 * @package namespace App\Transformers;
 */
class InstituteTransformer extends TransformerAbstract
{
    /**
     * Transform the Institute entity.
     *
     * @param \App\Entities\Institute $model
     *
     * @return array
     */
    public function transform(Institute $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
