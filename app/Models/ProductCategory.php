<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductCategory
 * @property string $name
 * @property int $parent_id 
 * @property date $expired_at 
 * @property timestamp $created_at
 * @property timestamp $updated_at
 */
class ProductCategory extends Model
{
    use HasFactory;
    protected $table = 'productcategorys';

    protected $fillable = [
        'name', 'parent_id',
    ];

    /**
     * Get productcategory that owns product.
     */
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    /**
     * Get productcategory that owns productcategory.
     */
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class,'parent_id','id');
    }
 
}
