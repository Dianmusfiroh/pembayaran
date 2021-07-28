<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Opsekolah;

/**
 * Class OpsekolahTransformer.
 *
 * @package namespace App\Transformers;
 */
class OpsekolahTransformer extends TransformerAbstract
{
    /**
     * Transform the Opsekolah entity.
     *
     * @param \App\Entities\Opsekolah $model
     *
     * @return array
     */
    public function transform(Opsekolah $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
