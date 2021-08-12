<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialLogin extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'social_id', 'driver_id',
    ],

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    $appends = [
        'driver',
    ];

    const DRIVES = ['Facebook', 'Twitter', 'LinkedIn', 'Google', 'GitHub'];

    /**
     * Get the user that owns the SocialLogin
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get Driver Name
     *
     * @return string
     */
    public function getDriverAttribute(): string
    {
        return self::DRIVES[$this->driver_id];
    }
}
