<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FormSetting.
 *
 * @property int $id
 * @property string $name
 * @property string $recipients
 * @property string $message
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSetting whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSetting whereMessage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSetting whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSetting whereRecipients($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSetting whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @property mixed $array_recipients
 * @property mixed $html_message
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\FormSettingTranslation[] $translations
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSetting listsTranslations($translationField)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSetting notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSetting orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSetting orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSetting translated()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSetting translatedIn($locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSetting whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSetting whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSetting withTranslation()
 */
class FormSetting extends Model
{
    use Translatable;

    public $translatedAttributes = ['message'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'name',
            'recipients',
        ];

    protected $with = ['translations'];

    public function getArrayRecipientsAttribute()
    {
        return explode(',', $this->recipients);
    }

    public function getHtmlMessageAttribute()
    {
        $message = explode("\r\n", $this->message);

        return '<p>'.implode("</p>\r\n<p>", $message).'</p>'."\r\n";
    }
}
