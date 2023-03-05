<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard | SIPEMA',
            'activePage' => 'dashboard'
        ];
        return view('dashboard', $data);
    }
}