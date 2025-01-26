<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "user";
    protected $primaryKey = "userId";
    public $timestamps = true;
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'company',
        'phone',
        'password',
        'fkUserTypeId',
        'username',
        'fk_country_id',
        'fk_industry_id',
        'fk_team_id',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userType(): HasOne
    {
        return $this->hasOne(UserType::class, 'userTypeId', 'fkUserTypeId');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'fk_team_id', 'id');
    }
}
