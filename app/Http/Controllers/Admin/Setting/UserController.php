<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.setting.user.index', [
            'users' => User::all()
        ]);
    }
}
