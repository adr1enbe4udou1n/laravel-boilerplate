<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\Redirection;
use App\Repositories\Contracts\RedirectionRepository;
use App\Repositories\Traits\HtmlActionsButtons;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class EloquentRedirectionRepository.
 */
class EloquentRedirectionRepository extends EloquentBaseRepository implements RedirectionRepository
{
    use HtmlActionsButtons;

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
     * @return mixed
     */
    public function get()
    {
        return $this->query()->select([
            'id',
            'source',
            'active',
            'target',
            'type',
            'created_at',
            'updated_at',
        ]);
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
     * @return \App\Models\Redirection
     *
     * @throws \Exception|\Throwable
     */
    public function store(array $input)
    {
        /** @var Redirection $redirection */
        $redirection = $this->make($input);

        if ($this->find($redirection->source)) {
            throw new GeneralException(trans('exceptions.backend.redirections.already_exist'));
        }

        DB::transaction(function () use ($redirection) {
            if ($redirection->save()) {
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.redirections.create'));
        });

        return $redirection;
    }

    /**
     * @param Redirection $redirection
     * @param array       $input
     *
     * @return \App\Models\Redirection
     *
     * @throws Exception
     * @throws \Exception|\Throwable
     */
    public function update(Redirection $redirection, array $input)
    {
        if (($existingRedirection = $this->find($redirection->source))
            && $existingRedirection->id !== $redirection->id
        ) {
            throw new GeneralException(trans('exceptions.backend.redirections.already_exist'));
        }

        DB::transaction(function () use ($redirection, $input) {
            if ($redirection->update($input)) {
                $redirection->save();

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.redirections.update'));
        });

        return $redirection;
    }

    /**
     * @param Redirection $redirection
     *
     * @return bool|null
     *
     * @throws \Exception|\Throwable
     */
    public function destroy(Redirection $redirection)
    {
        DB::transaction(function () use ($redirection) {
            if ($redirection->delete()) {
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.redirections.delete'));
        });

        return true;
    }

    /**
     * @param array $ids
     *
     * @return mixed
     *
     * @throws \Exception|\Throwable
     */
    public function batchDestroy(array $ids)
    {
        DB::transaction(function () use ($ids) {
            // This wont call eloquent events, change to destroy if needed
            if ($this->query()->whereIn('id', $ids)->delete()) {
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.redirections.delete'));
        });

        return true;
    }

    /**
     * @param array $ids
     *
     * @return mixed
     *
     * @throws \Exception|\Throwable
     */
    public function batchEnable(array $ids)
    {
        DB::transaction(function () use ($ids) {
            if ($this->query()->whereIn('id', $ids)
                ->update(['active' => true])
            ) {
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.redirections.update'));
        });

        return true;
    }

    /**
     * @param array $ids
     *
     * @return mixed
     *
     * @throws \Exception|\Throwable
     */
    public function batchDisable(array $ids)
    {
        DB::transaction(function () use ($ids) {
            if ($this->query()->whereIn('id', $ids)
                ->update(['active' => false])
            ) {
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.redirections.update'));
        });

        return true;
    }

    /**
     * @param \App\Models\Redirection $redirection
     *
     * @return mixed
     */
    public function getActionButtons(Redirection $redirection)
    {
        $buttons = $this->getEditButtonHtml('admin.redirection.edit', $redirection)
            .$this->getDeleteButtonHtml('admin.redirection.destroy', $redirection);

        return $buttons;
    }
}
