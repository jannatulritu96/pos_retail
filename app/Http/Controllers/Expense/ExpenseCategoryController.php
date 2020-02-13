<?php

namespace App\Http\Controllers\Expense;

use App\ExpenseCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sql = ExpenseCategory::select('*');
        $render = [];

        if (isset($request->cat_name)) {
            $sql->where('cat_name', 'like', '%'.$request->cat_name.'%');
            $render['cat_name'] = $request->cat_name;
        }
        if (isset($request->status)) {
            $sql->where('status', $request->status);
            $render['status'] = $request->status;
        }

        $data = $sql->paginate(2);
        $data->appends($render);

        $status = (isset($request->status)) ? $request->status : '';
        return view('admin.expense.expense_category.index',compact('data','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.expense.expense_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cat_name'=>'required',
        ]);
        $category = ExpenseCategory::create([
            'cat_name' => $request->cat_name,
        ]);
        if ($category) {
            session()->flash('success','Expense Category stored successfully');
        } else {
            session()->flash('success','Expense Category stored successfully');
        }
        return redirect()->route('expense_category.store');
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
        $data['category'] = ExpenseCategory::findOrFail($id);
        return view('admin.expense.expense_category.edit',$data);
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
        $category = ExpenseCategory::where(['id'=> $id])->update([
            'cat_name' => $request->cat_name,
        ]);
        if ($category) {
            session()->flash('success','Expense Category stored successfully');
        } else {
            session()->flash('success','Expense Category stored successfully');
        }
        return redirect()->route('expense_category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = ExpenseCategory::findOrFail($id)->delete();


        if ($delete == 1) {
            $success = true;
            $message = "Category deleted successfully";
        } else {
            $success = true;
            $message = "Category not found";
        }

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
    public function changeActivity($id)
    {
        $category = ExpenseCategory::find($id);
        $status = 0;
        if ($category->status == 0) {
            $status = 1;
        }
        $category = $category->update(['status' => $status]);

        if ($category) {
            return response()->json(['success' => true, 'Status updated Successfully', 'status' => 200], 200);
        } else {
            return response()->json(['success' => false, 'Whoops! Status not updated', 'status' => 401], 200);
        }
    }
}
