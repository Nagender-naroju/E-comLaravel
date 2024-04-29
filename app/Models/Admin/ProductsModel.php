<?php

namespace App\Models\Admin;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
    use HasFactory;
    protected $table = "products";

    protected $fillable = [
           "category_id",
            "name",
            "small_description",
           "description",
            "original_price",
            "selling_price",
            "image",
            "qty",
            "tax",
            "status",
            "trending",
            "meta_title",
            "meta_keywords",
            "meta_description"
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class,'category_id', 'id'); // (belongsto Model, foreign key, primary key)
    }
}
