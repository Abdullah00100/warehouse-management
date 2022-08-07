<?php

namespace App\Http\Controllers;

use App\Http\Requests\DealerRequest;
use App\Models\Dealer;
use Illuminate\Http\Request;
use App\Http\Resources\DealerResource;
use Exception;

class DealerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  $this->success(DealerResource::collection(Dealer::all()), 200);
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
    public function store(DealerRequest $request)
    {
        $department = Dealer::create($request->input());
        return $this->success(new DealerResource($department), 200, 'Added Dealer successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($dealer)
    {
        try {
            $dealer = Dealer::find($dealer);

            return $this->success(new DealerResource($dealer), 200);
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
    public function edit($dealer)
    {
        try {
            $dealer = Dealer::find($dealer);

            return $this->success(new DealerResource($dealer), 200);
        } catch (Exception $ex) {
            return $this->error(['id not founde'], 'The Dealer of this id cannot be found', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DealerRequest $request, $dealer)
    {
        $dealer = Dealer::find($dealer);
        if ($dealer) {

            $dealer->update($request->input());
            return $this->success(new DealerResource($dealer), 200, 'dealer updated successfully');
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
    public function destroy($dealer)
    {
        $dealer = Dealer::find($dealer);
        if ($dealer) {
            $dealer->delete();
            return $this->responseDelete();
        } else {
            return $this->error('id not founde', 'The Dealer of this id cannot be found', 404);
        }
    }
}
