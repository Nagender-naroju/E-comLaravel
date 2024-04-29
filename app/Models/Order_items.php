<?php

namespace App\Models;

use App\Models\Admin\ProductsModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_items extends Model
{
    protected $table="order_items";
    protected $fillable = [
        "order_id",
        "product_id",
        'qty',
        'price'
        
    ];

    public function products()
    {
        return $this->belongsTo(ProductsModel::class,'product_id','id');
    }
}
