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
     * @param Meta $meta
     */
    public function __construct(Meta $meta)
    {
        parent::__construct($meta);
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->query()->select([
            'id',
            'route',
            'created_at',
            'updated_at',
        ]);
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
     * @return \App\Models\Meta
     *
     * @throws \Exception|\Throwable
     */
    public function store(array $input)
    {
        /** @var Meta $meta */
        $meta = $this->make($input);

        if ($this->find($meta->route)) {
            throw new GeneralException(trans('exceptions.backend.metas.already_exist'));
        }

        DB::transaction(function () use ($meta) {
            if ($meta->save()) {
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.metas.create'));
        });

        return $meta;
    }

    /**
     * @param Meta  $meta
     * @param array $input
     *
     * @return \App\Models\Meta
     *
     * @throws Exception
     * @throws \Exception|\Throwable
     */
    public function update(Meta $meta, array $input)
    {
        if (($existingMeta = $this->find($meta->route))
            && $existingMeta->id !== $meta->id
        ) {
            throw new GeneralException(trans('exceptions.backend.metas.already_exist'));
        }

        DB::transaction(function () use ($meta, $input) {
            if ($meta->update($input)) {
                $meta->save();

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.metas.update'));
        });

        return $meta;
    }

    /**
     * @param Meta $meta
     *
     * @return bool|null
     *
     * @throws \Exception|\Throwable
     */
    public function destroy(Meta $meta)
    {
        DB::transaction(function () use ($meta) {
            if ($meta->delete()) {
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.metas.delete'));
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
        $buttons = $this->getEditButtonHtml('admin.meta.edit', $meta)
            .$this->getDeleteButtonHtml('admin.meta.destroy', $meta);

        return $buttons;
    }
}
