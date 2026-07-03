<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Storage;
use App\Models\Dep;
use App\Models\Export;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;   

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $index = Product::paginate(10);

        return view('pord.index' ,compact('index'));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validate([
            'product' => 'required|unique:products',
            'code' => 'unique:products',

        ]);

        Product::create([

            "product"=> $request->product,
            "code"=> $request->code ?? 'NO',

          ]);

        return redirect()->route( route: 'prod.index');
    }




    /**
     * Display the specified resource.
     */
// في ProductController
public function edit()
{
    $products = Storage::select('id', 'product', 'code')->get(); // تأكد من وجود حقل code
    if ($products->isEmpty()) {
        return response()->json(['message' => 'No products found'], 404);
    }
    return response()->json(['products' => $products], 200);
}

// في DepsController

    /**
     * Show the form for editing the specified resource.
     */   
// Controller للمنتجات
// Controller for Products
public function editProduct($id)
{
    $products = Storage::all(); // Get all products

    if ($products->isEmpty()) {
        return response()->json(['message' => 'Products not found'], 404);
    }

    return response()->json(['products' => $products], 200);
}



    
    
    
    

    
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $id=$request->id;

        $product_up = Product::find(id: $id);

        $product_up->product = $request->input(key: 'prod_up');

        $product_up->code = $request->input(key: 'code_up');

        $product_up->update();

        return redirect()->route( route: 'prod.index');

    }

    public function getProductCode($id)
{
    $product = Product::find($id); // ابحث عن المنتج بناءً على الـ ID

    if ($product) {
        return response()->json([
            'success' => true,
            'code' => $product->code,
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Product not found',
    ]);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StoreProductRequest $request)
    {
        $id=$request->delete_id;
 
        Product::destroy($id);

        return redirect()->route( route: 'prod.index');

    }
}
