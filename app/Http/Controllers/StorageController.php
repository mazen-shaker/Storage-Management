<?php

namespace App\Http\Controllers;

use App\Models\storage;
use App\Models\Product;
use App\Models\Dep;
use App\Http\Requests\StorestorageRequest;
use App\Http\Requests\UpdatestorageRequest;
use Illuminate\Support\Facades\DB;


class StorageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Storage::where('amount', 0)->value('id');

        $emptychick = Storage::where('amount', 0)->get();
 
        if($emptychick){
 
         storage::destroy($id);
 
        }

        $index = storage::paginate(10);

        return view('storage.index' ,compact('index'));
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorestorageRequest $request)
    {


        storage::create([

            "product"=> $request->product,
            "code"=> $request->code,
            "amount"=> $request->amount,


          ]);
        
          return redirect()->route( route: 'stor.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(storage $storage)
    {
        //
    }


    public function edit()
    {
        $products = Storage::select('id', 'product', 'code')->get(); // تأكد من وجود حقل code
        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found'], 404);
        }
        return response()->json(['products' => $products], 200);
    }
    
    

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatestorageRequest $request, storage $storage)
    {
        $id=$request->id;

        $storage_up = storage::find(id: $id);

        $storage_up->product = $request->input(key: 'prod_up');
        $storage_up->code = $request->input(key: 'code_up');
        $storage_up->amount = $request->input(key: 'prod_amount_up');

        $storage_up->update();

        return redirect()->route( route: 'stor.index');
    }


    public function reports_index()
    {

        $index = Storage::paginate(10);
        return view('reports.storage' ,compact(var_name: 'index'));
    }

    public function reports_Search(UpdatestorageRequest $request)
    {
        $rdio = $request->rdio;

        if ($rdio == 1) {
            if ($request->start_at == '' && $request->end_at == '') {
                return response()->json([]);
            } else {
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $operation = Storage::whereBetween('created_at', [$start_at, $end_at])->get();
                return response()->json($operation);
            }
        } else {
            $operation = Storage::where('code', $request->code)->get();
              return response()->json($operation);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StorestorageRequest $request)
    {
        $id=$request->delete_id;
 
        storage::destroy($id);

        return redirect()->route( route: 'stor.index');
    
    }

    public function destroyAll(StorestorageRequest $request)
    {
        // التحقق من وجود عناصر محددة
        if ($request->has('items')) {
            // حذف العناصر المحددة
            storage::whereIn('id', $request->items)->delete();
            
            // إعادة توجيه مع رسالة نجاح
            return redirect()->route( route: 'stor.index');
        }
        
        // إعادة توجيه مع رسالة خطأ في حالة عدم تحديد أي عنصر
        return redirect()->route( route: 'stor.index');
        // إعادة توجيه مع رسالة خطأ في حالة عدم تحديد أي عنصر
       
    }
}
