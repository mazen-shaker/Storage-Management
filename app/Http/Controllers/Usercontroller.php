<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Prev;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class Usercontroller extends Controller
{

    public function index(){

       $index = User::where('prev_id' , '2')->paginate(10);
       $prevs = Prev::all();
       $prevs_edit = Prev::all();

       return view('users.index' , compact (['index' , 'prevs' , 'prevs_edit']));

    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.unique' => 'this name hase already taken',
            'email.unique' => 'this email addres has already taken',
            'password.confirmed' => 'please confirm the password correctly',
        ]);
    
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'prev_id' => $request->prev,
        ]);
    
        return redirect()->route('users.index')->with('success', 'the user is added sucssefly');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        // التحقق من البيانات
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'name.unique' => 'this name hase already taken',
            'email.unique' => 'this email addres has already taken',
            'password.confirmed' => 'please confirm the password correctly',
        ]);
    
        // تحديث البيانات
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? Hash::make($validated['password']) : $user->password,
        ]);
    
        // إعادة التوجيه مع رسالة نجاح
        return redirect()->back()->with('success', 'the user is updated sucssefly');
    }



    public function changePrev(Request $request)
    {

        $id = $request->prev_id;

        $check_prev = User::where('id' , $id)->value('prev_id');

        $user = User::findOrFail($id);


        if($check_prev === 2){
        $user->update([
            'prev_id' => 1,
 
        ]);

        return redirect()->route('users.index')->with('success', 'the user prev is updated sucssefly');

        }elseif($check_prev === 1){

            $user->update([
                'prev_id' => 2,
     
            ]);

            return redirect()->route('users.index')->with('success', 'the user prev is updated sucssefly');
        }
    

    }

    public function destroy(Request $request)
    {

        $id = $request->delete_id;

        User::destroy($id);

        return redirect()->route('users.index')->with('success', 'the user is deleted sucssefly');

    }


    public function destroyAll(Request $request)
    {
        // التحقق من وجود عناصر محددة
        if ($request->has('items')) {
            // حذف العناصر المحددة
            User::whereIn('id', $request->items)->delete();
            
            // إعادة توجيه مع رسالة نجاح
            return redirect()->route('users.index');
        }
        
        // إعادة توجيه مع رسالة خطأ في حالة عدم تحديد أي عنصر
        return redirect()->route('users.index');
        // إعادة توجيه مع رسالة خطأ في حالة عدم تحديد أي عنصر
       
    }



}
