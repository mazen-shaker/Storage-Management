<?php

namespace App\Http\Controllers;

use App\Models\Dep;
use App\Http\Requests\StoreDeptRequest;
use App\Http\Requests\UpdateDeptRequest;

class DepsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $index = Dep::paginate(10);
    
        return view('deps.index', compact('index' ));
    }


    public function search(StoreDeptRequest $request)
    {
        $query = $request->input('query');
    
        // إذا كانت خانة البحث فارغة
        if (empty($query)) {
            return response()->json([
                'countries' => Dep::paginate(3), // البيانات الأساسية
            ]);
        }
    
        // البحث في الجدول
        $countries = Dep::where('name', 'LIKE', "%{$query}%")->paginate(10);
    
        return response()->json([
            'countries' => $countries,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreDeptRequest $request)
    {
   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeptRequest $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:deps',
        ]);

        Dep::create([

            "name"=> $request->name,
          ]);

        return redirect()->route( route: 'deps.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dep $dep)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $departments = Dep::select('id', 'name')->get();
        if ($departments->isEmpty()) {
            return response()->json(['message' => 'No departments found'], 404);
        }
        return response()->json(['departments' => $departments], 200);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeptRequest $request, Dep $dep)
    {
        $id=$request->id;

        $dep_up = Dep::find(id: $id);

        $dep_up->name = $request->input(key: 'dep_up');

        $dep_up->update();

        return redirect()->route( route: 'deps.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StoreDeptRequest $request)
    {
        $id=$request->delete_id;
 
        Dep::destroy($id);

        return redirect()->route( route: 'deps.index');
    }


    public function destroyAll(StoreDeptRequest $request)
    {
        if ($request->has('items')) {
            
            Dep::whereIn('id', $request->items)->delete();
            
            // إعادة توجيه مع رسالة نجاح
            return redirect()->back()->with('success', 'Selected items have been deleted successfully.');
        }
        
        // إعادة توجيه مع رسالة خطأ في حالة عدم تحديد أي عنصر
        return redirect()->back()->with('error', 'No items selected.');
    }
}
