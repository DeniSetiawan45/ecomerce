<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function profile()
    {
        $admin = User::where('role', 'admin')->firstOrFail();

        return view('admin.profile', compact('admin'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('location');

        $admins = User::query()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('location', 'LIKE', '%' . $keyword . '%');
            })
            ->get();

        return view('admin.cari', compact('admins', 'keyword'));
    }
}