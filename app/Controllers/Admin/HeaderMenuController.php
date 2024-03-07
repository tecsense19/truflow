<?php

namespace App\Controllers\Admin;

use App\Models\HeaderMenuModel;
use App\Models\MetaContentsModel;

class HeaderMenuController extends BaseController
{
    public function header_menu_list()
    {
        $session = session();
        $user_id = $session->get('user_id');
        if($user_id){
            $headermenumodel = new HeaderMenuModel();
            $headerData = $headermenumodel->find();
            if (!$headerData) {
                $headerData = null;
            }
            return view('admin/header_menu/header_menu_list', ['headerData' => $headerData]);
        }else{
            return redirect()->to('/admin');
        }
    }
    public function header_menu()
    {
        $headermenumodel = new HeaderMenuModel();
        return view('admin/header_menu/header_menu');
    }
    public function header_menuSave()
    {

        $headermenumodel = new HeaderMenuModel();
        $metaModel = new MetaContentsModel();
        $session = session();
        $input = $this->request->getVar();
        $header_id = $input['header_id'];

        $headerArr = [];

        $headerArr['header_menu'] = isset($input['header_menu']) ? $input['header_menu'] : '';
        $headerArr['menu_link'] = isset($input['menu_link']) ? $input['menu_link'] : '';
        $headerArr['page_title'] = isset($input['title']) ? $input['title'] : '';
        // $headerArr['header_sub_menu'] = isset($input['header_sub_menu']) ? $input['header_sub_menu'] : '';
        // $headerArr['sub_menu_link'] = isset($input['sub_menu_link']) ? $input['sub_menu_link'] : '';

        // echo "<pre>";
        // print_r($input);
        // die();

        if (isset($input['header_id']) && $input['header_id'] != '') {
            $headermenumodel->update(['header_id', $input['header_id']], $headerArr);

            $metaModel->where('menu_id', $input['header_id'])->delete();

            if(isset($input['meta_name']) && count($input['meta_name']) > 0)
            {
                for ($i=0; $i < count($input['meta_name']); $i++) 
                { 
                    if($input['meta_name'][$i] != '' && $input['meta_content'][$i] != '')
                    {
                        $metaArr = [];
                        $metaArr['menu_id'] = $input['header_id'];
                        $metaArr['meta_name'] = $input['meta_name'][$i];
                        $metaArr['meta_content'] = $input['meta_content'][$i];

                        $metaModel->insert($metaArr);
                    }
                }
            }
        } else {
            $lastId = $headermenumodel->insert($headerArr);

            if(isset($input['meta_name']) && count($input['meta_name']) > 0)
            {
                for ($i=0; $i < count($input['meta_name']); $i++) 
                { 
                    if($input['meta_name'][$i] != '' && $input['meta_content'][$i] != '')
                    {
                        $metaArr = [];
                        $metaArr['menu_id'] = isset($input['header_id']) ? $input['header_id'] : '';
                        $metaArr['meta_name'] = $input['meta_name'][$i];
                        $metaArr['meta_content'] = $input['meta_content'][$i];

                        $metaModel->insert($metaArr);
                    }
                }
            }
        }

        $session->setFlashdata('success', 'Header Menu change succesfully.');
        return redirect()->to('admin/header_menu_list');
       
    }
    public function header_menuEdit($header_id)
    {

        $headermenumodel = new HeaderMenuModel();
        $metaModel = new MetaContentsModel();

        $headerData = $headermenumodel->find($header_id);
        $metaDataArr = [];
        if(isset($headerData['header_id']))
        {
            $metaDataArr = $metaModel->where('menu_id', $header_id)->get()->getResultArray();
        }

        if (!$headerData) {
            $headerData = null;
        }
        return view('admin/header_menu/header_menu', ['headerData' => $headerData, 'metaDataArr' => $metaDataArr]);
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
