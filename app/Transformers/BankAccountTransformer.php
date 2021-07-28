<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\BankAccount;

/**
 * Class BankAccountTransformer.
 *
 * @package namespace App\Transformers;
 */
class BankAccountTransformer extends TransformerAbstract
{
    /**
     * Transform the BankAccount entity.
     *
     * @param \App\Entities\BankAccount $model
     *
     * @return array
     */
    public function transform(BankAccount $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
