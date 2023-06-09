<?php

namespace App\Controllers\Admin;

use App\Models\UserContactModel;

class ContactUsController extends BaseController
{
    public function index()
    {
        $contactusmodel = new UserContactModel();
        $contactusData = $contactusmodel->find();
        if (!$contactusData) {
            $contactusData = null;
        }
        return view('admin/contactus/contactus_list', ['contactusData' => $contactusData]);
    }


    public function contactusDelete($contact_id)
    {
        $session = session();
        $contactusmodel = new UserContactModel();
        $contactusmodel->delete($contact_id);
        $session->setFlashdata('success', 'Delete succesfully.');
        return redirect()->to('admin/contactus_list');
    }
}
