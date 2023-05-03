<?php

namespace App\Controllers\Admin;



class Dashboard extends BaseController
{
    public function index()
    {
        return view('admin/dashboard/dashboard');
    }
}
