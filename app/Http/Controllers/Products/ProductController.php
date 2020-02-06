<?php

namespace App\Http\Controllers\Products;

use App\Category;
use App\Product;
use App\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        dd($request->all());

        $sql = Product::with(['relCategory','relUnit'])->select('*');
        $render = [];


        if(isset($request->search)){
            $sql->where(function ($q) use($request){
                $q->where('category_id', '=', $request->search)
                    ->orwhere('name', '=', $request->search)
                    ->orwhere('code', '=', $request->search)
                    ->orwhere('unit', '=', $request->search);
            });
        }

        if (isset($request->status)) {
            $sql->where('status', $request->status);
        }

        $data = $sql->paginate(30);
        $data->appends($render);

        $status = (isset($request->status)) ? $request->status : '';
        return view('admin.products.product.index',compact('data','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status','1')->get();
        $units = Unit::where('status','1')->get();
        return view('admin.products.product.create',compact('categories','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'category_id'=>'required',
            'name'=>'required',
            'code'=>'required',
            'unit'=>'required',
            'purchase'=>'required',
            'sell'=>'required',
            'details'=>'required',
        ]);

            $product = new Product();
            $product->category_id= $request->category_id;
            $product->name= $request->name;
            $product->code= $request->code;
            $product->unit= $request->unit;
            $product->purchase= $request->purchase;
            $product->sell= $request->sell;
            $product->details= $request->details;
            if($request->hasFile('image'))
            {
                $photo= $request->file('image');
                $photo->move('assets/product/',$photo->getClientOriginalName());
                $product->image = 'assets/product/'.$photo->getClientOriginalName();
            }
            $product->save();

        if ($product) {
            session()->flash('success','Product stored successfully');
        } else {
            session()->flash('success','Product stored successfully');
        }
        return redirect()->route('product.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $category = Category::where('status','1')->get();
        $unit = Unit::where('status','1')->get();
        return view('admin.products.product.edit',compact('product','category','unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->code = $request->code;
        $product->unit = $request->unit;
        $product->purchase = $request->purchase;
        $product->sell = $request->sell;
        $product->details = $request->details;
        if($request->hasFile('image'))
        {
            $photo= $request->file('image');
            $photo->move('assets/product/',$photo->getClientOriginalName());
            $product->image = 'assets/product/'.$photo->getClientOriginalName();
        }
        $product->save();

        if ($product) {
            session()->flash('success','Product stored successfully');
        } else {
            session()->flash('success','Product stored successfully');
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $delete = Product::findOrFail($id)->delete();

        if ($delete == 1) {
            $success = true;
            $message = "Customer deleted successfully";
        } else {
            $success = true;
            $message = "Customer not found";
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function changeActivity($id)
    {
        $product = Product::find($id);
        $status = 0;
        if ($product->status == 0) {
            $status = 1;
        }
        $product = $product->update(['status' => $status]);

        if ($product) {
            return response()->json(['success' => true, 'Status updated Successfully', 'status' => 200], 200);
        } else {
            return response()->json(['success' => false, 'Whoops! Status not updated', 'status' => 401], 200);
        }
    }
}
