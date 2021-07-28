<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Kecamatan;

/**
 * Class KecamatanTransformer.
 *
 * @package namespace App\Transformers;
 */
class KecamatanTransformer extends TransformerAbstract
{
    /**
     * Transform the Kecamatan entity.
     *
     * @param \App\Entities\Kecamatan $model
     *
     * @return array
     */
    public function transform(Kecamatan $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
