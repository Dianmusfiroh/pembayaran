<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Cluster;

/**
 * Class ClusterTransformer.
 *
 * @package namespace App\Transformers;
 */
class ClusterTransformer extends TransformerAbstract
{
    /**
     * Transform the Cluster entity.
     *
     * @param \App\Entities\Cluster $model
     *
     * @return array
     */
    public function transform(Cluster $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
