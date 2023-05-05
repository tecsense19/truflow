<?php

namespace App\Controllers;
use App\Models\SettingsModel;

class Home extends BaseController
{
    public function index()
    {
        $sitedata= $model = new SettingsModel();
        
        return view('front/index',['sitedata' => $sitedata]);
    }
    
    public function about()
    {
        return view('front/about');
    }
}
