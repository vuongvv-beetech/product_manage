<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Class Commune
 * @property string $name
 * @property int $district_id
 * @property timestamp $created_at
 * @property timestamp $updated_at
 */
class Commune extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'communes';

    protected $fillable = [
        'id','name','district_id'
    ];
    /**
     * Get commune that owns user.
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
