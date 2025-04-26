<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopingCart extends Model
{
    use HasFactory;
    public $table = "shoping_cart";

    public function book()
    {
        return $this->belongsToMany(Book::class,'shoping_carts_books')
        ->withPivot('quantity'); // list all extra columns here

    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
