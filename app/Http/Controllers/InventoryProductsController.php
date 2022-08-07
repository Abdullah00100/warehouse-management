<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\inventoryProduct;
use App\Http\Resources\DepartmentRecource;
use App\Http\Requests\InventoryProductsRequest;
use App\Http\Resources\InventoryProductsResource;
use App\Models\Product;
use Database\Seeders\InventoryProductSeeder;

class InventoryProductsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  $this->success(InventoryProductsResource::collection(inventoryProduct::all()), 200);
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
    public function store(InventoryProductsRequest $request)
    {
        $inventoryproduct = inventoryProduct::where('product_id', $request->product_id)->first();
        if ($inventoryproduct) {
            $inventoryproduct->quantity += $request->quantity;
            $inventoryproduct->update();
            $message = 'Updated InventoryProduct successfully';
        } else {
            $inventoryproduct = InventoryProduct::create($request->all());
        }
        return $this->success(new InventoryProductsResource($inventoryproduct), 200, 'added product saccessfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($inventory_products)
    {

        try {
            $inventory_products = InventoryProduct::find($inventory_products);

            return $this->success(new InventoryProductsResource($inventory_products), 200);
        } catch (Exception $ex) {
            return $this->error(['id not founde'], 'The inventory_products of this id cannot be found', 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($inventory_products)
    {

        try {
            $inventory_products = InventoryProduct::find($inventory_products);

            return $this->success(new InventoryProductsResource($inventory_products), 200);
        } catch (Exception $ex) {
            return $this->error(['id not founde'], 'The inventory_products of this id cannot be found', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InventoryProductsRequest $request, $inventory_products)
    {
        $inventory_products = InventoryProduct::find($inventory_products);
        if ($inventory_products) {
            $inventory_products->update($request->all());
            return $this->success(new InventoryProductsResource($inventory_products), 200, 'Department updated successfully');
        } else {
            return $this->error('id not founde', 'The InventoryProduct of this id cannot be found', 404);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($inventory_products)
    {
        $inventory_products = InventoryProduct::find($inventory_products);
        if ($inventory_products) {
            $inventory_products->delete();
            return $this->responseDelete();
        } else {
            return $this->error('id not founde', 'The InventoryProduct of this id cannot be found', 404);
        }
    }
}
