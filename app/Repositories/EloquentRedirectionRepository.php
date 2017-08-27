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
            throw new GeneralException(trans('exceptions.backend.redirections.already_exist'));
        }

        if (!$redirection->save()) {
            throw new GeneralException(trans('exceptions.backend.redirections.create'));
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
            throw new GeneralException(trans('exceptions.backend.redirections.already_exist'));
        }

        if (!$redirection->update($input)) {
            throw new GeneralException(trans('exceptions.backend.redirections.update'));
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
        if (!$redirection->delete()) {
            throw new GeneralException(trans('exceptions.backend.redirections.delete'));
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

            throw new GeneralException(trans('exceptions.backend.redirections.delete'));
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

            throw new GeneralException(trans('exceptions.backend.redirections.update'));
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
        $buttons = $this->getEditButtonHtml("#/redirections/{$redirection->id}/edit")
            .$this->getDeleteButtonHtml('admin.redirections.destroy', $redirection, 'delete redirections');

        return $buttons;
    }
}
