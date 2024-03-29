<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use App\Models\Read;
use Illuminate\Http\Request;

class ReadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $res = Read::select('chapter_id', 'created_at')
            ->where('user_id', $request->user()->id)
            ->get();

        if ($request->book_id) {
            $res->filter(
                function ($read) use ($request) {
                    return $read->chapter->book_id == $request->book_id;
                }
            );
        }

        return $res;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'chapter_id' => 'required'
        ]);

        try {
            $res = Read::create([
                'user_id' => $request->user()->id,
                'chapter_id' => $request->input('chapter_id')
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                $res = response()->json(null, 409);
            } else {
                $res = response()->json(null, 500);
            }
        }

        return $res;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $res = Read::with('chapter.book')
            ->where('user_id', $request->user()->id)
            ->where('id', $id)
            ->get();

        if($request->book_id) {
            $res->filter(function ($read) use ($request) {
                return $read->chapter->book_id == $request->book_id;
            });
        }

        return $res;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Read  $read
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Read $read)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id, Request $request)
    {
        return Read::where('user_id', $request->user()->id)
            ->where('chapter_id', $id)
            ->delete();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function init(Request $request)
    {
        Read::where('user_id', $request->user()->id)->delete();
        return response()->noContent();
    }
}
