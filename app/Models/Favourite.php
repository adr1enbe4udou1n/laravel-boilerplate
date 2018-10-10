<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property string $model_type
 * @property int $model_id
 * @property int $user_id
 * @property Carbon|null $created_at
 */
class Favourite extends Model
{
    /** @var string */
    public const TYPE_POSTS = 'posts';

    /** @var array */
    public const EXISTING_TYPES = [
        self::TYPE_POSTS => Post::class,
    ];

    /** @var null */
    public const UPDATED_AT = null;

    /** @var bool */
    public $incrementing = false;

    /** @var array */
    protected $fillable = [
        'model_id',
        'model_type',
        'user_id',
    ];

    /** @var array */
    protected $primaryKey = [
        'model_id',
        'model_type',
        'user_id',
    ];

    /** @var array */
    protected $casts = [
        'model_id'   => 'integer',
        'model_type' => 'string',
        'user_id'    => 'integer',
    ];

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function setKeysForSaveQuery(Builder $query): Builder
    {
        $query->where([
            'model_id'   => $this->model_id,
            'model_type' => $this->model_type,
            'user_id'    => $this->user_id,
        ]);

        return $query;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
