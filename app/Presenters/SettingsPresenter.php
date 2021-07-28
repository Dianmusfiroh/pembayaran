<?php

namespace App\Presenters;

use App\Transformers\SettingsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SettingsPresenter.
 *
 * @package namespace App\Presenters;
 */
class SettingsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SettingsTransformer();
    }
}
