<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Sale;
use Illuminate\Http\Request;
use App\InventoryItem;
use App\ManageStock;
use Illuminate\Support\Facades\Validator;
use App\Tax;
use App\Transaction;
use App\TransactionType;
use Auth;
use Illuminate\Support\Facades\Log;
use App\SaleItem;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Sale.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $pdtproductIds = InventoryItem::select('product_id','product_name','a_price', 'id')->get();
        $pdttaxids = Tax::select('tax_name', 'tax_value', 'id')->get();

        return view('sale.create',compact('pdtproductIds','pdttaxids'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        dd($request->all());


        Log::info('Sale>Store Inside ' . " => " . json_encode($request->all()));
    //     $rules = [];

    //     foreach($request->input('product_name') as $key => $value) {
    //         $rules["cname.{$key}"] = 'required';
    //         $rules["cnumber.{$key}"] = 'required';
    //         $rules["gstin.{$key}"] = 'required';
    //         $rules["date.{$key}"] = 'required';
    //         $rules["product_name.{$key}"] = 'required';
    //         $rules["rate.{$key}"] = 'required';
    //         $rules["qty.{$key}"] = 'required';
    //         $rules["tax.{$key}"] = 'required';
    //         $rules["disc.{$key}"] = 'required';
    //         $rules["total.{$key}"] = 'required';
    //     }


    //     $validator = Validator::make($request->all(), $rules);


    //     if ($validator) {


    //         foreach($request->input('product_name') as $key => $value) {

    //             $model=new sale();

    //             $model->cname = $request->get('cname');
    //             $model->cnumber = $request->get('cnumber');
    //             $model->gstin = $request->get('gstin');
    //             $model->date = $request->get('date');
    //             $model->product = $request->get('product_name');
    //             $model->rate = $request->get('rate');
    //             $model->qty = $request->get('qty');
    //             $model->tax =$request->get('tax');
    //             $model->disc =$request->get('disc');
    //             $model->total =$request->get('total');

    //             dd($model);

    //             $model->save();
    //         }


    //         return response()->json(['success'=>'done']);
    //     }
    //     else{

    //     return response()->json(['error'=>$validator->errors()->all()]);
    // }
    // }

    $type = "income";
    $transactiontype = TransactionType::where('transaction_type_name', 'sale')->first();
    $typeId = $transactiontype->id;
    $orderNo = $transactiontype->o_no;
    $date = $request->date;
    $referenceNo = "PU/2022/" . $orderNo;
    $userId = Auth::user()->id;
    $itemCount = count($request->item_id);
    $items = $request->item_id;
    $quantity = $request->quantity;
    $rate = $request->rate;
    $tax = $request->tax;
    $discount = $request->discount;
    $total = $request->total;


    try {
        $transactionModel = new Transaction();
        $transactionModel->type = $type;
        $transactionModel->transaction_type_id = $typeId;
        $transactionModel->date = $date;
        $transactionModel->reference_no = $referenceNo;
        $transactionModel->user_id = $userId;
        $transactionModel->save();
        Log::info('Sale>Store Inside transactionModel ' . " => " . json_encode($transactionModel));
        if ($transactionModel) {
            $transactiontype->o_no= $orderNo+1;
            $transactiontype->save();

            $saleModel = new Sale();

            $saleModel->transaction_id = $transactionModel->id;
            $saleModel->save();
            Log::info('Sale>Store Inside saleModel ' . " => " . json_encode($saleModel));
            for ($i = 0; $i < $itemCount; $i++) {
                Log::info('Sale>Store Inside for in purchase Item loop');
                $saleItemModel = new SaleItem();
                Log::info('Sale>Store Inside for in sale Item $saleModel->id'.$saleModel->id);
                $saleItemModel->purchase_id = $saleModel->id;
                Log::info('Sale>Store Inside for in sale Item $items[$i]'.$items[$i]);
                $saleItemModel->item_id = $items[$i];
                Log::info('Sale>Store Inside for in sale Item .$quantity[$i]'.$quantity[$i]);
                $saleItemModel->quantity = $quantity[$i];
                Log::info('Sale>Store Inside for in sale Item $rate[$i]'.$rate[$i]);
                $saleItemModel->rate = $rate[$i];
                Log::info('Sale>Store Inside for in sale Item $tax[$i]'.$tax[$i]);
               $saleItemModel->tax_id = $tax[$i];
               Log::info('Sale>Store Inside for in sale Item $discount[$i]'.$discount[$i]);
                $saleItemModel->discount_id = $discount[$i];
                Log::info('Sale>Store Inside for in sale Item  $total[$i]'. $total[$i]);
                $saleItemModel->final_amount = $total[$i];
                Log::info('Sale>Store Inside for in sale Item status');
                $saleItemModel->status = "1";
                Log::info('Sale>Store Inside for in sale Item ');
                $saleItemModel->save();

                if ($saleItemModel) {
                    $manageStockModel = ManageStock::where('item_id', $items[$i])->first();
                    $totalStock = ($manageStockModel->stock + $quantity[$i]);
                    $manageStockModel->stock = $totalStock;
                    $manageStockModel->save();
                }

            }


        }
    } catch (\Exception $e) {

        return $e->getMessage();
    }
    return response()->json(['success' => 'done','referenceNo'=>$transactionModel->reference_no]);
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
