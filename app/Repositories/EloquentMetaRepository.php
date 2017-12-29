<?php

namespace App\Repositories;

use Exception;
use App\Models\Meta;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\Contracts\MetaRepository;

/**
 * Class EloquentMetaRepository.
 */
class EloquentMetaRepository extends EloquentBaseRepository implements MetaRepository
{
    /**
     * EloquentMetaRepository constructor.
     *
     * @param Meta $redirection
     */
    public function __construct(Meta $redirection)
    {
        parent::__construct($redirection);
    }

    /**
     * @param $route
     *
     * @return Meta
     */
    public function find($route)
    {
        /* @var Meta $meta */
        return $this->query()->whereRoute($route)->first();
    }

    /**
     * @param array $input
     *
     * @throws \Exception|\Throwable
     *
     * @return \App\Models\Meta
     */
    public function store(array $input)
    {
        /** @var Meta $meta */
        $meta = $this->make($input);

        if ($this->find($meta->route)) {
            throw new GeneralException(__('exceptions.backend.metas.already_exist'));
        }

        if (! $meta->save()) {
            throw new GeneralException(__('exceptions.backend.metas.create'));
        }

        return $meta;
    }

    /**
     * @param Meta  $meta
     * @param array $input
     *
     * @throws Exception
     * @throws \Exception|\Throwable
     *
     * @return \App\Models\Meta
     */
    public function update(Meta $meta, array $input)
    {
        if ($meta->route) {
            $existingMeta = $this->find($meta->route);

            if ($existingMeta->id !== $meta->id) {
                throw new GeneralException(__('exceptions.backend.metas.already_exist'));
            }
        }

        if (! $meta->update($input)) {
            throw new GeneralException(__('exceptions.backend.metas.update'));
        }

        return $meta;
    }

    /**
     * @param Meta $meta
     *
     * @throws \Exception|\Throwable
     *
     * @return bool|null
     */
    public function destroy(Meta $meta)
    {
        if (! $meta->delete()) {
            throw new GeneralException(__('exceptions.backend.metas.delete'));
        }

        return true;
    }

    /**
     * @param array $ids
     *
     * @throws \Exception|\Throwable
     *
     * @return mixed
     */
    public function batchDestroy(array $ids)
    {
        DB::transaction(function () use ($ids) {
            // This wont call eloquent events, change to destroy if needed
            if ($this->query()->whereIn('id', $ids)->delete()) {
                return true;
            }

            throw new GeneralException(__('exceptions.backend.metas.delete'));
        });

        return true;
    }
}
