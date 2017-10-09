<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\Meta;
use App\Repositories\Contracts\MetaRepository;
use App\Repositories\Traits\HtmlActionsButtons;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class EloquentMetaRepository.
 */
class EloquentMetaRepository extends EloquentBaseRepository implements MetaRepository
{
    use HtmlActionsButtons;

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
            throw new GeneralException(trans('exceptions.backend.metas.already_exist'));
        }

        if (!$meta->save()) {
            throw new GeneralException(trans('exceptions.backend.metas.create'));
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
                throw new GeneralException(trans('exceptions.backend.metas.already_exist'));
            }
        }

        if (!$meta->update($input)) {
            throw new GeneralException(trans('exceptions.backend.metas.update'));
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
        if (!$meta->delete()) {
            throw new GeneralException(trans('exceptions.backend.metas.delete'));
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

            throw new GeneralException(trans('exceptions.backend.metas.delete'));
        });

        return true;
    }

    /**
     * @param \App\Models\Meta $meta
     *
     * @return mixed
     */
    public function getActionButtons(Meta $meta)
    {
        $buttons = $this->getEditButtonHtml("/metas/{$meta->id}/edit")
            .$this->getDeleteButtonHtml('admin.metas.destroy', $meta, 'delete metas');

        return $buttons;
    }
}
