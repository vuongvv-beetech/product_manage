<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PasswordReset
 * @property string $name
 * @property string $token
 * @property timestamp $created_at
 */
class PasswordReset extends Model
{
    use HasFactory;
    const ACTIVE = 1;
    const IN_ACTIVE = 0;
    
    protected $table = 'password_resets';
    public $timestamps = false;

    protected $fillable = [
        'email',
        'token',
    ];
}
