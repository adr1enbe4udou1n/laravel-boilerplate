<?php

namespace App\Repositories;

use Illuminate\Database\Concerns\ManagesTransactions;

/**
 * Class BaseRepository.
 */
class BaseRepository
{

    /**
     * Associated Repository Model.
     */
    const MODEL = null;

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return call_user_func(static::MODEL.'::query');
    }
}
