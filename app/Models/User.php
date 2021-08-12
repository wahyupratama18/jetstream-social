<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\{HasProfilePhoto, HasTeams};
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,
        HasFactory,
        HasProfilePhoto,
        HasTeams,
        Notifiable,
        TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ],

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ],

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    $casts = [
        'email_verified_at' => 'datetime',
    ],

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    $appends = [
        'profile_photo_url',
    ];

    const ROLES = [ 1 => 'Administrator', 2 => 'Employee', 3 => 'Visitor'];

    /**
     * Get all of the socials for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function socials(): HasMany
    {
        return $this->hasMany(SocialLogin::class);
    }
}
