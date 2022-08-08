<?php

namespace App\Http\Controllers;

use App\Http\Requests\exportRequest;
use App\Http\Requests\UpdateExportRequest;
use App\Http\Resources\exportResource;
use App\Models\export;
use App\Models\ExportInventoryProduct;
use App\Models\inventoryProduct;
use Illuminate\Http\Request;
use Exception;

class exportController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  $this->success(exportResource::collection(export::all()), 200);
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
    public function store(exportRequest $request)
    {
        $export = Export::create([
            'bill_number' => $request->bill_number,
            'shipping_charge_price' => $request->shipping_charge_price,
            'dealer_id' => $request->dealer_id,
            'has_received' => $request->has_received,
            'total_price' => null,

        ]);
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

        $export->total_price = $total + $export->shipping_charge_price;
        $export->update();

        return $this->success(new exportResource($export), 200, 'Added Export successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($export)
    {
        try {
            $export = Export::find($export);

            return $this->success(new exportResource($export), 200);
        } catch (Exception $ex) {
            return $this->error(['id not founde'], 'The Export of this id cannot be found', 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($export)
    {
        try {
            $export = Export::find($export);

            return $this->success(new exportResource($export), 200);
        } catch (Exception $ex) {
            return $this->error(['id not founde'], 'The Export of this id cannot be found', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExportRequest $request, $export)
    {
        $export = export::find($export);
        if ($export) {
            $data = $request->all();
            $old_shipping_charge_price = $export->shipping_charge_price;
            $data['total_price'] = $export->total_price - $old_shipping_charge_price + $request->shipping_charge_price;
            $export->update($data);
            return $this->success(new exportResource($export), 200, 'Export updated successfully');
        } else {
            return $this->error('id not founde', 'The Export of this id cannot be found', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($export)
    {
        $export = Export::find($export);
        if ($export) {
            $ExportInventoryProducts = ExportInventoryProduct::where('export_id', $export->id)->get();
            foreach ($ExportInventoryProducts as $ExportInventoryProduct) {
                $inventory_product = inventoryProduct::where('id', $ExportInventoryProduct->inventory_product_id)->first();
                $inventory_product->quantity += $ExportInventoryProduct->quantity;
                $inventory_product->update();
            }
            $export->delete();
            return $this->responseDelete('The invoice has been deleted and the products that were sent back to the warehouse');
        } else {
            return $this->error('id not founde', 'The Export of this id cannot be found', 404);
        }
    }
}
