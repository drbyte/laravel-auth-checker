<?php

namespace Lab404\AuthChecker\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Device
 *
 * @package Lab404\AuthChecker\Models
 * @property int $id
 * @property Login $login
 * @property string|null $platform
 * @property string|null $platform_version
 * @property string|null $browser
 * @property string|null $browser_version
 * @property bool $is_desktop
 * @property bool $is_mobile
 * @property string|null $language
 */
class Device extends Model
{
    /** @var array */
    protected $casts = [
        'is_locked' => 'boolean',
        'is_desktop' => 'boolean',
        'is_phone' => 'boolean',
    ];

    /** @var array */
    protected $fillable = [
        'platform',
        'platform_version',
        'browser',
        'browser_version',
        'is_desktop',
        'is_phone',
        'is_trusted',
        'is_untrusted',
    ];

    /**
     * @param   void
     * @return  HasMany
     */
    public function logins()
    {
        return $this->hasMany(Login::class);
    }

    /**
     * @param   void
     * @return  HasOne
     */
    public function login()
    {
        return $this->hasOne(Login::class)->orderBy('created_at', 'desc');
    }

    /**
     * @param   void
     * @return  BelongsTo
     */
    public function user()
    {
        $model = config('auth.providers.users.model');

        return $this->belongsTo($model);
    }
}