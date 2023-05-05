<?php

namespace App\Controllers\Admin;

use App\Models\SettingsModel;

class SettingsController extends BaseController
{
    public function settings()
    {
        $model = new SettingsModel();
        $settings_data = $model->where('siteid', 1)->first();
        return view('admin/settings/settings', ['settings_data' => $settings_data]);
    }
    public function settings_add_edit()
    {
        $model = new SettingsModel();
        $session = session();
        $input = $this->request->getVar();


        $siteid = $input['siteid'];
        $title = $input['title'];
        $sub_title = $input['sub_title'];
        $description = $input['description'];

        $userInfo = [
            'title' => $title,
            'sub_title' => $sub_title,
            'description' => $description
        ];

        $settings_data = $model->where('siteid', $siteid)->first();

        if ($settings_data) {
            $result = $model->update($settings_data['siteid'], $userInfo);
            if ($result > 0) {
                $session->setFlashdata('success', 'Data Updated Succesfully');
                return redirect()->to('admin/settings');
            } else {
                $session->setFlashdata('error', 'Something Wrong');
                return redirect()->to('admin/settings');
               
            }
        } else {

            $result = $model->insert($userInfo);
            if ($result > 0) {
                $session->setFlashdata('success', 'Data Added Succesfully');
                return redirect()->to('admin/settings');
            } else {
                $session->setFlashdata('error', 'Something Wrong');
                return redirect()->to('admin/settings');
                
            }
        }

    }
}
