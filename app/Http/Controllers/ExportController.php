<?php

namespace App\Http\Controllers;
use App\Models\Dep;
use App\Models\Product;
use App\Models\Export;
use App\Models\Storage;
use App\Models\Operation;
use App\Http\Requests\StoreExportRequest;
use App\Http\Requests\UpdateExportRequest;

class ExportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $id = Export::where('amount', 0)->value('id');

       $emptychick = Export::where('amount', 0)->get();

       if($emptychick){

        Export::destroy($id);

       }

        $index = Export::paginate(10);
        $products = Storage::all();
        $departments = Dep::all();

        return view('export.index' ,compact(['index' , 'products' , 'departments']));

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
     *     session()->flash('notification', 'This item is unavailable');

     */
    public function store(StoreExportRequest $request)
    {
    
      $product = $request->product;

      $requstedAmount =$request->amount;

      $storedAmount = Storage::where('id' ,$product)->value('amount');

      $id = Storage::where('id' ,$product)->value('id');

      if($requstedAmount > $storedAmount){

        session()->flash('notification', 'Insufficient quantity of this item');

        return redirect()->route('exp.index');

      }elseif($requstedAmount < $storedAmount){

       // $finalAmount =  $storedAmount - $requstedAmount;

        Export::create([

            "storage_id"=> $request->product,
            "dep_id"=> $request->dep,
            "amount"=> $request->amount,

          ]);

          $storage_up = Storage::find(id: $id);

          $storage_up->amount = $storedAmount - $requstedAmount;
  
          $storage_up->update();

          return redirect()->route('exp.index');
        
      }

    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(Export $export)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Export $export)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    
     public function update(UpdateExportRequest $request, Export $export)
     {
         $exportedRow = Export::findOrFail($request->id);
     
         $currentStorage = Storage::findOrFail($exportedRow->storage_id);
     
         $newStorage = Storage::findOrFail($request->prod_up);
     
         $requestedAmount = $request->prod_amount_up;
         $exportedAmount = $exportedRow->amount;
     
         if ($currentStorage->id != $newStorage->id) {
             $currentStorage->amount += $exportedAmount;
             $currentStorage->save();
     
             if ($newStorage->amount < $requestedAmount) {
                 session()->flash('notification', 'Insufficient quantity of this item');
                 return redirect()->route('exp.index');
             }
     
             $newStorage->amount -= $requestedAmount;
             $newStorage->save();
     
             $exportedRow->storage_id = $newStorage->id;
             $exportedRow->amount = $requestedAmount;
             $exportedRow->dep_id = $request->dep_up;
             $exportedRow->save();
     
             return redirect()->route('exp.index');
         }
     
         if ($requestedAmount == $exportedAmount) {
             $exportedRow->dep_id = $request->dep_up;
             $exportedRow->save();
         } else {
             $difference = $requestedAmount - $exportedAmount;
     
             if ($difference > 0 && $currentStorage->amount < $difference) {
                 session()->flash('notification', 'Insufficient quantity of this item');
                 return redirect()->route('exp.index');
             }
     
             $currentStorage->amount -= $difference;
             $currentStorage->save();
     
             $exportedRow->amount = $requestedAmount;
             $exportedRow->dep_id = $request->dep_up;
             $exportedRow->save();
         }
     
         return redirect()->route('exp.index');
}


public function reports_index()
{

    $index = Export::paginate(10);
    return view('reports.export' ,compact(var_name: 'index'));
}



public function reports_Search(UpdateExportRequest $request)
{
    $rdio = $request->rdio;

    if ($rdio == 1) {
        if ($request->start_at == '' && $request->end_at == '') {
            return response()->json([]);
        } else {
            $start_at = date($request->start_at);
            $end_at = date($request->end_at);
            $operation = Export::with(['storage', 'dep'])->whereBetween('created_at', [$start_at, $end_at])->get();
            return response()->json($operation);
        }
    } else {
      $id = Storage::where('code', $request->code)->value('id');
      $operation = Export::with(['storage', 'dep'])->where('storage_id', $id)->get();
        return response()->json($operation);
    }
}
     
     /**
      * Redirect with a notification message.
      */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UpdateExportRequest $request)
    {
        $id = $request->product_id;
    
        Export::where('storage_id', $id)->delete();
    
       
        return redirect()->route('exp.index');
    }

    public function destroyAll(StoreExportRequest $request)
    {
        // التحقق من وجود عناصر محددة
        if ($request->has('items')) {
            // حذف العناصر المحددة
            Export::whereIn('id', $request->items)->delete();
            
            // إعادة توجيه مع رسالة نجاح
            return redirect()->route('exp.index');
        }
        
        // إعادة توجيه مع رسالة خطأ في حالة عدم تحديد أي عنصر
        return redirect()->route('exp.index');
        // إعادة توجيه مع رسالة خطأ في حالة عدم تحديد أي عنصر
       
    }
}
