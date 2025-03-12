<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FamilyMember;
use App\Models\HeadOfFamily;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard');
    }
}
