<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Carbon\Carbon;

class BookController extends Controller
{
    // BookController
    public function book(Request $request)
    {
        $data = $request->all();

        $books = Book::query();

        // Optional filters (add more as needed)
        if (!empty($data['title'])) {
            $books->where('title', 'like', '%' . $data['title'] . '%');
        }

        // if (!empty($data['author'])) {
        //     $books->where('author', 'like', '%' . $data['author'] . '%');
        // }

        $books = $books->paginate(5);

        return view('dashboard', [
            'books' => $books,
        ]);
    }

    public function book_add()
    {
        return view('books.book_add');
    }

    public function book_store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|min:5|max:13|unique:books,isbn',
            'stock' => 'required|integer|min:0',
            'price' => 'nullable|numeric|min:0|max:999999.99',
        ]);
        Book::insert([
            'title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'stock' => $request->stock,
            'price' => $request->price,
            'created_at' => Carbon::now(),
        ]);
        return redirect('dashboard')->withSuccess('Book added successfully');
    }
    // Book edit
    public function book_edit($book_id)
    {
        $book = Book::find($book_id);
        return view('books.book_edit', [
            'book' => $book,
        ]);
    }
    // Book update
    public function book_update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|size:13|unique:books,isbn',
            // 'isbn' => 'required|string|min:5|max:13|unique:books,isbn',
            'stock' => 'required|integer|min:0',
            'price' => 'nullable|numeric|min:0|max:999999.99',
        ]);
        Book::find($request->book_id)->update([
            'title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'stock' => $request->stock,
            'price' => $request->price,
            'updated_at' => Carbon::now(),
        ]);
        return redirect('dashboard')->withSuccess("Book information updated successfully");
    }
    // Book delete
    function book_delete($book_id)
    {
        Book::find($book_id)->delete();
        // Book::find($book_id)?->delete();
        return back()->withSuccess('Book deleted successfully');
    }
    // Book information
    function book_info($book_id)
    {
        $book = Book::find($book_id);
        return view('books.book', [
            'book' => $book,
        ]);
    }
}
