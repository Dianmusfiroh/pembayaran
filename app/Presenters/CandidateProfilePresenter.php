<?php

namespace App\Presenters;

use App\Transformers\CandidateProfileTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CandidateProfilePresenter.
 *
 * @package namespace App\Presenters;
 */
class CandidateProfilePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CandidateProfileTransformer();
    }
}
