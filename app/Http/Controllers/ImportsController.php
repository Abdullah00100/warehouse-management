<?php

namespace App\Http\Controllers;

use App\Http\Requests\importProductRequest;
use Exception;
use App\Models\Import;
use Illuminate\Http\Request;
use App\Models\importProduct;
use function PHPSTORM_META\map;
use App\Models\inventoryProduct;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\ImportsRequest;
use App\Http\Requests\UpdateImportsRequest;
use App\Http\Resources\ImportProductResource;
use App\Http\Resources\ImportsResource;
use App\Models\Product;

class ImportsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  $this->success(ImportsResource::collection(Import::all()), 200);
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
    public function store(ImportsRequest $request)
    {
        $import = Import::create([
            'bill_number' => $request->bill_number,
            'shipping_charge_price' => $request->shipping_charge_price,
            'dealer_id' => $request->dealer_id,
        ]);

        $productPriceTotal = 0;

        foreach ($request->products as $product) {


            $inventory_product = inventoryProduct::where('product_id', $product['id'])->first();

            // if it already existes just pluse the quantity number than we have added to the old one
            if ($inventory_product) {
                $inventory_product->quantity += $product['quantity'];
                $inventory_product->update();
            } else {
                inventoryProduct::create([
                    'product_id' => $product['id'],
                    'quantity' => $product['quantity']
                ]);
            }

            $ip = importProduct::where('import_id', $import->id)->where('product_id', $product['id'])->first();
            if ($ip) {
                $ip->quantity += $product['quantity'];
                $ip->update();
                $productPriceTotal += $ip->product->purchasing_price * $product['quantity'];
            } else {
                $importProduct = importProduct::create([
                    'import_id' => $import->id,
                    'product_id' => $product['id'],
                    'quantity' => $product['quantity'],
                ]);
                $productPriceTotal += $importProduct->product->purchasing_price * $importProduct->quantity;
            }
        }

        $import->total_price = $productPriceTotal + $import->shipping_charge_price;
        $import->update();
        return $this->success(new ImportsResource($import), 200, 'Added import successfully and the products mentioned have been added to the inventory');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($import)
    {
        try {
            $import = Import::find($import);

            return $this->success(new ImportsResource($import), 200);
        } catch (Exception $ex) {
            return $this->error(['id not founde'], 'The Import of this id cannot be found', 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($import)
    {
        try {
            $import = Import::find($import);

            return $this->success(new ImportsResource($import), 200);
        } catch (Exception $ex) {
            return $this->error(['id not founde'], 'The Import of this id cannot be found', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImportsRequest $request, $import)
    {
        $import = Import::find($import);
        if ($import) {
            $data = $request->all();
            $old_shipping_charge_price = $import->shipping_charge_price;
            $data['total_price'] = $import->total_price - $old_shipping_charge_price + $request->shipping_charge_price;
            $import->update($data);
            return $this->success(new ImportsResource($import), 200, 'import updated successfully');
        } else {
            return $this->error('id not founde', 'The import of this id cannot be found', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($import)
    {
        $import = Import::find($import);
        if ($import) {
            $importProducts = importProduct::where('import_id', $import->id)->get();
            foreach ($importProducts as $importProduct) {
                $inventory_product = inventoryProduct::where('product_id', $importProduct->product_id)->first();
                $inventory_product->quantity -= $importProduct->quantity;
                $inventory_product->update();
            }
            $import->delete();
            return $this->responseDelete('The invoice and the products added to the inventory mentioned in the invoice have been deleted');
        } else {
            return $this->error('id not founde', 'The Import of this id cannot be found', 404);
        }
    }
}
