<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Gtts;

/**
 * Class GttsTransformer.
 *
 * @package namespace App\Transformers;
 */
class GttsTransformer extends TransformerAbstract
{
    /**
     * Transform the Gtts entity.
     *
     * @param \App\Entities\Gtts $model
     *
     * @return array
     */
    public function transform(Gtts $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
