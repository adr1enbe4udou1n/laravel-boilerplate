<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FormSettingTranslation
 *
 * @property int $id
 * @property int $form_setting_id
 * @property string $locale
 * @property string $message
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSettingTranslation whereFormSettingId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSettingTranslation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSettingTranslation whereLocale($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSettingTranslation whereMessage($value)
 * @mixin \Eloquent
 */
class FormSettingTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['message'];
}
