<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExportInventoryProductRequest;
use App\Http\Resources\ExportInventoryProductResource;
use App\Models\export;
use Illuminate\Http\Request;
use App\Http\Resources\exportResource;
use App\Models\ExportInventoryProduct;
use App\Models\inventoryProduct;
use Exception;

class ExportInventoryProductController extends ApiController
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($export_id)
    {
        try {
            $export = ExportInventoryProduct::where('export_id', $export_id)->get();

            return $this->success(ExportInventoryProductResource::collection($export), 200);
        } catch (Exception $ex) {
            return $this->error(['id not founde'], 'The export of this id cannot be found', 404);
        }
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
    public function update(ExportInventoryProductRequest $request, $export_id)
    {
        $export = export::find($export_id);
        $products_price = 0;
        $total = 0;
        foreach ($request->inventory_products as $inventory_product) {
            $in_p = inventoryProduct::find($inventory_product['id']);
            if ($inventory_product['quantity'] > $in_p->quantity) {
                return 'Unfortunately there is not enough products for Inventory : ' . $inventory_product['id'];
            } else {

                $inventory_product1 = ExportInventoryProduct::where('export_id', $export->id)->where('inventory_product_id', $inventory_product['id'])->first();
                if ($inventory_product1) {
                    $products_price = inventoryProduct::find($inventory_product['id'])->product->seling_price * $inventory_product['quantity'];
                    $inventory_product1->quantity += $inventory_product['quantity'];
                    $inventory_product1->export_product_price += $products_price;
                    $inventory_product1->update();
                    $inx = inventoryProduct::find($inventory_product['id']);
                    $inx->quantity -= $inventory_product['quantity'];
                    $inx->update();
                } else {
                    $products_price = inventoryProduct::find($inventory_product['id'])->product->seling_price * $inventory_product['quantity'];
                    $ExportInventoryProduct = ExportInventoryProduct::create([
                        'export_id' => $export->id,
                        'inventory_product_id' => $inventory_product['id'],
                        'quantity' => $inventory_product['quantity'],
                        'export_product_price' => $products_price,
                    ]);
                    $inx = inventoryProduct::find($inventory_product['id']);
                    $inx->quantity -= $ExportInventoryProduct->quantity;
                    $inx->update();
                }
                $total += $products_price;
            }
        }

        $export->total_price += $total + $export->shipping_charge_price;
        $export->update();

        return $this->success(new exportResource($export), 200, 'Added Export successfully Remove exported products from warehouse');
    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($export_inventory_product_id)
    {
        $export_inventory_product = ExportInventoryProduct::find($export_inventory_product_id);

        if ($export_inventory_product) {
            $inventory_product = inventoryProduct::where('id', $export_inventory_product->inventory_product_id)->first();
            $inventory_product->quantity += $export_inventory_product->quantity;
            $inventory_product->update();
            $export_inventory_product->delete();
            return $this->responseDelete('The invoice has been deleted and the products that were sent back to the warehouse');
        } else {
            return $this->error('id not founde', 'The ImportProduct of this id cannot be found', 404);
        }
    }
}
