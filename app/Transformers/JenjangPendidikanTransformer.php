<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\JenjangPendidikan;

/**
 * Class JenjangPendidikanTransformer.
 *
 * @package namespace App\Transformers;
 */
class JenjangPendidikanTransformer extends TransformerAbstract
{
    /**
     * Transform the JenjangPendidikan entity.
     *
     * @param \App\Entities\JenjangPendidikan $model
     *
     * @return array
     */
    public function transform(JenjangPendidikan $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
