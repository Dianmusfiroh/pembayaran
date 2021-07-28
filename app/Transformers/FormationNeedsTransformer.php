<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\FormationNeeds;

/**
 * Class FormationNeedsTransformer.
 *
 * @package namespace App\Transformers;
 */
class FormationNeedsTransformer extends TransformerAbstract
{
    /**
     * Transform the FormationNeeds entity.
     *
     * @param \App\Entities\FormationNeeds $model
     *
     * @return array
     */
    public function transform(FormationNeeds $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
