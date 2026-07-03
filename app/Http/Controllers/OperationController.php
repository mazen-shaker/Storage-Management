<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use App\Models\Product;
use App\Models\Storage;
use App\Http\Requests\UpdateOperationRequest;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    public function index()
    {

        $index = Operation::paginate(2);
        return view('reports.operations' ,compact(var_name: 'index'));
    }

    public function Search_operation(UpdateOperationRequest $request)
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
          //$operation = Operation::with(['product', 'dep', 'export'])->where('product_id', $id)->get();
            return response()->json($operation);
        }
    }
}