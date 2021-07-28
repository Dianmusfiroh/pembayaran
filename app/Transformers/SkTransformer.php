<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Sk;

/**
 * Class SkTransformer.
 *
 * @package namespace App\Transformers;
 */
class SkTransformer extends TransformerAbstract
{
    /**
     * Transform the Sk entity.
     *
     * @param \App\Entities\Sk $model
     *
     * @return array
     */
    public function transform(Sk $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
