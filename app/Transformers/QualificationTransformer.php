<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Qualification;

/**
 * Class QualificationTransformer.
 *
 * @package namespace App\Transformers;
 */
class QualificationTransformer extends TransformerAbstract
{
    /**
     * Transform the Qualification entity.
     *
     * @param \App\Entities\Qualification $model
     *
     * @return array
     */
    public function transform(Qualification $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
