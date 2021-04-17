<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @property string $sku
 * @property string $name
 * @property int $stock
 * @property string $avatar
 * @property int $catrgory_id 
 * @property date $expired_at 
 * @property timestamp $created_at
 * @property timestamp $updated_at
 */
class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'name', 'sku',
    ];
    /**
     * Get product for productcategory.
     */
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class,'catrgory_id','id');
    }
    
}
