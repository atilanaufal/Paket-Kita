<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $email
 * @property string|null $password
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TrackingData> $trackingData
 * @property-read int|null $tracking_data_count
 * @method static \Illuminate\Database\Eloquent\Builder|UserAcc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAcc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAcc query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAcc whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAcc whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAcc wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAcc whereUsername($value)
 * @mixin \Eloquent
 */
class UserAcc extends Authenticatable {
    use HasFactory;
    use Notifiable;
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'UserAcc';
    protected $fillable = [
        'username', 'email', 'password'
    ];
    protected $hidden = [
        'password', 'remember_token', // Atur sesuai kebutuhan
    ];
    public function trackingData(): HasMany
    {
        return $this->hasMany(TrackingData::class, 'user_id');
    }

}
