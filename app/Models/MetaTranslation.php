<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MetaTranslation
 *
 * @property int $id
 * @property int $meta_id
 * @property string $locale
 * @property string $url
 * @property string $title
 * @property string $description
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MetaTranslation whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MetaTranslation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MetaTranslation whereLocale($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MetaTranslation whereMetaId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MetaTranslation whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MetaTranslation whereUrl($value)
 * @mixin \Eloquent
 */
class MetaTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['url', 'title', 'description'];
}
