<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Comp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $user = Auth::user();
        $comp = Comp::first();
        if ($request->ajax()) {
            return DataTables::of(Bank::get())->toJson();
        }
        return view('bank.data', compact(['user', 'comp']))->with('title', 'Data Bank');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name'          => 'required|min:3|max:50',
            'acc_name'      => 'required|min:3|max:50',
            'acc_number'    => 'required|min:3|max:50|unique:banks,acc_number',
            'desc'          => 'max:100',
        ]);
        $bank = Bank::create([
            'name'          => $request->name,
            'acc_name'      => $request->acc_name,
            'acc_number'    => $request->acc_number,
            'desc'          => $request->desc,
        ]);
        if ($bank) {
            return response()->json(['status' => true, 'message' => 'Success Insert Data', 'data' => '']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Insert Data', 'data' => '']);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Bank $bank)
    {
        //
        if ($request->ajax()) {
            $bank = Bank::find($bank->id);
            return response()->json(['status' => true, 'messagge' => '', 'data' => $bank]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {
        //
        $this->validate($request, [
            'name'          => 'required|min:3|max:50',
            'acc_name'      => 'required|min:3|max:50',
            'acc_number'    => 'required|min:3|max:50|unique:banks,acc_number,' . $bank->id,
            'desc'          => 'max:100',
        ]);
        $bank = Bank::findOrFail($bank->id);
        $bank->update([
            'name'          => $request->name,
            'acc_name'      => $request->acc_name,
            'acc_number'    => $request->acc_number,
            'desc'          => $request->desc,
        ]);
        if ($bank) {
            return response()->json(['status' => true, 'message' => 'Success Update Data', 'data' => '']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Update Data', 'data' => '']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        if ($request->id) {
            foreach ($request->id as $id) {
                $bank = Bank::findOrFail($id);
                $bank->delete();
            }
            return response()->json(['status' => true, 'message' => 'Success Delete Data', 'data' => '']);
        } else {
            return response()->json(['status' => false, 'message' => 'No Selected Data', 'data' => '']);
        }
    }
}
