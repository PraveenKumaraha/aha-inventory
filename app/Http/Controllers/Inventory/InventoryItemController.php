<?php

namespace App\Http\Controllers\Inventory;

use App\Category;
use App\Brand;
use App\Product;
use App\Http\Controllers\Controller;
use App\InventoryItem;
use App\ManageStock;
use App\Unit;
use Illuminate\Http\Request;

class InventoryItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = InventoryItem::select('inventory_items.*', 'categories.category_name as categoryName', 'brands.brand_name as brandName', 'units.name as unitName')
            ->leftjoin('units', 'units.id', '=', 'inventory_items.unit_id')
            ->leftjoin('brands', 'brands.id', '=', 'inventory_items.brand_id')
            ->leftjoin('categories', 'categories.id', '=', 'inventory_items.category_id')
            ->whereNull('inventory_items.deleted_at')->orderby('inventory_items.id', 'desc')
            ->get();

        return view('inventory.InventoryItem.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pdtBrands = Brand::select('brand_name', 'id')->get();
        $pdtCategorys = Category::select('category_name', 'id')->where('category_status', 1)->get();
        $pdtUnits = Unit::select('name', 'id')->where('status', 1)->get();

        return view('inventory.InventoryItem.create', compact('pdtBrands', 'pdtCategorys', 'pdtUnits'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' =>'required|unique:inventory_items|max:255',
            'product_id' =>'required|unique:inventory_items|max:255',
        ]);

        $model = new InventoryItem();
        $model->product_name = $request->input('product_name');
        $model->product_id = $request->input('product_id');
        $model->brand_id = $request->input('brand_id');
        $model->category_id = $request->input('category_id');
        $model->unit_id = $request->input('unit_id');
        $model->a_price = $request->input('a_price');
        $model->s_price = $request->input('s_price');
        $model->gst = $request->input('gst');
        $model->limit = $request->input('limit');
        $model->status = "1";
        $model->save();
        if ($model) {
            $manageStockModel = new ManageStock();
            $manageStockModel->item_id = $model->id;
            $manageStockModel->stock = "0";
            $manageStockModel->date = date('Y-m-d');
            $manageStockModel->status = "1";
            $manageStockModel->save();
        }
       
        return redirect()
            ->route('inventoryItem.index')
            ->withStatus('Product Successfully Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StockProduct  $stockProduct
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StockProduct  $stockProduct
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = InventoryItem::where('id', $id)->first();
        $pdtBrands = Brand::select('brand_name', 'id')->where('brand_status', 1)->get();
        $pdtCategorys   = Category::select('category_name', 'id')->where('category_status', 1)->get();
        $pdtUnits = Unit::select('name', 'id')->where('status', 1)->get();

        return view('inventory.InventoryItem.edit', compact('model', 'pdtBrands', 'pdtCategorys', 'pdtUnits'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StockProduct  $stockProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = InventoryItem::where('id', $id)->first();
        $model->product_name = $request->input('product_name');
        $model->product_id = $request->input('product_id');
        $model->brand_id = $request->input('brand_id');
        $model->category_id = $request->input('category_id');
        $model->unit_id = $request->input('unit_id');
        $model->a_price = $request->input('a_price');
        $model->s_price = $request->input('s_price');
        $model->gst = $request->input('gst');
        $model->limit = $request->input('limit');

        $model->save();
        return redirect()
            ->route('inventoryItem.index')
            ->withStatus('Product Successfully Created.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StockProduct  $stockProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = InventoryItem::where('id', $id)->first();
        $model->deleted_at = date('Y-m-d H:i:s');

        $model->save();
        return redirect()->route('inventoryItem.index');
    }

    public function getInventoryItemSplitedData(Request $request)
    {


        $models = InventoryItem::select('inventory_items.*', 'categories.category_name as categoryName', 'brands.brand_name as brandName', 'units.name as unitName')
            ->leftjoin('units', 'units.id', '=', 'inventory_items.unit_id')
            ->leftjoin('brands', 'brands.id', '=', 'inventory_items.brand_id')
            ->leftjoin('categories', 'categories.id', '=', 'inventory_items.category_id')
            ->whereNull('inventory_items.deleted_at')->orderby('inventory_items.id', 'desc');
        if ($request->type == "activeData") {
            $models->where('inventory_items.status', 1);
        } else if ($request->type == "inActiveData") {
            $models->where('inventory_items.status', 0);
        }
        $datas = $models->get();

        return response()->json(array('result' => "success", 'data' => $datas));
    }
    public function getProductRelatedData(Request $request)
    {

        $datas = InventoryItem::select('categories.category_name as categoryName', 'brands.brand_name as brandName', 'units.name as unitName')
            ->leftjoin('units', 'units.id', '=', 'inventory_items.unit_id')
            ->leftjoin('brands', 'brands.id', '=', 'inventory_items.brand_id')
            ->leftjoin('categories', 'categories.id', '=', 'inventory_items.category_id')
            ->where('inventory_items.id', $request->productId)->first();

        return response()->json(array('result' => "success", 'data' => $datas));
    }
    public function changeStatus(Request $request)
    {
       
        $inventoryItem = InventoryItem::find($request->id)->update(['status' => $request->status]);

        return response()->json(['success'=>'Status changed successfully.']);
    }
}
