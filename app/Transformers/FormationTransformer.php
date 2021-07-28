<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Formation;

/**
 * Class FormationTransformer.
 *
 * @package namespace App\Transformers;
 */
class FormationTransformer extends TransformerAbstract
{
    /**
     * Transform the Formation entity.
     *
     * @param \App\Entities\Formation $model
     *
     * @return array
     */
    public function transform(Formation $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
