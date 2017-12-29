<?php

namespace App\Repositories;

use Exception;
use App\Models\Redirection;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\Contracts\RedirectionRepository;

/**
 * Class EloquentRedirectionRepository.
 */
class EloquentRedirectionRepository extends EloquentBaseRepository implements RedirectionRepository
{
    /**
     * EloquentRedirectionRepository constructor.
     *
     * @param Redirection $redirection
     */
    public function __construct(Redirection $redirection)
    {
        parent::__construct($redirection);
    }

    /**
     * @param $source
     *
     * @return Redirection
     */
    public function find($source)
    {
        return $this->query()->whereSource($source)->first();
    }

    /**
     * @param array $input
     *
     * @throws \Exception|\Throwable
     *
     * @return \App\Models\Redirection
     */
    public function store(array $input)
    {
        /** @var Redirection $redirection */
        $redirection = $this->make($input);

        if ($this->find($redirection->source)) {
            throw new GeneralException(__('exceptions.backend.redirections.already_exist'));
        }

        if (! $redirection->save()) {
            throw new GeneralException(__('exceptions.backend.redirections.create'));
        }

        return $redirection;
    }

    /**
     * @param Redirection $redirection
     * @param array       $input
     *
     * @throws Exception
     * @throws \Exception|\Throwable
     *
     * @return \App\Models\Redirection
     */
    public function update(Redirection $redirection, array $input)
    {
        if (($existingRedirection = $this->find($redirection->source))
            && $existingRedirection->id !== $redirection->id
        ) {
            throw new GeneralException(__('exceptions.backend.redirections.already_exist'));
        }

        if (! $redirection->update($input)) {
            throw new GeneralException(__('exceptions.backend.redirections.update'));
        }

        return $redirection;
    }

    /**
     * @param Redirection $redirection
     *
     * @throws \Exception|\Throwable
     *
     * @return bool|null
     */
    public function destroy(Redirection $redirection)
    {
        if (! $redirection->delete()) {
            throw new GeneralException(__('exceptions.backend.redirections.delete'));
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

            throw new GeneralException(__('exceptions.backend.redirections.delete'));
        });

        return true;
    }

    /**
     * @param array $ids
     *
     * @throws \Exception|\Throwable
     *
     * @return mixed
     */
    public function batchEnable(array $ids)
    {
        DB::transaction(function () use ($ids) {
            if ($this->query()->whereIn('id', $ids)
                ->update(['active' => true])
            ) {
                return true;
            }

            throw new GeneralException(__('exceptions.backend.redirections.update'));
        });

        return true;
    }

    /**
     * @param array $ids
     *
     * @throws \Exception|\Throwable
     *
     * @return mixed
     */
    public function batchDisable(array $ids)
    {
        DB::transaction(function () use ($ids) {
            if ($this->query()->whereIn('id', $ids)
                ->update(['active' => false])
            ) {
                return true;
            }

            throw new GeneralException(__('exceptions.backend.redirections.update'));
        });

        return true;
    }
}
