<?php

namespace App\Controllers\Admin;

use App\Models\CompanyModel;

class CompanyController extends BaseController
{
    public function index()
    {
        $companymodel = new CompanyModel();
        $companyData = $companymodel->find();
        if (!$companyData) {
            $companyData = null;
        }
        return view('admin/company/company_list', ['companyData' => $companyData]);
    }
    public function company()
    {
        $companymodel = new CompanyModel();
        return view('admin/company/company');
    }
    public function companySave()
    {

        $companymodel = new CompanyModel();
        $session = session();
        $input = $this->request->getVar();
        $company_id = $input['company_id'];

        $companyArr = [];

        $companyArr['company_name'] = isset($input['company_name']) ? $input['company_name'] : '';
      

        if (isset($input['company_id']) && $input['company_id'] != '') {
            $companymodel->update(['company_id', $input['company_id']], $companyArr);
        } else {
            $companymodel->insert($companyArr);
        }

        $session->setFlashdata('success', 'company change succesfully.');
        return redirect()->to('admin/company_list');
       
    }
    public function companyEdit($company_id)
    {

        $companymodel = new CompanyModel();
        $companyData = $companymodel->find($company_id);

        if (!$companyData) {
            $companyData = null;
        }
        return view('admin/company/company', ['companyData' => $companyData]);
    }
    public function companyDelete($company_id)
{
    $session = session();
    $companymodel = new CompanyModel();
    $companymodel->delete($company_id);
    $session->setFlashdata('success', 'company Delete succesfully.');
    return redirect()->to('admin/company_list');
}

}
