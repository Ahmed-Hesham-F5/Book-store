<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class ShopingCart extends Controller
{
    //
    public function getOrCreateShopingCart(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            // if(!$user instanceof User) {
            //     throw new \RuntimeException('Authenticated user is not a User model.');
            // }
            $shopingCart = $user->shopingCart;
            // $shopingCart = $user->shopingCart()->with('book')->first();
            if ($shopingCart) {
                $shopingCart = $user->shopingCart->with('book')->get();   
                return response()->json($shopingCart, 200);
            } else {
                $shopingCart = $user->shopingCart()->create([]);
                return response()->json($shopingCart, 201);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    public function addBookToShopingCart(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            // if(!$user instanceof User) {
            //     throw new \RuntimeException('Authenticated user is not a User model.');
            // }
            $shopingCart = $user->shopingCart;
            if ($shopingCart) {
            //    dd(Book::find($request->input('book_id')));
                // return "afda";
             //   return $request->input('book_id');
                $book =Book::findOrFail( $request->input('book_id'));
             //   return response()->json($book, 200);
                
                    // Check if the book is already in the shopping cart
                 if($shopingCart->book()->find($book->id))
                  return response()->json(['error' => 'book is already in the shopping cart'], 404);

                 $shopingCart->book()->attach($book);
                return response()->json(['message' => 'Book added to shopping cart'], 200);
            } else {
                return response()->json(['error' => 'Shopping cart not found'], 404);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    public function updateBookQuantityInShopingCart(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            // if(!$user instanceof User) {
            //     throw new \RuntimeException('Authenticated user is not a User model.');
            // }
            $shopingCart = $user->shopingCart;
            if ($shopingCart) {
                $book = Book::findOrFail($request->input('book_id'));
                $shopingCart->book()->updateExistingPivot($book->id, [
                    'quantity' => $request->input('quantity')
                ]);
                return response()->json(['message' => 'Book quantity updated in shopping cart'], 200);
            } else {
                return response()->json(['error' => 'Shopping cart not found'], 404);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    public function deleteBookFromShopingCart(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            // if(!$user instanceof User) {
            //     throw new \RuntimeException('Authenticated user is not a User model.');
            // }
            $shopingCart = $user->shopingCart;
            if ($shopingCart) {
                $book = Book::findOrFail($request->input('book_id'));
                $shopingCart->book()->detach($book->id);
                return response()->json(['message' => 'Book removed from shopping cart'], 200);
            } else {
                return response()->json(['error' => 'Shopping cart not found'], 404);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
