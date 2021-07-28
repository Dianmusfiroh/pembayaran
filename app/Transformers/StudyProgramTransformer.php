<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\StudyProgram;

/**
 * Class StudyProgramTransformer.
 *
 * @package namespace App\Transformers;
 */
class StudyProgramTransformer extends TransformerAbstract
{
    /**
     * Transform the StudyProgram entity.
     *
     * @param \App\Entities\StudyProgram $model
     *
     * @return array
     */
    public function transform(StudyProgram $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
