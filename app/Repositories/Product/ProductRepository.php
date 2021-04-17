<?php
namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\CrudRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\RepositoryInterface;

class ProductRepository extends CrudRepository implements RepositoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Product::class;
    }
}