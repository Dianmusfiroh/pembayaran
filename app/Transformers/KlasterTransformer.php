<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Klaster;

/**
 * Class KlasterTransformer.
 *
 * @package namespace App\Transformers;
 */
class KlasterTransformer extends TransformerAbstract
{
    /**
     * Transform the Klaster entity.
     *
     * @param \App\Entities\Klaster $model
     *
     * @return array
     */
    public function transform(Klaster $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
