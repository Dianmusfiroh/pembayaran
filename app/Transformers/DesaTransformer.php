<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Desa;

/**
 * Class DesaTransformer.
 *
 * @package namespace App\Transformers;
 */
class DesaTransformer extends TransformerAbstract
{
    /**
     * Transform the Desa entity.
     *
     * @param \App\Entities\Desa $model
     *
     * @return array
     */
    public function transform(Desa $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
