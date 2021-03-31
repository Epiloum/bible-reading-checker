<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class ReadingController extends Controller
{
    public function index()
    {
        $books = Book::select('id', 'testament', 'title')->with('chapters')->get();

        return view('app/reading', ['books' => $books]);
    }
}
