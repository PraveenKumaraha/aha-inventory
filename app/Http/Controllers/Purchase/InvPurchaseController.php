<?php

namespace App\Http\Controllers\Purchase;

use App\InventoryItem;
use App\ManageStock;
use App\Purchase;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\InvPurchase;
use App\PurchaseItem;
use App\Supplier;
use App\Tax;
use App\Transaction;
use App\TransactionType;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Log;

class InvPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Purchase::select('purchases.id as purchaseId', 'transactions.date', 'transactions.reference_no')
            ->leftjoin('transactions', 'transactions.id', '=', 'purchases.transaction_id')
            ->whereNull('purchases.deleted_at')->orderby('purchases.id', 'desc')
            ->get();


        return view('Purchase.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $pdtproductIds = InventoryItem::select('product_id', 'product_name', 'id', 'a_price')->get();

        $pdtsupplierIds = Supplier::select('supplier_id', 'supplier_name', 'id')->get();
        $pdttaxids = Tax::select('tax_name', 'tax_value', 'id')->get();

        return view('Purchase.create', compact('pdtproductIds', 'pdtsupplierIds', 'pdttaxids'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Log::info('Purchase>Store Inside ' . " => " . json_encode($request->all()));

        // $rules = [];

        // foreach ($request->input('product_name') as $key => $value) {
        //     $rules["supplier_name.{$key}"] = 'required';
        //     $rules["customer_name.{$key}"] = 'required';
        //     $rules["gstin.{$key}"] = 'required';
        //     $rules["date.{$key}"] = 'required';
        //     $rules["product_name.{$key}"] = 'required';
        //     $rules["rate.{$key}"] = 'required';
        //     $rules["qty.{$key}"] = 'required';
        //     $rules["tax.{$key}"] = 'required';
        //     $rules["disc.{$key}"] = 'required';
        //     $rules["total.{$key}"] = 'required';
        // }


        // $validator = Validator::make($request->all(), $rules);




        $type = "income";
        $transactiontype = TransactionType::where('transaction_type_name', 'purchase')->first();
        $typeId = $transactiontype->id;
        $orderNo = $transactiontype->gen_no;
        $orderName = $transactiontype->gen_name;
        $date = $request->date;
        $referenceNo = $orderName . "/2022/" . $orderNo;
        $supplierId = $request->supplier;
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
            $transactionModel->supplier_id = $supplierId;
            $transactionModel->date = $date;
            $transactionModel->reference_no = $referenceNo;
            $transactionModel->user_id = $userId;
            $transactionModel->save();
            Log::info('Purchase>Store Inside transactionModel ' . " => " . json_encode($transactionModel));
            if ($transactionModel) {
                $purchaseModel = new Purchase();
                $purchaseModel->supplier_id = $supplierId;
                $purchaseModel->transaction_id = $transactionModel->id;
                $purchaseModel->save();
                Log::info('Purchase>Store Inside purchaseModel ' . " => " . json_encode($purchaseModel));
                for ($i = 0; $i < $itemCount; $i++) {
                    Log::info('Purchase>Store Inside for in purchase Item loop');
                    $purchaseItemModel = new PurchaseItem();
                    Log::info('Purchase>Store Inside for in purchase Item $purchaseModel->id' . $purchaseModel->id);
                    $purchaseItemModel->purchase_id = $purchaseModel->id;
                    Log::info('Purchase>Store Inside for in purchase Item $items[$i]' . $items[$i]);
                    $purchaseItemModel->item_id = $items[$i];
                    Log::info('Purchase>Store Inside for in purchase Item .$quantity[$i]' . $quantity[$i]);
                    $purchaseItemModel->quantity = $quantity[$i];
                    Log::info('Purchase>Store Inside for in purchase Item $rate[$i]' . $rate[$i]);
                    $purchaseItemModel->rate = $rate[$i];
                    Log::info('Purchase>Store Inside for in purchase Item $tax[$i]' . $tax[$i]);
                    $purchaseItemModel->tax_id = $tax[$i];
                    Log::info('Purchase>Store Inside for in purchase Item $discount[$i]' . $discount[$i]);
                    $purchaseItemModel->discount_id = $discount[$i];
                    Log::info('Purchase>Store Inside for in purchase Item  $total[$i]' . $total[$i]);
                    $purchaseItemModel->final_amount = $total[$i];
                    Log::info('Purchase>Store Inside for in purchase Item status');
                    $purchaseItemModel->status = "1";
                    Log::info('Purchase>Store Inside for in purchase Item ');
                    $purchaseItemModel->save();
                }
            }
        } catch (\Exception $e) {

            return $e->getMessage();
        }

        // foreach ($request->input('product_name') as $key => $value) {

        //     $model = new InvPurchase();

        //     $model->supplier = $request->get('supplier_name');
        //     $model->customer_name = $request->get('customer_name');
        //     $model->gstin = $request->get('gstin');
        //     $model->date = $request->get('date');
        //     $model->product = $request->get('product_name');
        //     $model->rate = $request->get('rate');
        //     $model->qty = $request->get('qty');
        //     $model->tax = $request->get('tax');
        //     $model->disc = $request->get('disc');
        //     $model->total = $request->get('total');

        //     dd($model);

        //     $model->save();
        // }


        return response()->json(['success' => 'done','referenceNo'=> $transactionModel->reference_no]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $model = Purchase::select("purchases.id", "transactions.reference_no", "transactions.supplier_id", "transactions.date")
            ->leftjoin('transactions', 'transactions.id', '=', 'purchases.transaction_id')
            ->where('purchases.id', $id)
            ->first();

        $purchaseItems = PurchaseItem::where('purchase_id', $id)->get();

        $pdtproductIds = InventoryItem::select('product_id', 'product_name', 'id', 'a_price')->get();

        $pdtsupplierIds = Supplier::select('supplier_id', 'supplier_name', 'id')->get();
        $pdttaxids = Tax::select('tax_name', 'tax_value', 'id')->get();


        return view('Purchase.edit', compact('model', 'pdtproductIds', 'pdtsupplierIds', 'pdttaxids', 'purchaseItems'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $date = $request->date;
        $supplierId = $request->supplier;

        $itemCount = count($request->item_id);
        $items = $request->item_id;
        $quantity = $request->quantity;
        $rate = $request->rate;
        $tax = $request->tax;
        $discount = $request->discount;
        $total = $request->total;
        $purchaseModel = Purchase::where('id', $id)->first();

        try {
            $transactionModel = Transaction::where('id', $purchaseModel->transaction_id)->first();
            $transactionModel->supplier_id = $supplierId;
            $transactionModel->date = $date;
            $transactionModel->save();
            if ($transactionModel) {

                $purchaseModel->supplier_id = $supplierId;
                $purchaseModel->save();
                Log::info('Purchase>Store Inside purchaseModel ' . " => " . json_encode($purchaseModel));
                for ($i = 0; $i < $itemCount; $i++) {
                    Log::info('Purchase>Store Inside for in purchase Item loop');
                    $purchaseItemModel = PurchaseItem::where('item_id',$items[$i])->where('purchase_id',$id)->first();
                    if($purchaseItemModel ==""){
                        $purchaseItemModel = new PurchaseItem();
                    }
                    Log::info('Purchase>Store Inside for in purchase Item $purchaseModel->id' . $purchaseModel->id);
                    $purchaseItemModel->purchase_id = $purchaseModel->id;
                    Log::info('Purchase>Store Inside for in purchase Item $items[$i]' . $items[$i]);
                    $purchaseItemModel->item_id = $items[$i];
                    Log::info('Purchase>Store Inside for in purchase Item .$quantity[$i]' . $quantity[$i]);
                    $purchaseItemModel->quantity = $quantity[$i];
                    Log::info('Purchase>Store Inside for in purchase Item $rate[$i]' . $rate[$i]);
                    $purchaseItemModel->rate = $rate[$i];
                    Log::info('Purchase>Store Inside for in purchase Item $tax[$i]' . $tax[$i]);
                    $purchaseItemModel->tax_id = $tax[$i];
                    Log::info('Purchase>Store Inside for in purchase Item $discount[$i]' . $discount[$i]);
                    $purchaseItemModel->discount_id = $discount[$i];
                    Log::info('Purchase>Store Inside for in purchase Item  $total[$i]' . $total[$i]);
                    $purchaseItemModel->final_amount = $total[$i];
                    Log::info('Purchase>Store Inside for in purchase Item status');
                    $purchaseItemModel->status = "1";
                    Log::info('Purchase>Store Inside for in purchase Item ');
                    $purchaseItemModel->save();
                }

            }
        } catch (\Exception $e) {

            return $e->getMessage();
        }
        return response()->json(['success' => 'done','referenceNo'=> $transactionModel->reference_no]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Purchase::where('id', $id)->first();
        $model->deleted_at = date('Y-m-d H:i:s');

        $model->save();
        return redirect()->route('purchase.index');
    }

    public function getPurchaseSplitedData(Request $request)
    {


        $models = Purchase::select('purchases.*', 'suppliers.supplier_id as supplierId')
            ->leftjoin('suppliers', 'suppliers.id', '=', 'purchases.supplier_id')
            ->whereNull('purchases.deleted_at')->orderby('purchases.id', 'desc');

        if ($request->type == "activeData") {
            $models->where('purchases.status', 1);
        } else if ($request->type == "inActiveData") {
            $models->where('purchases.status', 0);
        }
        $datas = $models->get();


        return response()->json(array('result' => "success", 'data' => $datas));
    }
    public function getItemData(Request $request)
    {

        $search = $request->searchTerm;

        $datas = InventoryItem::where('product_name', 'like', '%' . $search . '%')
            ->select('product_name', 'id')->get();

        $datas = Supplier::where('supplier_name', 'like', '%' . $search . '%')
            ->select('supplier_name', 'id')->get();

        return response()->json(array('data' => $datas));
    }
}
