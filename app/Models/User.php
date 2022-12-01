<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    use HasFactory;
    use HasApiTokens;

    public const IDENTITY_SELECT = [
        'Male'   => 'Male',
        'Female' => 'Female',
        'Both'   => 'Both',
    ];

    public const INTEREST_SELECT = [
        'Male'   => 'Male',
        'Female' => 'Female',
        'Both'   => 'Both',
    ];

    public const RELATION_PREFERENCE_SELECT = [
        'Casual'   => 'Casual',
        'Friendly' => 'Friendly',
        'Intimate' => 'Intimate',
    ];

    public const AGE_SELECT = [
        '18-20'       => '18-20',
        '21-25'       => '21-25',
        '26-30'       => '26-30',
        '31-35'       => '31-35',
        '36-40'       => '36-40',
        '41 or above' => '41 or above',
    ];
    
    public const USER_STATUS_SELECT = [
        'activated'   => 'Activated',
        'deactivated' => 'Deactivated',
        'blocked'   => 'Blocked',
        // '31-35'       => '31-35',
        // '36-40'       => '36-40',
        // '41 or above' => '41 or above',
    ];

    public $table = 'users';

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        // 'email',
        // 'email_verified_at',
        // 'password',
        // 'remember_token',
        'identity',
        'interest',
        'age',
        'relationPreference',
        'favDrink',
        'favSong',
        'hobbies',
        'petPeeve',
        'user_status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    
    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    
}
