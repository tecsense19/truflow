<?php

namespace App\Controllers\Admin;

use App\Models\CountryModel;

class CountryController extends BaseController
{
    public function index()
    {
        $session = session();
        $user_id = $session->get('user_id');
        if($user_id){
            $countrymodel = new CountryModel();
            $countryData = $countrymodel->find();
            if (!$countryData) {
                $countryData = null;
            }
            return view('admin/country/country_list', ['countryData' => $countryData]);
        }else{
            return redirect()->to('/admin');
        }
    }
    public function country()
    {
        $countrymodel = new CountryModel();
        return view('admin/country/country');
    }
    public function countrySave()
    {

        $countrymodel = new CountryModel();
        $session = session();
        $input = $this->request->getVar();
        $country_id = $input['country_id'];

        $countryArr = [];

        $countryArr['label'] = isset($input['label']) ? $input['label'] : '';
      

        if (isset($input['country_id']) && $input['country_id'] != '') {
            $countrymodel->update(['country_id', $input['country_id']], $countryArr);
        } else {
            $countrymodel->insert($countryArr);
        }

        $session->setFlashdata('success', 'country change succesfully.');
        return redirect()->to('admin/country_list');
       
    }
    public function countryEdit($country_id)
    {
        $session = session();
        $user_id = $session->get('user_id');
        if($user_id){
            $countrymodel = new CountryModel();
            $countryData = $countrymodel->find($country_id);
    
            if (!$countryData) {
                $countryData = null;
            }
            return view('admin/country/country', ['countryData' => $countryData]);
        }else{
            return redirect()->to('/admin');
        }
    }
    public function countryDelete($country_id)
{
    $session = session();
    $countrymodel = new CountryModel();
    $countrymodel->delete($country_id);
    $session->setFlashdata('success', 'country Delete succesfully.');
    return redirect()->to('admin/country_list');
}

}
