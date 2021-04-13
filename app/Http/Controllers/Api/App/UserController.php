<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    public function show(int $user_id, Request $request)
    {
        if ($user_id != $request->user()->id) {
            return response('', 403);
        }

        $user = User::where('id', $user_id)->firstOrFail();
        return (new UserResource($user))->response();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(int $user_id, Request $request)
    {
        if ($user_id != $request->user()->id) {
            return response('', 403);
        }

        $user = User::where('id', $user_id)->firstOrFail();

        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'division' => 'required'
        ]);

        $user->name = $request->input('name');
        $user->mobile = $request->input('mobile');
        $user->division = $request->input('division');
        $user->save();

        return (new UserResource($user))->response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
