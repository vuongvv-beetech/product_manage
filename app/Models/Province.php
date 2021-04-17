<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
* Class User
* @property string $name
* @property timestamp $created_at
* @property timestamp $updated_at
*/
class Province extends Model
{

    use HasFactory;
    protected $table = 'provinces';

    protected $fillable = [
        'id','name',
    ];
    /**
     * Get province that owns user.
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

}
