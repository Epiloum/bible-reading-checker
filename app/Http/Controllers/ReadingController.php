<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use App\Models\Book;

class ReadingController extends Controller
{
    public function index()
    {
        /*
        $books = Book::select('id', 'testament', 'title')
            ->with('chapters')
            ->where('chapters.users', auth()->user()->id)
            ->orderBy('id')
            ->get();
        */

        $books = [];
        $chapters = [];
        $auth_user_id = auth()->user()->id;

        $res = DB::select(
            "
            SELECT
                b.id, b.testament, b.title, c.chapter, IF(cu.id IS NULL, 0, 1) AS chk_read
            FROM `books` AS b
                JOIN `chapters` AS c ON b.id = c.book_id
                LEFT JOIN `chapter_user` AS cu ON c.id = cu.chapter_id AND cu.user_id = {$auth_user_id}
            ORDER BY b.id, c.id
        "
        );

        foreach ($res as $v) {
            $books[$v->testament][$v->id] = $v->title;
            $chapters[$v->id][$v->chapter] = $v->chk_read;
        }

        return view('app/reading', ['books' => $books, 'chapters' => $chapters]);
    }
}
