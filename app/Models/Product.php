<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const NO_STOCK = 1;
    const IN_STOCK = 2;
    const OUT_OF_STOCK = 0;
    
    protected $table = 'products';
    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    public function subCategory()
    {
        return $this->hasOne(Sub_Category::class, 'id', 'sub_category_id');
    }
    public static function getColor($id)
    {
        return Color::find($id);
    }
    public static function getFeature($id)
    {
        return Feature::find($id);
    }
    public static function getSize($id){
        return Size::where('sub_category_id',$id)->where('status', Size::ACTIVE)->select('measurement', 'unit')->get();
    }
    public static function getStatus($status_id)
    {
        switch ($status_id) {
            case 0:
                return "<span class='text-danger'> Out of Stock </span>";
            case 1:
                return "<span class='text-warning'> No Previous Stock </span>";
            case 2:
                return "<span class='text-success'> In Stock </span>";
        }
    }
}
