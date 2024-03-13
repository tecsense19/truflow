<?php

namespace App\Controllers\Admin;

use App\Models\SliderModel;

class SliderController extends BaseController
{
    public function index()
    {
        $session = session();
        $user_id = $session->get('user_id');
        if($user_id){
            $slidermodel = new SliderModel();
            $sliderData = $slidermodel->find();
            if (!$sliderData) {
                $sliderData = null;
            }
            return view('admin/slider/slider_list', ['sliderData' => $sliderData]);
        }else{
            return redirect()->to('/admin');
        }
    }
    public function slider()
    {
        $slidermodel = new SliderModel();
        return view('admin/slider/slider');
    }
    public function sliderSave()
{
  
    $slidermodel = new SliderModel();
    $session = session();
    $input = $this->request->getVar();
    //$slider_id = $input['slider_id'];

    $sliderArr = [];
    $sliderArr['slider_link'] = isset($input['slider_link']) ? $input['slider_link'] : '';

    $newName = $this->request->getFiles()['slider_path'];
    foreach ($newName as $uploadedFile) {
        $oldFile = base_url() . 'public/front/images/home/' . $uploadedFile->getName();
        if (file_exists($oldFile)) {
            unlink($oldFile);
        }
    }

    // Check if files were uploaded
    if ($this->request->getFiles()) {
        $uploadedFiles = $this->request->getFiles()['slider_path'];

        foreach ($uploadedFiles as $uploadedFile) {
            // Check if the uploaded file is valid
            if ($uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
                $newName = $uploadedFile->getName();

                // Move the uploaded file to the desired directory
                $uploadedFile->move(ROOTPATH . 'public/front/images/home/', $newName);

                // Add the file path to the array
                $sliderArr['slider_path'][] = $newName;
            }
        }
    }

    if (!empty($sliderArr['slider_path'])) {
        $sliderArr['slider_path'] = implode(',', $sliderArr['slider_path']);
    }

    if (isset($input['slider_id']) && $input['slider_id'] != '') {
        $slidermodel->update(['slider_id' => $input['slider_id']], $sliderArr);
    } else {
        $slidermodel->insert($sliderArr);
    }

    $session->setFlashdata('success', 'Slider changes saved successfully.');
    return redirect()->to('admin/slider_list');
}

    public function sliderEdit($slider_id)
    {

        $slidermodel = new SliderModel();
        $sliderData = $slidermodel->find($slider_id);

        if (!$sliderData) {
            $sliderData = null;
        }
        return view('admin/slider/slider', ['sliderData' => $sliderData]);
    }
    public function sliderDelete($slider_id)
{
    $session = session();
    $slidermodel = new SliderModel();
    $slidermodel->delete($slider_id);
    $session->setFlashdata('success', 'slider Delete succesfully.');
    return redirect()->to('admin/slider_list');
}

}
