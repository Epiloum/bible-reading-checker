<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
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
     * @param int $user_id
     * @param Request $request
     * @return JsonResponse
     */
    public function update(int $user_id, Request $request): JsonResponse
    {
        if ($user_id != $request->user()->id) {
            return response()->json([], 403);
        }

        $user = User::where('id', $user_id)->firstOrFail();

        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'division' => 'required'
        ]);

        $user->name = $request->input('name');
        $user->mobile = $request->input('mobile');
        $user->target_date = $request->input('target_date', Carbon::now()->format('Y-12-31'));
        $user->division = $request->input('division');
        $user->save();

        return (new UserResource($user))->response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     */
    public function destroy(User $user)
    {
        //
    }
}
