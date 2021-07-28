<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\CandidateProfile;

/**
 * Class CandidateProfileTransformer.
 *
 * @package namespace App\Transformers;
 */
class CandidateProfileTransformer extends TransformerAbstract
{
    /**
     * Transform the CandidateProfile entity.
     *
     * @param \App\Entities\CandidateProfile $model
     *
     * @return array
     */
    public function transform(CandidateProfile $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
