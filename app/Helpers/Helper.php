<?php
namespace App\Helpers;
 

use App\Models\ProductCategory;
 
class Helper {
    /**
     * get data with parent_id = null
     *
     * @param 
     *
     * @return $category
     */
    public static function getIdCategory() {
        $categorys = new ProductCategory();
    
        $categorys = $categorys->select(
            'id',
            'name',
            )->where('parent_id',null)->get();
        return $categorys;
    }
    /**
     * get data with parent_id = null
     *
     * @param 
     *
     * @return $category
     */
    public static function getCategoryNotNull() {
        $categorys = new ProductCategory();
    
        $categorys = $categorys->select(
            'id',
            'name',
            )->whereNotNull('parent_id')->get();
        return $categorys;
    }
    /**
     * get all id category
     *
     * @param 
     *
     * @return $category
     */
    public static function getAllIdCategory() {
        $categorys = new ProductCategory();
    
        $categorys = $categorys->select(
            'id',
            'name'
            )->get();
        return $categorys;
    }
    /**
     * get name by id
     *
     * @param int $id
     *
     * @return name
     */
    public static function getNameByIdCategory($id) {
        $category = ProductCategory::findOrFail($id);
        return $category->name;
    }
}