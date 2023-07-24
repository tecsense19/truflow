<?php

namespace App\Controllers\Admin;

use App\Models\SettingsModel;
use App\Models\SettingsImagesModel;
use CodeIgniter\Images\Image;


class SettingsController extends BaseController
{
    public function settings()
    {
        $settingsModel = new SettingsModel();
        $settingsImagesModel = new SettingsImagesModel();
        $welcomeData = $settingsModel->where('type', 'welcome')->first();
        $aboutData = $settingsModel->where('type', 'about')->first();
        $contactData = $settingsModel->where('type', 'contact')->first();
        $productData = $settingsModel->where('type', 'product')->first();
        $testominalData = $settingsModel->where('type', 'testominal')->first();
        $partnerData = $settingsModel->where('type', 'partner')->first();


        $imageData = $settingsImagesModel->where('setting_id', $welcomeData['setting_id'])->first();
        if (!$imageData) {
            $imageData = null;
        }

        $partnerImageData = $settingsImagesModel->where('setting_id', $partnerData['setting_id'])->find();
        if (!$partnerImageData) {
            $partnerImageData = null;
        }

       
        return view('admin/settings/settings', ['welcomeData' => $welcomeData, 'aboutData' => $aboutData, 'contactData' => $contactData, 'productData' => $productData, 'testominalData' => $testominalData, 'partnerData' => $partnerData, 'productData' => $productData, 'imageData' => $imageData, 'partnerImageData' => $partnerImageData
    ]);
    }
    public function settingsSave()
    {
        $settingsModel = new SettingsModel();
        $settingsImagesModel = new SettingsImagesModel();

        $session = session();
        $input = $this->request->getVar();
     
        $typeArr = ['welcome', 'about', 'contact', 'product', 'testominal', 'partner'];
   
        for ($i = 0; $i < count($typeArr); $i++) {
            $settingsArr = [];
            $settingsArr['title'] = isset($input[$typeArr[$i] . '_title']) ? $input[$typeArr[$i] . '_title'] : '';
            $settingsArr['sub_title'] = isset($input[$typeArr[$i] . '_sub_title']) ? $input[$typeArr[$i] . '_sub_title'] : '';
            $settingsArr['description'] = isset($input[$typeArr[$i] . '_description']) ? $input[$typeArr[$i] . '_description'] : '';
            $settingsArr['button_text'] = isset($input[$typeArr[$i] . '_button_text']) ? $input[$typeArr[$i] . '_button_text'] : '';
            $settingsArr['button_link'] = isset($input[$typeArr[$i] . '_button_link']) ? $input[$typeArr[$i] . '_button_link'] : '';

            $settingsArr['type'] = isset($typeArr[$i]) ? $typeArr[$i] : '';

            if (isset($input[$typeArr[$i] . '_setting_id']) && $input[$typeArr[$i] . '_setting_id'] != '') {
                $settingsModel->update(['setting_id', $input[$typeArr[$i] . '_setting_id']], $settingsArr);
                $lastId = $input[$typeArr[$i] . '_setting_id'];
            } else {
                $lastId = $settingsModel->insert($settingsArr);
            }
            if($typeArr[$i] == 'welcome'){

                $this->settingImages($lastId, $typeArr[$i]);
            }
            if($typeArr[$i] == 'partner'){
                $this->partnerImages($lastId, $typeArr[$i], $input['partner_site_link'], $input['partner_site_link_id']);
            }
            
        }
        $session->setFlashdata('success', 'Settings change succesfully.');
        return redirect()->to('admin/settings');
    }
    public function settingImages($lastId, $typeArr)
    {

        $settingsImagesModel = new SettingsImagesModel();

        if ($file = $this->request->getFile($typeArr . '_image_path')) {
            $path = 'public/front/images/home/';
            if ($file->getClientName()) {

                if ($lastId) {
                    $getUserDetails = $settingsImagesModel->where('setting_id', $lastId)->first();
                    if ($getUserDetails) {
                        $proFilePath = $getUserDetails['image_path'];
                        $proPath = substr(strstr($proFilePath, 'public/front/images/home/'), strlen('public/front/images/home/'));
                        if (file_exists(($proPath))) {
                            unlink(($proPath));
                        }
                        $settingsImagesModel->where('setting_id', $lastId)->delete();
                    }
                }

                $filename = time() . '_bannerImg_' . $file->getClientName();
                $file->move($path, $filename);
                $img = imagecreatefromstring(file_get_contents($path . $filename));
                $new_width = 500;
                $new_height = 670;
                $image_p = imagecreatetruecolor($new_width, $new_height);
                imagecopyresampled($image_p, $img, 0, 0, 0, 0, $new_width, $new_height, imagesx($img), imagesy($img));
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                $new_filename = time() . '_bannerImg_' . mt_rand() . '.' . $extension;
                if ($extension == 'jpg' || $extension == 'jpeg') {
                    imagejpeg($image_p, $path . $new_filename, 100);
                } elseif ($extension == 'png') {
                    imagepng($image_p, $path . $new_filename);
                } elseif ($extension == 'gif') {
                    imagegif($image_p, $path . $new_filename);
                } else {
                    echo ("Unsupported file format");
                }
                $settingImg['image_path'] = 'public/front/images/home/' . $new_filename;
                $settingImg['setting_id'] = $lastId;
                $settingsImagesModel->insert($settingImg);

                // Delete the original image file
                unlink($path . $filename);
            }
        }
    }

