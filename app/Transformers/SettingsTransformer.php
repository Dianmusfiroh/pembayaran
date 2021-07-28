<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Settings;

/**
 * Class SettingsTransformer.
 *
 * @package namespace App\Transformers;
 */
class SettingsTransformer extends TransformerAbstract
{
    /**
     * Transform the Settings entity.
     *
     * @param \App\Entities\Settings $model
     *
     * @return array
     */
    public function transform(Settings $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
