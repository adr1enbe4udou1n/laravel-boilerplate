<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;

/**
 * App\Models\Redirection
 *
 * @property int $id
 * @property string $source
 * @property bool $active
 * @property string $target
 * @property string $type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read mixed $redirect_type
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Redirection whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Redirection whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Redirection whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Redirection whereSource($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Redirection whereTarget($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Redirection whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Redirection whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Redirection extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'source',
            'active',
            'target',
            'type',
        ];

    /**
     * @return array
     */
    public static function getRedirectTypes()
    {
        return [
            Response::HTTP_MOVED_PERMANENTLY => 'labels.backend.redirections.types.permanent',
            Response::HTTP_FOUND => 'labels.backend.redirections.types.temporary',
        ];
    }

    public function getRedirectTypeAttribute() {
        return self::getRedirectTypes()[$this->type];
    }
}
