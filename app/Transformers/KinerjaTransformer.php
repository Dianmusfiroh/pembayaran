<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Kinerja;

/**
 * Class KinerjaTransformer.
 *
 * @package namespace App\Transformers;
 */
class KinerjaTransformer extends TransformerAbstract
{
    /**
     * Transform the Kinerja entity.
     *
     * @param \App\Entities\Kinerja $model
     *
     * @return array
     */
    public function transform(Kinerja $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
