<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
* Class District
* @property string $name
* @property int $province_id
* @property timestamp $created_at
* @property timestamp $updated_at
*/
class District extends Model
{
    
    use HasFactory;
    protected $table = 'districts';

    protected $fillable = [
        'id','name','province_id'
    ];
    /**
     * Get district that owns user.
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

}
