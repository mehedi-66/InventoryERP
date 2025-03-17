<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Sales_Details;
use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    // [httpGet]
    public function show()
    {
        $sales = Sales::where('action_type', '!=', 'DELETE')
            ->orderBy('sales_id', 'desc')
            ->get();

        $data = compact('sales');

        return view('sales.saleslist')->with($data);
    }
    // API [httpGet]
    public function getList()
    {
        $sales = Sales::where('action_type', '!=', 'DELETE')
            ->orderBy('sales_name')
            ->get();

        return response()->json($sales);
    }

    // [httpGet]
    public function create()
    {
        $sales = new Sales();
        $sales_details = new Sales_Details();
        $sales->sales_date = Carbon::now()->format('Y-m-d');
        $productList = DB::table('purchases')
            ->join('products', 'purchases.product_id', '=', 'products.product_id')
            ->select('purchases.*', 'products.product_name')
            ->get();
        $sales_details_list = [];
        $url = url('/sales/create');
        $urlProductDetails = '';
        $toptitle = 'Add Sales';
        $data = compact('sales', 'url', 'toptitle', 'urlProductDetails', 'sales_details', 'productList', 'sales_details_list');
        return view('sales.addSales')->with($data);
    }

    // [httpPost]
    public function store(Request $request)
    {
        $request->validate(
            [
                'sales_date' => 'required',
                'invoice_no' => 'required',
                'customer_name' => 'required',
            ]
        );

        $sales = new Sales();

        $sales->invoice_no = $request['invoice_no'];
        $sales->sales_date = $request['sales_date'];
        $sales->customer_name = $request['customer_name'];
        $sales->customer_phone = $request['customer_phone'];
        $sales->total_items = 0;
        $sales->total_amount = 0;
        $sales->action_type = 'INSERT';
        $sales->user_id = 'sys-user';
        $sales->action_date = now();

        $sales->save();

        return redirect('/sales/edit/' . $sales->sales_id);
    }

    // [httpGet]
    public function delete($id)
    {
        $sales = Sales::find($id);

        $sales->action_type = 'DELETE';
        $sales->action_date = now();

        $sales->save();

        return redirect('/sales/list');
    }

    // [httpGet]
    public function edit($id)
    {
        $sales = Sales::find($id);

        if (is_null($sales)) {
            // sales not found
            return redirect('/sales/list');
        } else {
            $sales_details = new Sales_Details();
            $url = url('/sales/update') . "/" . $id;
            $toptitle = 'Add Sales';
            $productList = DB::table('purchases')
                ->join('products', 'purchases.product_id', '=', 'products.product_id')
                ->select('purchases.*', 'products.product_name')
                ->get();
            $sales_details_list = DB::table('sales__details')
                ->join('products', 'sales__details.product_id', '=', 'products.product_id')
                ->where('sales__details.sales_id', '=', $id)
                ->select('sales__details.*', 'products.product_name')
                ->get();
            $urlProductDetails = url('/sales/salesDetailsCreate') . "/" . $id;

            $data = compact('sales', 'url', 'toptitle', 'urlProductDetails', 'sales_details', 'productList', 'sales_details_list');

            return view('sales.addSales')->with($data);
            ;

        }

    }

    // [httpPost]
    public function update($id, Request $request)
    {
        $request->validate(
            [
                'sales_date' => 'required',
                'invoice_no' => 'required',
                'customer_name' => 'required',
            ]
        );

        $sales = Sales::find($id);

        //$sales->registration_date = $request['registration_date'];  
        $sales->invoice_no = $request['invoice_no'];
        $sales->sales_date = $request['sales_date'];
        $sales->customer_name = $request['customer_name'];
        $sales->customer_phone = $request['customer_phone'];
        // $sales->total_items     = $request['total_items'];  
        // $sales->total_amount    = $request['total_amount'];  
        $sales->action_type = 'UPDATE';
        $sales->user_id = 'sys-user';
        $sales->action_date = now();

        $sales->save();

        return redirect('/sales/edit/' . $id);

    }

    public function salesDetailsCreate($sales_id, Request $request)
    {

        $sales = Sales::find($sales_id);

        $sales_details = new Sales_Details();

        $sales_details->sales_id = $sales->sales_id;
        $sales_details->product_id = $request['product_id'];
        $sales_details->invoice_no = $sales->invoice_no;
        $sales_details->product_unit_price = $request['product_unit_price'];
        $sales_details->product_quantity = $request['product_quantity'];
        $sales_details->sales_date = $sales->sales_date;

        $sales_details->action_type = 'INSERT';        // Optional: $request['action_type']
        $sales_details->user_id = 'sys-user';      // Optional: auth()->user()->id
        $sales_details->action_date = now();

        $sales_details->save();



        $sales->total_items = $sales->total_items + 1;

        $sales->total_amount = $sales->total_amount + ($request['product_unit_price'] * $request['product_quantity']);

        $sales->save();

        return redirect('/sales/edit/' . $sales_id);
    }

    public function allSalesMonthly($currDate)
    {
        $currDate = Carbon::parse($currDate);

        $FormDate = $currDate->copy()->startOfMonth()->format('Y-m-d');
        $ToDate = $currDate->copy()->endOfMonth()->format('Y-m-d');

        $salesInvoiceList = DB::table('sales')
            // ->join('invoices', 'sales.invoice_id', '=', 'invoices.invoice_id')
            ->whereBetween('sales.sales_date', [$FormDate, $ToDate])
            //->where('invoices.action_type', '!=', 'DELETE')
            ->select('sales.*')
            ->orderBy('sales.sales_date', 'ASC')
            ->get();

        $data = compact('FormDate', 'ToDate', 'salesInvoiceList');

        return view('salesReport.monthlyReport')->with($data);
    }
    public function byProducthMontlySales($currDate, $product_id)
    {
        $currDate = Carbon::parse($currDate);

        $FormDate = $currDate->copy()->startOfMonth()->format('Y-m-d');
        $ToDate = $currDate->copy()->endOfMonth()->format('Y-m-d');

        $productList = DB::table('purchases')
            ->join('products', 'purchases.product_id', '=', 'products.product_id')
            ->select('purchases.*', 'products.product_name')
            ->get();

        $salesInvoiceList = DB::table('sales__details')
             ->join('products', 'sales__details.product_id', '=', 'products.product_id')
            ->whereBetween('sales__details.sales_date', [$FormDate, $ToDate])
            ->where('sales__details.product_id', '=', $product_id)
            //->where('invoices.action_type', '!=', 'DELETE')
            ->select('sales__details.*', 'products.product_name')
            ->orderBy('sales__details.sales_date', 'ASC')
            ->get();

        $data = compact('FormDate', 'ToDate', 'salesInvoiceList', 'productList', 'product_id');

        return view('salesReport.monthlyByProductReport')->with($data);
    }
}
