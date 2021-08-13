<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\BillingExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }

    public function dashboard()
    {
        return view('backend.dashboard');
    }

    public function orders(){
        return view('backend.orders.orders', [
            'orders' => Order::latest()->simplepaginate(),
            'total' => Order::all()->count(),
        ]);
    }

    public function ordersView($id)
    {
        return view('backend.orders.order-details',[
            'orders' => Order::where('id', $id)->first(),
        ]);
    }

    public function orderSearch(Request $request){
        $request->validate([
            'start' => ['required'],
            'end' => ['required'],
        ]);
        $startDate = $request->start;
        $endDate = $request->end;
        $orders = Order::whereBetween('created_at', [$startDate, $endDate])->simplepaginate();
        return view('backend.orders.orders', [
            'orders' =>$orders,
            'total' => $orders->count(),
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    }

    public function downloadFile(Request $request){
        $request->validate([
            'start' => ['required'],
            'end' => ['required'],
        ]);
        $startDate = $request->start;
        $endDate = $request->end;
        if($request->excel){
            return Excel::download(new BillingExport($startDate, $endDate), 'billings.xlsx');
        }else{
            $billings = Order::whereBetween('created_at',[ $startDate,  $endDate] )->get();
            $pdf = PDF::loadView('exports.billings', compact('billings'));
            return $pdf->download(Str::random(3).'.pdf');
        }
    }
}
