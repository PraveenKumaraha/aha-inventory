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
        $models = Sale::select('sales.id as saleId', 'transactions.date', 'transactions.reference_no')
            ->leftjoin('transactions', 'transactions.id', '=', 'sales.transaction_id')
            ->whereNull('sales.deleted_at')->orderby('sales.id', 'desc')
            ->get();
        return view('Sale.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $pdtproductIds = InventoryItem::select('product_id', 'product_name', 's_price', 'id')->get();
        $pdttaxids = Tax::select('tax_name', 'tax_value', 'id')->get();

        return view('sale.create', compact('pdtproductIds', 'pdttaxids'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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



        $type = "outgoing";
        $transactiontype = TransactionType::where('transaction_type_name', 'sale')->first();
        $typeId = $transactiontype->id;
        $orderName = $transactiontype->gen_name;
        $orderNo = $transactiontype->gen_no;
        $date = $request->date;
        $referenceNo = $orderName . "/2022/" . $orderNo;
        $userId = Auth::user()->id;
        $itemCount = count($request->item_id);
        $items = $request->item_id;
        $quantity = $request->quantity;
        $rate = $request->rate;
        $tax = $request->tax;
        $discount = $request->discount;
        $total = $request->total;
        $customername = $request->cname;
        $customerNo = $request->cnumber;
        $gst = $request->gstIn;

        try {
            $transactionModel = new Transaction();
            $transactionModel->type = $type;
            $transactionModel->transaction_type_id = $typeId;
            $transactionModel->customer_name = $customername;
            $transactionModel->customer_no = $customerNo;
            $transactionModel->gst = $gst;
            $transactionModel->date = $date;
            $transactionModel->reference_no = $referenceNo;
            $transactionModel->user_id = $userId;
            $transactionModel->save();

            Log::info('Sale>Store Inside transactionModel ' . " => " . json_encode($transactionModel));
            if ($transactionModel) {
                $transactiontype->gen_no = $orderNo + 1;
                $transactiontype->save();

                $saleModel = new Sale();
                $saleModel->user_id = 1;
                $saleModel->client_id = 1;
                $saleModel->transaction_id = $transactionModel->id;
                $saleModel->status = 1;
                $saleModel->save();
                Log::info('Sale>Store Inside saleModel ' . " => " . json_encode($saleModel));
                for ($i = 0; $i < $itemCount; $i++) {

                    Log::info('Sale>Store Inside for in purchase Item loop');
                    $saleItemModel = new SaleItem();
                    Log::info('Sale>Store Inside for in sale Item $saleModel->id' . $saleModel->id);
                    $saleItemModel->sales_id = $saleModel->id;
                    Log::info('Sale>Store Inside for in sale Item $items[$i]' . $items[$i]);
                    $saleItemModel->item_id = $items[$i];
                    Log::info('Sale>Store Inside for in sale Item .$quantity[$i]' . $quantity[$i]);
                    $saleItemModel->quantity = $quantity[$i];
                    Log::info('Sale>Store Inside for in sale Item $rate[$i]' . $rate[$i]);
                    $saleItemModel->rate = $rate[$i];
                    Log::info('Sale>Store Inside for in sale Item $tax[$i]' . $tax[$i]);
                    $saleItemModel->tax_id = $tax[$i];
                    Log::info('Sale>Store Inside for in sale Item $discount[$i]' . $discount[$i]);
                    $saleItemModel->discount_id = $discount[$i];
                    Log::info('Sale>Store Inside for in sale Item  $total[$i]' . $total[$i]);
                    $saleItemModel->total_amount = $total[$i];
                    Log::info('Sale>Store Inside for in sale Item status');
                    $saleItemModel->status = "1";
                    Log::info('Sale>Store Inside for in sale Item ');
                    $saleItemModel->save();

                    if ($saleItemModel) {

                        $manageStockModel = ManageStock::where('item_id', $items[$i])->first();

                        $totalStock = ($manageStockModel->stock - $quantity[$i]);
                        $manageStockModel->stock = $totalStock;
                        $manageStockModel->save();
                    }
                }
            }
        } catch (\Exception $e) {

            return $e->getMessage();
        }
        return response()->json(['success' => 'done', 'referenceNo' => $transactionModel->reference_no]);
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
    public function edit($id)
    {

        $model = Sale::select("sales.id", "transactions.reference_no", "transactions.customer_name", "transactions.date", "transactions.gst", "transactions.customer_no")
            ->leftjoin('transactions', 'transactions.id', '=', 'sales.transaction_id')
            ->where('sales.id', $id)
            ->first();
        // dd($model);

        $saleItems = SaleItem::where('sales_id', $id)->get();
        // dd($saleItems);

        $pdtproductIds = InventoryItem::select('product_id', 'product_name', 'id', 'a_price')->get();
        // dd($pdtproductIds);
        $pdttaxids = Tax::select('tax_name', 'tax_value', 'id')->get();

        // dd($saleItems);
        return view('sale.edit', compact('model', 'pdtproductIds', 'pdttaxids', 'saleItems'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $date = $request->date;
        $customername = $request->cname;
        
        $itemCount = count($request->item_id);
        $items = $request->item_id;
        $quantity = $request->quantity;
        $rate = $request->rate;
        $tax = $request->tax;
        $discount = $request->discount;
        $total = $request->total;
        $saleModel = Sale::where('id', $id)->first();


        $jobCardItems = ($items) ? $items : null;
        $removeItems = $this->removeItems($id, $items);

        try {
            $transactionModel = Transaction::where('id', $saleModel->transaction_id)->first();

            $transactionModel->customer_name = $customername;
            $transactionModel->date = $date;
            $transactionModel->update();
           
            if ($transactionModel) {

                $saleModel->customer_name = $customername;
                $saleModel->save();
                Log::info('Sale>Store Inside saleModel '. "=>". json_encode($saleModel));
                for ($i = 0; $i < $itemCount; $i++) {
                    Log::info('Sale>Store Inside for in sale Item loop');
                    $saleItemModel = SaleItem::where('item_id', $items[$i])->where('sales_id', $id)->first();
                    if ($saleItemModel == "") {
                        $saleItemModel = new SaleItem();
                    }
                    Log::info('Sale>Store Inside for in sale Item $saleModel->id' . $saleModel->id);
                    $saleItemModel->sales_id = $saleModel->id;
                    Log::info('Sale>Store Inside for in sale Item $items[$i]' . $items[$i]);
                    $saleItemModel->item_id = $items[$i];
                    Log::info('Sale>Store Inside for in sale Item .$quantity[$i]' . $quantity[$i]);
                    $saleItemModel->quantity = $quantity[$i];
                    Log::info('Sale>Store Inside for in sale Item $rate[$i]' . $rate[$i]);
                    $saleItemModel->rate = $rate[$i];
                    Log::info('Sale>Store Inside for in sale Item $tax[$i]' . $tax[$i]);
                    $saleItemModel->tax_id = $tax[$i];
                    Log::info('Sale>Store Inside for in sale Item $discount[$i]' . $discount[$i]);
                    $saleItemModel->discount_id = $discount[$i];
                    Log::info('Sale>Store Inside for in sale Item  $total[$i]' . $total[$i]);
                    $saleItemModel->total_amount = $total[$i];
                    Log::info('Sale>Store Inside for in sale Item status');
                    $saleItemModel->status = "1";
                    Log::info('Sale>Store Inside for in sale Item ');
                    $saleItemModel->update();
                }
                
            }
        } catch (\Exception $e) {

            return $e->getMessage();
        }
        return response()->json(['success' => 'done', 'referenceNo' => $transactionModel->reference_no]);
    }
    public function removeItems($id, $jobCardItems)
    {
        $query = Sale::where('sale_id', $id);

        if ($jobCardItems) {
            $query->whereNotIn('item_id', $jobCardItems);
        }

        $query->delete();

        return [
            'message' => "Success"
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Sale::where('id', $id)->first();
        $model->delete_at = date('Y-m-d H:i:s');

        $model->save();
        return redirect()->route('sale.index');
    }

    public function getSaleSplitedData(Request $request)
    {
        $models = Sale::select("sales.id", "transactions.reference_no", "transactions.customer_name", "transactions.date", "transactions.gst", "transactions.customer_no")
        ->leftjoin('transactions', 'transactions.id', '=', 'sales.transaction_id')
        ->whereNull('sales.deleted_at')->orderby('sales.id', 'desc');
       

       
        if ($request->type == "activeData") {
            $models->where('sales.status', 1);
        } else if ($request->type == "inActiveData") {
            $models->where('sales.status', 0);
        }
        $dates = $models->get();

        return response()->json(array('result' => "success", 'data' => $dates));
    }
    public function getItemData(Request $request)
    {
        $search = $request->searchTerm;

        $datas = InventoryItem::where('product_name', 'like', '%' . $search . '%')
           ->select('product_name', 'id')->get();

        return response()->json(array('data' => $datas));
    }
}
