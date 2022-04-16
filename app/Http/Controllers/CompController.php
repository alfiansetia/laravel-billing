<?php

namespace App\Http\Controllers;

use App\Models\Comp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CompController extends Controller
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
        return view('setting.comp', compact(['user', 'comp']))->with('title', 'Setting Company');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comp  $comp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $comp = Comp::first();
        if ($request->logo == '') {
            $this->validate($request, [
                'name'      => 'required|min:3|max:50',
                'phone'     => 'required|min:3|max:15',
                'address'   => 'required|min:3|max:200',
            ]);
        } else {
            $this->validate($request, [
                'name'      => 'required|min:3|max:50',
                'phone'     => 'required|min:3|max:15',
                'address'   => 'required|min:3|max:200',
                'logo'      => 'required|mimes:jpg,jpeg,png|max:10240',
            ]);
        }

        if ($request->logo == '') {
            $comp->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        } else {
            File::delete(public_path('assets/img/' . $comp->logo));
            $file = $request->file('logo');
            $name = 'logo.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/img/logo'), $name);
            $comp->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'logo' => $name,
            ]);
        }
        if ($comp) {
            return redirect()->route('comp.index')->with(['success' => 'Success Update Company!']);
        } else {
            return redirect()->route('comp.index')->with(['error' => 'Failed Update Company!']);
        }
    }
}
