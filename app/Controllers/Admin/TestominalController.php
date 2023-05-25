<?php

namespace App\Controllers\Admin;

use App\Models\TestominalModel;

class TestominalController extends BaseController
{
    public function index()
    {
        $testominalmodel = new TestominalModel();
        $testimonalData = $testominalmodel->find();
        if (!$testimonalData) {
            $testimonalData = null;
        }
        return view('admin/testominal/testominal_list', ['testimonalData' => $testimonalData]);
    }
    public function testominal()
    {
        $testominalmodel = new TestominalModel();
        return view('admin/testominal/testominal');
    }
    public function testominalSave()
    {

        $testominalmodel = new TestominalModel();
        $session = session();
        $input = $this->request->getVar();
        $testimo_id = $input['testimo_id'];

        $testominalArr = [];

        $testominalArr['full_name'] = isset($input['full_name']) ? $input['full_name'] : '';
        $testominalArr['designation'] = isset($input['designation']) ? $input['designation'] : '';
        $testominalArr['description'] = isset($input['description']) ? $input['description'] : '';

        if ($file = $this->request->getFile('testimo_img')) {
            $path = 'public/front/images/testominal/';
            if ($file->getClientName()) {
                $filename = time() . '_testominalImg_' . $file->getClientName();
                $file->move($path, $filename);
                $testominalArr['testimo_img'] = 'public/front/images/testominal/' . $filename;
            }
        }

        if (isset($input['testimo_id']) && $input['testimo_id'] != '') {
            $testominalmodel->update(['setting_id', $input['testimo_id']], $testominalArr);
        } else {
            $testominalmodel->insert($testominalArr);
        }

        $session->setFlashdata('success', 'Testominal change succesfully.');
        return redirect()->to('admin/testominal_list');
       
    }
    public function testominalEdit($testimo_id)
    {

        $testominalmodel = new TestominalModel();
        $testimonalData = $testominalmodel->find($testimo_id);

        if (!$testimonalData) {
            $testimonalData = null;
        }
        return view('admin/testominal/testominal', ['testimonalData' => $testimonalData]);
    }
    public function testominalDelete($testimo_id)
{
    $session = session();
    $testominalmodel = new TestominalModel();
    $testominalmodel->delete($testimo_id);
    $session->setFlashdata('success', 'Testominal Delete succesfully.');
    return redirect()->to('admin/testominal_list');
    //return redirect()->to(base_url('admin/testominal'));
}

}
