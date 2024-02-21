<?php

namespace App\Http\Controllers;

use App\Helpers\DashboardHelper;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function awal(){
        $menu = 'dashboard';
        $title = 'Dashboard';

        $data = DashboardHelper::getDashboardStats();

        return view('apps.dashboard.index', compact('menu','title','data'));
    }
}
