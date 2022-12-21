<?php

namespace App\Http\Controllers\User;

use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    
    public function index()
    {

        $user = User::all();


        return view('Admin.User.index', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect(route('user.index'));
    }

    public function role($id)
    {
        $data = DB::table('users')->where('id', $id)->first();

        $role_now = $data->is_admin;

        if ($role_now == 1) {
            DB::table('users')->where('id', $id)->update([
                'is_admin' => 0
            ]);
        } else {
            DB::table('users')->where('id', $id)->update([
                'is_admin' => 1
            ]);
        }

        return redirect(route('user.index'))->with('success', 'Role akun berhasil diubah');
    }

}
