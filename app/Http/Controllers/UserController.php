<?php

namespace App\Http\Controllers;

use App\Models\Comp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = Auth::user();
        $comp = Comp::first();
        if ($request->ajax()) {
            return DataTables::of(User::with('roles')->get())->toJson();
        }
        return view('user.data', compact(['user', 'comp']))->with('title', 'Data User');
    }

    public function store(Request $request, User $user)
    {
        $this->validate($request, [
            'name'      => 'required|min:3|max:50',
            'email'     => 'required|min:3|max:50|unique:users,email',
            'phone'     => 'required|min:3|max:15',
            'foto'      => 'required|mimes:jpg,jpeg,png|max:10240',
            'password'  => ['required', Password::min(8)->numbers()],
            'role'      => 'required',
        ]);
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $name = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/img/profile'), $name);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'foto' => $name,
            'password' => Hash::make($request->password),
        ]);
        $role = Role::findById($request->role);
        $user->assignRole($role->name);
        if ($user) {
            return response()->json(['status' => true, 'message' => 'Success Insert Data', 'data' => '']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Insert Data', 'data' => '']);
        }
    }

    public function edit(Request $request, User $user)
    {
        if ($request->ajax()) {
            $user = User::with('roles')->find($user->id);
            return response()->json(['status' => true, 'message' => '', 'data' => $user]);
        } else {
            abort(403);;
        }
    }

    public function update(Request $request, User $user)
    {
        if ($request->password != '' && $request->foto == '') {
            $this->validate($request, [
                'name'      => 'required|min:3|max:50',
                'email'     => 'required|min:3|max:50|unique:users,email,' . $user->id,
                'phone'     => 'required|mi n:3|max:15',
                'password'  => ['required', 'same:password2', Password::min(8)->numbers()],
                'role'      => 'required',
            ]);
        } elseif ($request->password == '' && $request->foto != '') {
            $this->validate($request, [
                'name'      => 'required|min:3|max:50',
                'email'     => 'required|min:3|max:50|unique:users,email,' . $user->id,
                'phone'     => 'required|min:3|max:15',
                'foto'      => 'required|mimes:jpg,jpeg,png|max:10240',
                'role'      => 'required',
            ]);
        } elseif ($request->password == '' && $request->foto == '') {
            $this->validate($request, [
                'name'      => 'required|min:3|max:50',
                'email'     => 'required|min:3|max:50|unique:users,email,' . $user->id,
                'phone'     => 'required|min:3|max:15',
                'role'      => 'required',
            ]);
        } else {
            $this->validate($request, [
                'name'      => 'required|min:3|max:50',
                'email'     => 'required|min:3|max:50|unique:users,email,' . $user->id,
                'phone'     => 'required|min:3|max:15',
                'foto'      => 'required|mimes:jpg,jpeg,png|max:10240',
                'password'  => ['required', 'same:password2', Password::min(8)->numbers()],
                'role'      => 'required',
            ]);
        }
        $user = User::findOrFail($user->id);
        $role = Role::findById($request->role);
        if ($request->password != '' && $request->foto == '') {
            $user->update([
                'name'      => $request->name,
                'email'     => $request->email,
                'phone'     => $request->phone,
                'password'  => Hash::make($request->password),
            ]);
        } elseif ($request->password == '' && $request->foto != '') {
            File::delete(public_path('assets/img/profile/' . $user->foto));
            $file = $request->file('foto');
            $name = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/img/profile'), $name);
            $user->update([
                'name'  => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'foto'  => $name
            ]);
        } elseif ($request->password == '' && $request->foto == '') {
            $user->update([
                'name'      => $request->name,
                'email'     => $request->email,
                'phone'     => $request->phone,
            ]);
        } else {
            File::delete(public_path('assets/img/profile/' . $user->foto));
            $file = $request->file('foto');
            $name = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/img/profile'), $name);
            $user->update([
                'name'      => $request->name,
                'email'     => $request->email,
                'phone'     => $request->phone,
                'password'  => Hash::make($request->password),
                'foto'      => $name
            ]);
        }
        $user->assignRole($role->name);
        if ($user) {
            return response()->json(['status' => true, 'message' => 'Success Update Data', 'data' => '']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Update Data', 'data' => '']);
        }
    }

    public function destroy(Request $request)
    {
        if ($request->id) {
            foreach ($request->id as $id) {
                $user = User::findOrFail($id);
                File::delete(public_path('assets/img/profile/') . $user->foto);
                $user->delete();
            }
            return response()->json(['status' => true, 'message' => 'Success Delete Data', 'data' => '']);
        } else {
            return response()->json(['status' => false, 'message' => 'No Selected Data', 'data' => '']);
        }
    }

    public function profile()
    {
        $user = Auth::user();
        $comp = Comp::first();
        return view('setting.profile', compact(['user', 'comp']))->with('title', 'Setting Profile');
    }

    public function profileUpdate(Request $request)
    {
        $user = User::find(Auth::id());
        if ($request->password == '' && $request->foto == '') {
            $this->validate($request, [
                'name'  => 'required|min:3|max:50',
                'phone' => 'required|min:3|max:15',
            ]);
        } elseif ($request->password != '' && $request->foto == '') {
            $this->validate($request, [
                'name'      => 'required|min:3|max:50',
                'phone'     => 'required|min:3|max:15',
                'password'  => ['required', 'same:password2', Password::min(8)->numbers()],
                'password2' => 'required',
            ]);
        } elseif ($request->password == '' && $request->foto != '') {
            $this->validate($request, [
                'name'      => 'required|min:3|max:50',
                'phone'     => 'required|min:3|max:15',
                'foto'      => 'required|mimes:jpg,jpeg,png|max:10240',
            ]);
        } else {
            $this->validate($request, [
                'name'      => 'required|min:3|max:50',
                'phone'     => 'required|min:3|max:15',
                'foto'      => 'required|mimes:jpg,jpeg,png|max:10240',
                'password'  => ['required', 'same:password2', Password::min(8)->numbers()],
                'password2' => 'required',
            ]);
        }

        if ($request->password == '' && $request->foto == '') {
            $user->update([
                'name' => $request->name,
                'phone' => $request->phone,
            ]);
        } elseif ($request->password != '' && $request->foto == '') {
            $user->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);
        } elseif ($request->password == '' && $request->foto != '') {
            File::delete(public_path('assets/img/profile/' . $user->foto));
            $file = $request->file('foto');
            $name = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/img/profile'), $name);
            $user->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'foto' => $name,
            ]);
        } else {
            File::delete(public_path('assets/img/profile/' . $user->foto));
            $file = $request->file('foto');
            $name = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/img/profile'), $name);
            $user->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'foto' => $name,
                'password' => Hash::make($request->password),
            ]);
        }
        if ($user) {
            return redirect()->route('user.profile')->with(['success' => 'Success Update Profile!']);
        } else {
            return redirect()->route('user.profile')->with(['error' => 'Failed Update Profile!']);
        }
    }
}
