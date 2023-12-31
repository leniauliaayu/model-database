<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $books = Book::all();
    return view('books.index', compact('books'));
}

public function create()
{
    return view('books.create');
}

public function store(Request $request)
{
    $request->validate([
        'no' =>'required',
        'title' => 'required',
        'author' => 'required',
        'year' => 'requiredInteger',
        'description' => 'required',
    ]);

    Book::create($request->all());

    return redirect()->route('books.index')
        ->with('success', 'Book created successfully.');
}

public function edit(Book $book)
{
    return view('books.edit', compact('book'));
}

public function update(Request $request, Book $book)
{
    $request->validate([
        'no' => 'required',
        'title' => 'required',
        'author' => 'required',
        'year' => 'required|integer',
        'description' => 'required',
    ]);

    $book->update($request->all());

    return redirect()->route('books.index')
        ->with('success', 'Book updated successfully.');
}

public function destroy(Book $book)
{
    $book->delete();

    return redirect()->route('books.index')
        ->with('success', 'Book deleted successfully.');
}
}
