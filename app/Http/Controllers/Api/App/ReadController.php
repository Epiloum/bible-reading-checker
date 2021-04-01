<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use App\Models\Read;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReadController extends Controller
{
    protected $auth_id;

    public function __construct()
    {
        $this->auth_id = env('APP_ENV') == 'local'? 1: Auth::user()->id;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $res = Read::where('user_id', $this->auth_id)->get();

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
        //
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
            ->where('user_id', $this->auth_id)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Read  $read
     * @return \Illuminate\Http\Response
     */
    public function destroy(Read $read)
    {
        //
    }
}
