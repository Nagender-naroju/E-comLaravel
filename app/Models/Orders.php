<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table="orders";
    protected $fillable = [
        'user_id',
        "fname",
        "lname",
        'email',
        'phone',
        'address_1',
        'address_2',
        'country',
        'state',
        'city',
        'pincode',
        'total_price',
        'payment_mode',
        'payment_id',
        'message',
        'tracking_no'
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
