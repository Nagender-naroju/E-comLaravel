<?php

namespace App\Models;

use App\Models\Admin\ProductsModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = "cart";

    protected $fillable = [
        'user_id',
        'product_id',
        'product_qty'
    ];

    public function products()
    {
        return $this->belongsTo(ProductsModel::class,'product_id', 'id');
    }
}
