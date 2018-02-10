<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;

class SluggableSaving
{
    use SerializesModels;

    /**
     * @var Model
     */
    public $model;

    /**
     * @param $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
