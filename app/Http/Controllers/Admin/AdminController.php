<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController
{
    public function dashboard()
    {
        return view('admin.index');
    }
    public function contact()
    {
        return view('admin.contact');
    }


}
