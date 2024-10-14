<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Setting;
use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request,[
                'products' => 'required'
            ]);
        $shop=Setting::find(1);
        if ($shop && $shop->status == 2) {
            $startDate = Verta::parse($shop->sales_date_start);
            $endDate = Verta::parse($shop->sales_date_end);
            $now = Verta::now();

            if (!($now->between($startDate, $endDate))) {

                return response()->json([
                    'message' => 'The order registration time has ended',
                    'errors' => [
                        'id' => 'The order registration time has ended',
                    ],
                ], 403);
            }

        }else{
            return response()->json([
                'message' => 'The order registration time has ended',
                'errors' => [
                    'id' => 'The order registration time has ended',
                ],
            ], 403);
        }
        $products=json_decode($request->get('products'));
        $product_invoice=[];
        $invoice = Invoice::whereDate('created_at', Carbon::today())
            ->where('status',1)
            ->where('user_id', $request->user->id)
            ->first();
        if ($invoice) {
            return response()->json([
                'message' => 'You have an active invoice, you can edit it',
                'errors' => [
                    'id' => 'You have an active invoice, you can edit it',
                ],
            ], 403);
        }
        DB::beginTransaction();
        $price=0;
        foreach ($products as $key => $product) {
            $product_details=Product::find($product->product_id);
            if (!$product_details && $product_details->status == 1) {
                return response()->json([
                    'message' => 'The product does not exist or is inactive for this product_id:'.$product->product_id,
                    'errors' => [
                        'id' => 'The product does not exist or is inactive for this product_id:'.$product->product_id,
                    ],
                ], 403);
            }
            if ($product_details->stock < $product->count) {
                return response()->json([
                    'message' => 'The order amount is more than the stock for this product_id:'.$product->product_id,
                    'errors' => [
                        'count' => 'The order amount is more than the stock for this product_id:'.$product->product_id,
                    ],
                ], 403);
            }
            if ($product_details->max < $product->count) {
                return response()->json([
                    'message' => 'The maximum order is '.$product_details->max.' for this product_id:'.$product->product_id,
                    'errors' => [
                        'count' => 'The maximum order is '.$product_details->max.' for this product_id:'.$product->product_id,
                    ],
                ], 403);
            }
            if ($product_details->stock > $product_details->min){
                if ($product_details->min > $product->count) {
                    return response()->json([
                        'message' => 'The minimum order is '.$product_details->min.' for this product_id:'.$product->product_id,
                        'errors' => [
                            'count' => 'The minimum order is '.$product_details->min.' for this product_id:'.$product->product_id,
                        ],
                    ], 403);
                }
            }
            $product_details->update([
                'stock' => $product_details->stock - $product->count,
            ]);
            $product_invoice[$key]['name'] = $product_details->name;
            $product_invoice[$key]['id'] = $product_details->id;
            $product_invoice[$key]['type'] = $product_details->type;
            $product_invoice[$key]['image'] = $product_details->image;
            $product_invoice[$key]['barcode'] = $product_details->barcode;
            $product_invoice[$key]['price'] = $product_details->price;
            $product_invoice[$key]['stock'] = $product_details->stock;
            $product_invoice[$key]['order'] = $product->count;
            $price+=$product->count*$product_details->price;
        }
        try {
                $invoice=Invoice::create([
                    'user_id' => $request->user->id,
                    'barcode' => $this->get_barcode(),
                    'created_by' => $request->user->id,
                    'products' => $product_invoice,
                    'status'=>1,
                    'price' => $price
                ]);

                DB::commit();
                return response()->json([
                    'message' => 'Information has been successfully registered',
                    'data' => $invoice,
                ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
   }
    public function update(Request $request)
    {
        $this->validate($request,[
                'products' => 'required',
                'invoice_id' => 'required'
            ]);
        $shop=Setting::find(1);
        if ($shop && $shop->status == 2) {
            $startDate = Verta::parse($shop->sales_date_start);
            $endDate = Verta::parse($shop->sales_date_end);
            $now = Verta::now();

            if (!($now->between($startDate, $endDate))) {

                return response()->json([
                    'message' => 'The order registration time has ended',
                    'errors' => [
                        'id' => 'The order registration time has ended',
                    ],
                ], 403);
            }

        }else{
            return response()->json([
                'message' => 'The order registration time has ended',
                'errors' => [
                    'id' => 'The order registration time has ended',
                ],
            ], 403);
        }
        $products=json_decode($request->get('products'));
        $product_invoice=[];
        $invoice = Invoice::find($request->invoice_id);
        if ($invoice->status == 2) {
            return response()->json([
                'message' => 'Your invoice is the final registration and cannot be changed',
                'errors' => [
                    'invoice' => 'Your invoice is the final registration and cannot be changed',
                ],
            ], 403);
        }
        DB::beginTransaction();
        foreach ($invoice->products as $key => $item ) {
            $pr=Product::find($item['id']);
            $pr->update([
                'stock' => $pr->stock + $item['order'],
            ]);
        }
        $price=0;
        foreach ($products ?? [] as $key => $product) {
            $product_details=Product::find($product->product_id);
            if (!$product_details && $product_details->status == 1) {
                return response()->json([
                    'message' => 'The product does not exist or is inactive for this product_id:'.$product->product_id,
                    'errors' => [
                        'id' => 'The product does not exist or is inactive for this product_id:'.$product->product_id,
                    ],
                ], 403);
            }
            if ($product_details->stock < $product->count) {
                return response()->json([
                    'message' => 'The order amount is more than the stock for this product_id:'.$product->product_id,
                    'errors' => [
                        'count' => 'The order amount is more than the stock for this product_id:'.$product->product_id,
                    ],
                ], 403);
            }
            if ($product_details->max < $product->count) {
                return response()->json([
                    'message' => 'The maximum order is '.$product_details->max.' for this product_id:'.$product->product_id,
                    'errors' => [
                        'count' => 'The maximum order is '.$product_details->max.' for this product_id:'.$product->product_id,
                    ],
                ], 403);
            }
            if ($product_details->stock > $product_details->min){
                if ($product_details->min > $product->count) {
                    return response()->json([
                        'message' => 'The minimum order is '.$product_details->min.' for this product_id:'.$product->product_id,
                        'errors' => [
                            'count' => 'The minimum order is '.$product_details->min.' for this product_id:'.$product->product_id,
                        ],
                    ], 403);
                }
            }
            $product_details->update([
                'stock' => $product_details->stock - $product->count,
            ]);
            $product_invoice[$key]['name'] = $product_details->name;
            $product_invoice[$key]['id'] = $product_details->id;
            $product_invoice[$key]['type'] = $product_details->type;
            $product_invoice[$key]['image'] = $product_details->image;
            $product_invoice[$key]['barcode'] = $product_details->barcode;
            $product_invoice[$key]['price'] = $product_details->price;
            $product_invoice[$key]['stock'] = $product_details->stock;
            $product_invoice[$key]['order'] = $product->count;
            $price+=$product->count*$product_details->price;
        }
        try {
            $invoice->update([
                    'products' => $product_invoice,
                    'status'=>1,
                    'price' => $price
                ]);

                DB::commit();
                return response()->json([
                    'message' => 'Information has been successfully registered',
                    'data' => $invoice,
                ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
   }

    public function get_invoice(Request $request)
    {
        $this->validate($request,[
            'invoice_id' => 'required'
        ]);
        $invoice=Invoice::find($request->invoice_id);
        if ($invoice && $invoice->user_id == $request->user->id) {
            return response()->json([
                'message' => 'Invoice found successfully',
                'data' => $invoice,
            ], 200);
        }else{
            return response()->json([
                'message' => 'You do not have access to this invoice',
                'errors' => [
                    'invoice' => 'You do not have access to this invoice',
                ],
            ], 403);
        }
    }
    public function get_invoices(Request $request)
    {
        $invoice=Invoice::where('user_id',$request->user->id)->get();
            return response()->json([
                'message' => 'Invoices found successfully',
                'data' => $invoice,
            ], 200);
    }
    public function get_barcode()
    {
        $max=Invoice::max('barcode');
        return $max == 0 ? $max=10000 : $max+1;
    }
}
