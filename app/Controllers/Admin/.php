<?php

namespace App\Controllers\Admin;

use App\Models\PartnerImagesModel;

class PartnerImagesController extends BaseController
{
    public function partner_images()
    {
        $model = new PartnerImagesModel();
        $settings_data = $model->where('partner_id', 1)->first();
        return view('admin/partner_images/partner_images', ['settings_data' => $settings_data]);
    }
    public function partnerImages_add_edit()
    {

        $model = new PartnerImagesModel();
        $session = session();
        $input = $this->request->getVar();

        $partner_id = $input['partner_id'];
        $settingsArr = [];

        $files = $this->request->getFileMultiple('partner_images');
        $path = 'public/front/images/partner_images/';
        $imagesArr = array();

        foreach ($files as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $filename = time() . '_' . $file->getClientName();
                $file->move($path, $filename);
                $img = 'public/front/images/partner_images/' . $filename;
                // add the image path to an array to save in the database later
                $imagesArr[] = $img;
            }
        }
        // check if new images were uploaded before overwriting old images
        if (!empty($imagesArr)) {
            // merge the array of image paths into a comma-separated string
            $settingsArr['partner_images'] = implode(',', $imagesArr);
        }

        $settings_data = $model->where('partner_id', $partner_id)->first();

        if ($settings_data) {
            if (!empty($settingsArr)) {
                $result = $model->update($settings_data['partner_id'], $settingsArr);
            } else {
                // no new images were uploaded, so keep the existing images
                $result = true;
            }
            if ($result) {
                $session->setFlashdata('success', 'Data Updated Succesfully');
                return redirect()->to('admin/partner_images');
            } else {
                $session->setFlashdata('error', 'Something Wrong');
                return redirect()->to('admin/partner_images');
            }
        } else {
            if (!empty($settingsArr)) {
                $result = $model->insert($settingsArr);
            } else {
                // no new images were uploaded, so there are no images to insert
                $result = true;
            }
            if ($result) {
                $session->setFlashdata('success', 'Data Added Succesfully');
                return redirect()->to('admin/partner_images');
            } else {
                $session->setFlashdata('error', 'Something Wrong');
                return redirect()->to('admin/partner_images');
            }
        }
    }
}
