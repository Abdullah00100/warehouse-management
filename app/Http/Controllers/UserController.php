<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  $this->success(UserResource::collection(User::all()), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if (auth('sanctum')->user()->role_id > 1 && $request->role_id == 1) {
            return $this->error('You do not have sufficient authority', 'You do not have sufficient authority to add a manager, only the manager can add another manager', 403);
        }
        $data = $request->all();
        $data['password'] = bcrypt($request->input('password'));
        $user = User::create($data);
        return $this->success(new UserResource($user), 200, 'Added User successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        try {
            $user = User::find($user);

            return $this->success(new UserResource($user), 200);
        } catch (Exception $ex) {
            return $this->error(['id not founde'], 'The dealer of this id cannot be found', 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        try {
            $user = User::find($user);

            return $this->success(new UserResource($user), 200);
        } catch (Exception $ex) {
            return $this->error(['id not founde'], 'The User of this id cannot be found', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $user)
    {
        $user = User::find($user);
        if ($user) {
            if (auth('sanctum')->user()->role_id > 1 && $request->role_id == 1) {
                return $this->error('You do not have sufficient authority', 'You do not have sufficient authority to add a manager, only the manager can add another manager', 403);
            }
            $user->update($request->input());
            return $this->success(new UserResource($user), 200, 'dealer updated successfully');
        } else {
            return $this->error('id not founde', 'The dealer of this id cannot be found', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $user = User::find($user);
        if ($user) {
            if ($user->id == 1) {
                return $this->error('The account cannot be deleted', 'The original administrator account cannot be deleted', 403);
            }
            if (auth('sanctum')->user()->role_id > 1 && $user->role_id == 1) {
                return $this->error('You do not have sufficient authority', 'You do not have sufficient authority to delete a manager, only the manager can delete another manager', 403);
            }
            $user->delete();
            return $this->responseDelete();
        } else {
            return $this->error('id not founde', 'The User of this id cannot be found', 404);
        }
    }
}
