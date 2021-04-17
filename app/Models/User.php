<?php

namespace App\Models;

use App\Notifications\ResetPasswordRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use  Illuminate\Contracts\Auth\CanResetPassword as resetPw;
use Illuminate\Auth\Passwords\CanResetPassword;
/**
 * Class User
 * @property string $name
 * @property string $email 
 * @property date $birthday 
 * @property string $first_name
 * @property string $last_name
 * @property string $password
 * @property boolean $status
 * @property boolean $flag_delete
 * @property string $avatar
 * @property string $address
 * @property int $province_id
 * @property int $district_id
 * @property int $commune_id
 * @property timestamp $created_at
 * @property timestamp $updated_at
 */


class User extends Authenticatable implements resetPw
{
    use  HasFactory, Notifiable, HasApiTokens, CanResetPassword;
    const CONFIRM = 2;
    const ACTIVE = 1;
    const IN_ACTIVE = 0;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'birthday',
        'first_name',
        'last_name',
        'status',
        'avatar',
        'province_id',
        'district_id',
        'commune_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * Get user for province.
     */
    public function userProvince()
    {
        return $this->belongsTo(Province::class,'province_id','id');
    }
    /**
     * Get user for district.
     */
    public function userDistrict()
    {
        return $this->belongsTo(District::class,'district_id','id');
    }
    /**
     * Get user for .
     */
    public function userCommune()
    {
        return $this->belongsTo(Commune::class,'commune_id','id');
    }

}