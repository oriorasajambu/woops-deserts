<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'page' => 'dashboard'
        ];
        return view('admin.contents.dashboard.index', $data);
    }
}
