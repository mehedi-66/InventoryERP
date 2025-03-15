<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class PurchaseController extends Controller
{
    // [httpGet]
    public function show()
    {
        $Purchases = DB::table('purchases')
            ->join('products', 'purchases.product_id', '=', 'products.product_id')
            ->select('purchases.*', 'products.product_name')
            ->get();

        $data = compact('Purchases');

        return view('purchase.purchaselist')->with($data);
    }
    // API [httpGet]
    public function getList()
    {
        $purchases = Purchase::where('action_type', '!=', 'DELETE')
            ->orderBy('product_name')
            ->get();

        return response()->json($purchases);
    }

    // [httpGet]
    public function create()
    {
        $purchase = new Purchase();
        $purchase->registration_date = Carbon::now()->format('Y-m-d');
        $productList = Product::all();

        $url = url('/purchase/create');
        $toptitle = 'Add Purchase';
        $data = compact('purchase', 'url', 'toptitle', 'productList');
        return view('purchase.addPurchase')->with($data);
    }

    // [httpPost]
    public function store(Request $request)
    {
        $request->validate(
            [
                'registration_date' => 'required',
                'product_id' => 'required',
                'invoice_no' => 'required',
                'purchases_date' => 'required',
                'purchases_buy_amount' => 'required',
                'purchases_sales_amount' => 'required',
                'purchases_quantity' => 'required',
            ]
        );
        $prevous_purchase = Purchase::where('product_id', '=', $request['product_id'])->first();
        $purchase = new Purchase();
        if ($prevous_purchase) {
            $purchase = $prevous_purchase;
        }

        $purchase->product_id = $request['product_id'];
        $purchase->invoice_no = $request['invoice_no'];
        $purchase->purchases_date = $request['purchases_date'];
        $purchase->purchases_buy_amount = $request['purchases_buy_amount'];
        $purchase->purchases_sales_amount = $request['purchases_sales_amount'];
        $purchase->purchases_quantity = $request['purchases_quantity'];
        $purchase->purchases_previous_quantity = $purchase->purchases_current_quantity;
        $purchase->purchases_current_quantity = $purchase->purchases_current_quantity + $request['purchases_quantity'];
        ;
        $purchase->supplier_name = $request['supplier_name'];
        $purchase->payment_method = $request['payment_method'];
        $purchase->remarks = $request['remarks'];
        $purchase->action_type = 'INSERT';
        $purchase->user_id = 'sys-user';
        $purchase->action_date = now();

        $purchase->save();

        return redirect('/purchase/list');
    }

    // [httpGet]
    public function delete($id)
    {
        $purchase = Purchase::find($id);

        $purchase->action_type = 'DELETE';
        $purchase->action_date = now();

        $purchase->save();

        return redirect('/purchase/list');
    }

    // [httpGet]
    public function edit($id)
    {
        $purchase = Purchase::find($id);

        if (is_null($purchase)) {
            // purchase not found
            return redirect('/purchase/list');
        } else {
            $url = url('/purchase/update') . "/" . $id;
            $toptitle = 'View Purchase';
            $productList = Product::all();

            $data = compact('purchase', 'url', 'toptitle','productList');

            return view('purchase.addPurchase')->with($data);
            ;

        }

    }

    // [httpPost]
    public function update($id, Request $request)
    {
        $request->validate(
            [
                'registration_date' => 'required',
                'product_id' => 'required',
                'invoice_no' => 'required',
                'purchases_date' => 'required',
                'purchases_buy_amount' => 'required',
                'purchases_sales_amount' => 'required',
                'purchases_quantity' => 'required',
            ]
        );
        $prevous_purchase = Purchase::where('product_id', '=', $id)->first();
        $purchase = new Purchase();
        if ($prevous_purchase) {
            $purchase = $prevous_purchase;
        }

        $purchase->product_id = $request['product_id'];
        $purchase->invoice_no = $request['invoice_no'];
        $purchase->purchases_date = $request['purchases_date'];
        $purchase->purchases_buy_amount = $request['purchases_buy_amount'];
        $purchase->purchases_sales_amount = $request['purchases_sales_amount'];
        $purchase->purchases_quantity = $request['purchases_quantity'];
        $purchase->purchases_previous_quantity = $purchase->purchases_current_quantity;
        $purchase->purchases_current_quantity = $purchase->purchases_current_quantity + $request['purchases_quantity'];
        ;
        $purchase->supplier_name = $request['supplier_name'];
        $purchase->payment_method = $request['payment_method'];
        $purchase->remarks = $request['remarks'];
        $purchase->action_type = 'INSERT';
        $purchase->user_id = 'sys-user';
        $purchase->action_date = now();

        $purchase->save();
        return redirect('/purchase/list');

    }
}
