<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInventoryRequest;
use App\Http\Resources\StoreInventoryResource;
use App\Http\Resources\StoreInventoryResource1;
use Carbon\Carbon;
use App\Models\export;
use App\Models\Import;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class StoreInventoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function findImports(StoreInventoryRequest $request)
    {
        $dateS = new Carbon($request->from_date);
        $dateE = new Carbon($request->to_date);

        $imports = Import::whereBetween('created_at', [$dateS->format('Y-m-d')." 00:00:00", $dateE->format('Y-m-d')." 23:59:59"])->get();

        $total = 0;
        $count = 0;
        foreach($imports as $import){
            $total += $import->total_price;
            $count += 1;
        }

        return  $this->success(new StoreInventoryResource($imports, $total, $count), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function findExports(StoreInventoryRequest $request)
    {
        $dateS = new Carbon($request->from_date);
        $dateE = new Carbon($request->to_date);

        $exports = export::whereBetween('created_at', [$dateS->format('Y-m-d')." 00:00:00", $dateE->format('Y-m-d')." 23:59:59"])->get();
        $total = 0;
        $count = 0;
        foreach($exports as $export){
            $total += $export->total_price;
            $count+=1;
        }

        return  $this->success(new StoreInventoryResource1($exports, $total, $count), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
