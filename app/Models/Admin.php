<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class Admin
 * @property string $name
 * @property string $email 
 * @property date $birthday 
 * @property string $first_name
 * @property string $last_name
 * @property string $password
 * @property boolean $status
 * @property boolean $flag_delete
 * @property string $avatar
 * @property timestamp $created_at
 * @property timestamp $updated_at
 */
class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admins';

    protected $guarded = 'admin';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}