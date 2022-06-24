<?php

namespace App\Http\Controllers\Purchase;

use App\InventoryItem;
use App\ManageStock;
use App\Purchase;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\InvPurchase;
use App\Supplier;
use App\Tax;
use Illuminate\Http\Request;

class InvPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        return view('Purchase.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         $pdtproductIds = InventoryItem::select('product_id','product_name', 'id')->get();
        
         $pdtsupplierIds = Supplier::select('supplier_id', 'supplier_name', 'id')->get();
         $pdttaxids = Tax::select('tax_name', 'tax_value', 'id')->get();

        return view('Purchase.create',compact('pdtproductIds','pdtsupplierIds', 'pdttaxids'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [];
        
        foreach($request->input('product_name') as $key => $value) {
            $rules["supplier_name.{$key}"] = 'required';
            $rules["customer_name.{$key}"] = 'required';
            $rules["gstin.{$key}"] = 'required';
            $rules["date.{$key}"] = 'required';
            $rules["product_name.{$key}"] = 'required';
            $rules["rate.{$key}"] = 'required';
            $rules["qty.{$key}"] = 'required';
            $rules["tax.{$key}"] = 'required';
            $rules["disc.{$key}"] = 'required';
            $rules["total.{$key}"] = 'required';
        }


        $validator = Validator::make($request->all(), $rules);


        if ($validator) {


            foreach($request->input('product_name') as $key => $value) {

                $model=new InvPurchase();

                $model->supplier = $request->get('supplier_name');
                $model->customer_name = $request->get('customer_name');
                $model->gstin = $request->get('gstin');
                $model->date = $request->get('date');
                $model->product = $request->get('product_name');
                $model->rate = $request->get('rate');
                $model->qty = $request->get('qty');
                $model->tax =$request->get('tax') ; 
                $model->disc =$request->get('disc') ;
                $model->total =$request->get('total') ;

                dd($model);

                $model->save();
            }


            return response()->json(['success'=>'done']);
        }else{

        return response()->json(['error'=>$validator->errors()->all()]);}




        
        
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

        $model = Purchase::select('purchases.*', 'categories.category_name as categoryName', 'brands.brand_name as brandName', 'units.name as unitName')
            ->leftjoin('inventory_items', 'inventory_items.id', '=', 'purchases.item_id')
            ->leftjoin('units', 'units.id', '=', 'inventory_items.unit_id')
            ->leftjoin('brands', 'brands.id', '=', 'inventory_items.brand_id')
            ->leftjoin('categories', 'categories.id', '=', 'inventory_items.category_id')
            ->where('purchases.id', $id)->first();

        $pdtproductIds = InventoryItem::select('product_name', 'id')->where('status', 1)->get();
        $pdtsupplierIds = Supplier::select('supplier_id', 'id')->where('supplier_status', 1)->get();

        return view('inventory.Purchase.Add Purchase.edit', compact('model', 'pdtproductIds', 'pdtsupplierIds'));
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
        try {
            $model = Purchase::where('id', $id)->first();
            $oldQuantity = $model->quantity;
            $model->supplier_id = $request->supplier_id;
            $model->item_id = $request->item_id;
            $model->quantity = $request->quantity;
            $model->barcode = $request->barcode;
            $model->status = "1";
            $model->save();

            if ($model) {
                $manageStockModel = ManageStock::where('item_id', $request->item_id)->first();
                $totalStock = ($manageStockModel->stock + $request->quantity) - $oldQuantity;
                $manageStockModel->stock = $totalStock;
                $manageStockModel->save();
            }


            return redirect()
                ->route('purchase.index')
                ->withStatus('Purchase Successfully Updated');
        } catch (\Exception $e) {

            return $e->getMessage();
        }
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
