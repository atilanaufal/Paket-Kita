<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *
 *
 * @property int $track_id
 * @property int|null $user_id
 * @property string|null $awb
 * @property string|null $courier
 * @property string|null $status
 * @property string|null $origin
 * @property string|null $destination
 * @property string|null $shipper
 * @property string|null $receiver
 * @property string|null $date
 * @property string|null $description
 * @property string|null $location
 * @property-read \App\Models\UserAcc|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|TrackingData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrackingData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrackingData query()
 * @method static \Illuminate\Database\Eloquent\Builder|TrackingData whereAwb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackingData whereCourier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackingData whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackingData whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackingData whereDestination($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackingData whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackingData whereOrigin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackingData whereReceiver($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackingData whereShipper($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackingData whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackingData whereTrackId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackingData whereUserId($value)
 * @mixin \Eloquent
 */
class TrackingData extends Model {
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'track_id';
    protected $table = 'TrackingData';
    protected $fillable = [
        'user_id', 'awb', 'courier', 'status', 'origin',
        'destination', 'shipper', 'receiver',
        'date', 'description', 'location',
    ];


    // Relasi dengan model UserAcc
    public function user()
    {
        return $this->belongsTo(UserAcc::class, 'user_id', 'id');
    }
}
