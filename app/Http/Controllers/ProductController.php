<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;

class ProductController extends Controller
{

    // [httpGet]
    public function show()
    {
        $products = Product::where('action_type', '!=', 'DELETE')
                            ->orderBy('product_id', 'desc')
                            ->get();
        
        $data = compact('products');

        return view('product.productlist')->with($data);
    }
    // API [httpGet]
    public function getList()
    {
        $products = Product::where('action_type', '!=', 'DELETE')
                            ->orderBy('product_name')
                            ->get();
        
        return response()->json($products);
    }

    // [httpGet]
    public function create()
    {
        $product = new Product(); 
        $product->registration_date = Carbon::now()->format('Y-m-d');

        $url = url('/product/create');
        $toptitle = 'Add Product';
        $data = compact('product','url', 'toptitle');
        return view('product.addproduct')->with($data);
    }

    // [httpPost]
    public function store(Request $request)
    {
        $request->validate(
            [
                'registration_date' => 'required',
                'product_name' => 'required'
            ]
        );

        $product = new Product();

        $product->registration_date = $request['registration_date'];  
        $product->product_name = $request['product_name'];  
        $product->product_code = $request['product_code'] ; 
        $product->product_description = $request['product_description'];  
        $product->product_category = $request['product_category'] ; 
        $product->product_image = $request['product_image'];
        $product->action_type = 'INSERT';
        $product->user_id = 'sys-user';
        $product->action_date = now();

        $product->save();

        return redirect('/product/list');
    }

    // [httpGet]
    public function delete($id)
    {
        $product = Product::find($id);
        
        $product->action_type = 'DELETE';
        $product->action_date = now();

        $product->save();

        return redirect('/product/list');
    }

    // [httpGet]
    public function edit($id)
    {
        $product = Product::find($id);

        if(is_null($product))
        {
            // product not found
            return redirect('/product/list');
        }
        else{
            $url = url('/product/update') ."/". $id;
            $toptitle = 'Edit Product';
         
            $data = compact('product','url', 'toptitle');
      
            return view('product.addproduct')->with($data);;
         
        }

    }

    // [httpPost]
    public function update($id, Request $request)
    {
        $request->validate(
            [
                'registration_date' => 'required',
                'product_name' => 'required'
            ]
        );

        $product = Product::find($id);

        //$product->registration_date = $request['registration_date'];  
        $product->product_name = $request['product_name'];  
        $product->product_code = $request['product_code'] ; 
        $product->product_description = $request['product_description'];  
        $product->product_category = $request['product_category'] ; 
        $product->product_image = $request['product_image'];
        $product->action_type = 'UPDATE';
        $product->user_id = 'sys-user';
        $product->action_date = now();

        $product->save();

        return redirect('/product/list');

    }
}
