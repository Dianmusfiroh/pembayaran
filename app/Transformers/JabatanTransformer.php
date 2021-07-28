<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Jabatan;

/**
 * Class JabatanTransformer.
 *
 * @package namespace App\Transformers;
 */
class JabatanTransformer extends TransformerAbstract
{
    /**
     * Transform the Jabatan entity.
     *
     * @param \App\Entities\Jabatan $model
     *
     * @return array
     */
    public function transform(Jabatan $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
