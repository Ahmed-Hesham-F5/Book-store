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
    public function getBook(Request $request,$bookId)
    {
        // Fetch a specific book by ID from the database
        $book = Book::find($bookId);

        // Check if the book exists
        if ($book) {
            return response()->json($book);
        } else {
            return response()->json(['message' => 'Book not found'], 404);
        }
    }
    public function addBook(Request $request){
        // // return response()->json($request->all());
        $book = Book::create($request->all());
        return response()->json($book);
    }
}
