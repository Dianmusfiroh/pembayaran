<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Certification;

/**
 * Class CertificationTransformer.
 *
 * @package namespace App\Transformers;
 */
class CertificationTransformer extends TransformerAbstract
{
    /**
     * Transform the Certification entity.
     *
     * @param \App\Entities\Certification $model
     *
     * @return array
     */
    public function transform(Certification $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
