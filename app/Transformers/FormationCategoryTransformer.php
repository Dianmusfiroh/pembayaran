<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\FormationCategory;

/**
 * Class FormationCategoryTransformer.
 *
 * @package namespace App\Transformers;
 */
class FormationCategoryTransformer extends TransformerAbstract
{
    /**
     * Transform the FormationCategory entity.
     *
     * @param \App\Entities\FormationCategory $model
     *
     * @return array
     */
    public function transform(FormationCategory $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
