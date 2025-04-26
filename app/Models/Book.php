<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public $table = "books";

    protected $fillable = [
        'BookID',
        'price',
        'Description',
        'ImgSrc', 
        'Category',
        'Rating',
        'NumberOfReviews',
        'Tax',
        'Publisher',
        'Author'
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function shopingCart()
    {
        return $this->belongsToMany(ShopingCart::class,'shoping_carts_books')
        ->withPivot('quantity'); // list all extra columns here

    }
}
