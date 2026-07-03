<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Export;
use App\Models\Storage;
use App\Models\Operation;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $monthlyexported = Export::selectRaw('MONTH(created_at) as month, count(*) as order_count')
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('order_count', 'month')
        ->toArray();

    // إذا كانت البيانات غير كاملة (مثلاً شهور ناقصة) نملأهم بـ 0
    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    $orderCounts = array_replace(array_fill(0, 12, 0), $monthlyexported); 

    $the_exported = Export::count();
    $the_storaged = Storage::count();


    $sourceData = [
        'Issued ' => $the_exported,
        'storaged' => $the_storaged,
    ];

        return view('home' ,compact(var_name: ['sourceData' , 'months' , 'orderCounts' , 'monthlyexported']));
    }
}
