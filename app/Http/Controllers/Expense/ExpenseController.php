<?php

namespace App\Http\Controllers\Expense;

use App\Expense;
use App\ExpenseCategory;
use App\Outlet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::with(['relOutlet','relExpenseCategory'])->get();
//        $outlets = Outlet::get();
//        $expCats = ExpenseCategory::get();
        return view('admin.expense.expense.index',compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outlets = Outlet::where('status','1')->get();
        $exp_cats = ExpenseCategory::where('status','1')->get();
        return view('admin.expense.expense.create',compact('outlets','exp_cats'));
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
            'outlet'=>'required',
            'expense_no'=>'required',
            'expense_date'=>'required',
            'note'=>'required',
            'exp_cat'=>'required',
            'amount'=>'required',
        ]);

        $expense = new Expense();
        $expense->outlet= $request->outlet;
        $expense->expense_no= $request->expense_no;
        $expense->expense_date= $request->expense_date;
        $expense->note= $request->note;
        $expense->exp_cat= $request->exp_cat;
        $expense->amount= $request->amount;

        if($request->hasFile('file'))
        {
            $file= $request->file('file');
            $file->move('assets/expense/',$file->getClientOriginalName());
            $expense->file = 'assets/expense/'.$file->getClientOriginalName();
        }
        $expense->save();

        if ($expense) {
            session()->flash('success','Expense stored successfully');
        } else {
            session()->flash('success','Expense stored successfully');
        }
        return redirect()->route('expense.store');
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
        $expense = Expense::findOrFail($id);
        $outlets = Outlet::where('status','1')->get();
        $exp_cats = ExpenseCategory::where('status','1')->get();

        return view('admin.expense.expense.edit',compact('expense','outlets','exp_cats'));
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
        $expense = Expense::findOrFail($id);
        $expense->outlet= $request->outlet;
        $expense->expense_no= $request->expense_no;
        $expense->expense_date= $request->expense_date;
        $expense->note= $request->note;
        $expense->exp_cat= $request->exp_cat;
        $expense->amount= $request->amount;

        if($request->hasFile('file'))
        {
            $file= $request->file('file');
            $file->move('assets/expense/',$file->getClientOriginalName());
            $expense->file = 'assets/expense/'.$file->getClientOriginalName();
        }
        $expense->save();

        if ($expense) {
            session()->flash('success','Expense stored successfully');
        } else {
            session()->flash('success','Expense stored successfully');
        }

        if ($expense) {
            session()->flash('success','Product stored successfully');
        } else {
            session()->flash('success','Product stored successfully');
        }
        return redirect()->route('expense.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Expense::findOrFail($id)->delete();


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
        $expense = Expense::find($id);
        $status = 0;
        if ($expense->status == 0) {
            $status = 1;
        }
        $expense = $expense->update(['status' => $status]);

        if ($expense) {
            return response()->json(['success' => true, 'Status updated Successfully', 'status' => 200], 200);
        } else {
            return response()->json(['success' => false, 'Whoops! Status not updated', 'status' => 401], 200);
        }
    }
    public function searchReport(){
        $expenses = Expense::with(['relOutlet','relExpenseCategory'])->get();
        return view('admin.expense.expense_report',compact('expenses'));
    }
}
