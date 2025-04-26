<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;
// use App\Models\User;
class BooksController extends Controller
{
    //
    public function getAllBooks()
    {
        // Fetch all books from the database
        $books = Book::all();

        // Return the books as a JSON response
        return response()->json($books);
    }
}
