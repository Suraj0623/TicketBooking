<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.index');
    }
    public function contact(){
        return view('admin.contact');
    }
    
    
}
