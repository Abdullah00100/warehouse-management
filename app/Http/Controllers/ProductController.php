<?php

namespace App\Http\Controllers;

use Exception;
use Faker\Core\File;
use App\Models\Product;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\ApiController;
use App\Http\Resources\ProductRecource;
use Illuminate\Support\Facades\Storage;


class ProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  $this->success(ProductRecource::collection(Product::all()), 200);
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
    public function store(ProductRequest $request)
    {

        if ($request->hasFile('image_path')) {
            $path = $request->file('image_path')->store('public/products');
        }
        $data = $request->input();
        $data['image_path'] = $path;
        $product = Product::create($data);
        return $this->success(new ProductRecource($product), 200, 'Added Product successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
        try {
            $product = Product::find($product);
            return $this->success(new ProductRecource($product), 200);
        } catch (Exception $ex) {
            return $this->error(['id not founde'], 'The Product of this id cannot be found', 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        try {
            $product = Product::find($product);
            return $this->success(new ProductRecource($product), 200);
        } catch (Exception $ex) {
            return $this->error(['id not founde'], 'The Product of this id cannot be found', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request,  $product)
    {
        $product = Product::find($product);
        if ($product) {
            if ($request->hasFile('image_path')) {
                if (Storage::exists($product->image_path)) {
                    Storage::delete($product->image_path);
                }
                $path = $request->file('image_path')->store('public/products');
            }
            $data = $request->input();
            $data['image_path'] = $path;
            $product->update($data);
            return $this->success(new ProductRecource($product), 200, 'product updated successfully');
        } else {
            return $this->error('id not founde', 'The product of this id cannot be found', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        $product = Product::find($product);
        if ($product) {
            if (Storage::exists($product->image_path)) {
                Storage::delete($product->image_path);
            }
            $product->delete();
            return $this->responseDelete();
        } else {
            return $this->error('id not founde', 'The product of this id cannot be found', 404);
        }
    }
}
