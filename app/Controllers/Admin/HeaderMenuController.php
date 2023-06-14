<?php

namespace App\Controllers\Admin;

use App\Models\HeaderMenuModel;

class HeaderMenuController extends BaseController
{
    public function header_menu_list()
    {
        $headermenumodel = new HeaderMenuModel();
        $headerData = $headermenumodel->find();
        if (!$headerData) {
            $headerData = null;
        }
        return view('admin/header_menu/header_menu_list', ['headerData' => $headerData]);
    }
    public function header_menu()
    {
        $headermenumodel = new HeaderMenuModel();
        return view('admin/header_menu/header_menu');
    }
    public function header_menuSave()
    {

        $headermenumodel = new HeaderMenuModel();
        $session = session();
        $input = $this->request->getVar();
        $header_id = $input['header_id'];

        $headerArr = [];

        $headerArr['header_menu'] = isset($input['header_menu']) ? $input['header_menu'] : '';
        $headerArr['menu_link'] = isset($input['menu_link']) ? $input['menu_link'] : '';
        $headerArr['header_sub_menu'] = isset($input['header_sub_menu']) ? $input['header_sub_menu'] : '';
        $headerArr['sub_menu_link'] = isset($input['sub_menu_link']) ? $input['sub_menu_link'] : '';

        // echo "<pre>";
        // print_r($input);
        // die();

        if (isset($input['header_id']) && $input['header_id'] != '') {
            $headermenumodel->update(['header_id', $input['header_id']], $headerArr);
        } else {
            $headermenumodel->insert($headerArr);
        }

        $session->setFlashdata('success', 'Header Menu change succesfully.');
        return redirect()->to('admin/header_menu_list');
       
    }
    public function header_menuEdit($header_id)
    {

        $headermenumodel = new HeaderMenuModel();
        $headerData = $headermenumodel->find($header_id);

        if (!$headerData) {
            $headerData = null;
        }
        return view('admin/header_menu/header_menu', ['headerData' => $headerData]);
    }
    public function header_menuDelete($header_id)
{
    $session = session();
    $headermenumodel = new HeaderMenuModel();
    $headermenumodel->delete($header_id);
    $session->setFlashdata('success', 'Header Menu Delete succesfully.');
    return redirect()->to('admin/header_menu_list');
}

}