    public function partnerImages($lastId, $typeArr, $image_link, $image_id){

        $settingsImagesModel = new SettingsImagesModel();

        // Assuming you have loaded the model and the arrays as $image_id and $image_link
        // Loop through the $image_id array

        foreach ($image_link as $key => $value) 
        {
            $filename = '';
            $path = 'public/front/images/partner_images/';
            $files = $_FILES[$typeArr.'_image_path'];
            $file = new \CodeIgniter\HTTP\Files\UploadedFile($files['tmp_name'][$key], $files['name'][$key], $files['type'][$key], $files['size'][$key], $files['error'][$key]);
            if ($file->getClientName()) {
                $filename = time() . '_bannerImg_' . $file->getClientName();
                $file->move($path, $filename);
    
                // Resize the image to 500x500 pixels
                // $image = \Config\Services::image()
                //     ->withFile($path . $filename)
                //     ->resize(500, 500)
                //     ->save($path . $filename);
            
                
                // $settingImg['image_path'] = 'public/front/images/partner_images/' . $filename;
    
                // $settingImg['setting_id'] = $lastId;
                //     // print_r($settingImg['image_path']);
                //     // die;
                // $settingsImagesModel->insert($settingImg);
            }
            if(isset($image_id[$key]))
            {
                     // If the record exists, update the image_link
                     $data = array(
                        'image_link' => $value
                    );
                    if($filename)
                    {
                        $data['image_path'] = 'public/front/images/partner_images/' . $filename;
                    }                    
                    $settingsImagesModel->where('image_id', $image_id[$key])->set($data)->update();
            }else{
                $data = array(
                    'image_path' => 'public/front/images/partner_images/' . $filename,
                    'setting_id' => $lastId,
                    'image_link' => $value
                );
                $settingsImagesModel->insert($data);
            }

        }

    }

    // public function delete_partner_img(){
    //     $session = session();
    //     $input = $this->request->getVar();

    //     $settingsImagesModel = new SettingsImagesModel();
    //     $settingsImagesModel->delete($input['image_id']);
    
    //     $session->setFlashdata('success', 'Image Delete succesfully.');
    //     return redirect()->back();
     
       
    // }
    public function delete_partner_img()
{
    $session = session();
    $input = $this->request->getVar();

    $settingsImagesModel = new SettingsImagesModel();
    $image = $settingsImagesModel->find($input['image_id']); 
    $imagePath = $image['image_path']; 
    // Delete the image file from the folder
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    $settingsImagesModel->delete($input['image_id']);

    $session->setFlashdata('success', 'Image deleted successfully.');
    return redirect()->back();
}


}
