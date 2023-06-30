<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property-read string $id
 * @property-read string $name
 * @property-read string $email
 * @property-read string $password
 * @property-read string $profile_photo_path
 * @property-read string $two_factor_secret
 * @property-read string $two_factpr_recovery_codes
 * @property-read CarbonInterface $two_factpr_confirmed_at
 * @property-read CarbonInterface $email_verified_at
 * @property-read CarbonInterface $updated_at
 * @property-read CarbonInterface $created_at
 */
final class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasUlids;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'two_factor_confirmed_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];
}
