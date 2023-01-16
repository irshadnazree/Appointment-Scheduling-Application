<?php

namespace App\Controllers;

use App\Models\AptModel;
use App\Models\CompanyModel;
use App\Models\ServiceModel;
use App\Models\StaffModel;

class Company extends BaseController{
    public function addCompany()
    {
        if(!(session('isLoggedIn')))
            return redirect()->to('/');

        $data = [];
        $data['page'] = 'Company Registration';

        helper(['form']);

        if ($this->request->getPost()) {
            $rules = [
                'companyName' => 'required|min_length[3]|max_length[128]',
                'companyDesc' => 'required|min_length[3]|max_length[512]',
                'address' => 'required|min_length[5]|max_length[100]',
                'postcode' => 'required|min_length[5]|max_length[5]',
                'state' => 'required|min_length[4]|max_length[100]',
                'phone' => 'required|min_length[10]|max_length[11]|numeric',
            ];

            $errors = [
                'companyName' => [  'required' => 'Company name is required',
                                    'max_length' => 'Company name must be less than {param} characters',
                                    'min_length' => 'Company name must be more than {param} characters'
                ],
                'companyDesc' => [  'required' => 'Company description is required',
                                    'max_length' => 'Company description must be less than {param} characters',
                                    'min_length' => 'Company description must be more than {param} characters'
                ],
                'address' => [  'required' => 'Address is required',
                                'max_length' => 'Address must be less than {param} characters',
                                'min_length' => 'Address must be more than {param} characters'
                ],
                'postcode' => [ 'required' => 'Postcode is required',
                                'max_length' => 'Postcode must be {param} characters',
                                'min_length' => 'Postcode must be {param} characters'
                ],
                'state' => [    'required' => 'State is required',
                                'max_length' => 'State must be less than {param} characters',
                                'min_length' => 'State must be more than {param} characters',
                ],
                'phone' => [    'required' => 'Phone Number is required',
                                'max_length' => 'Phone Number must be less than {param} characters',
                                'min_length' => 'Phone Number must be more than {param} characters',
                                'numeric' => 'Phone Number must be numerical'
                ],
            ];
            
            if(!$this->validate($rules, $errors)){
                $data['validation'] = $this->validator;
            }else{
                $companyModel = new CompanyModel();
                $newData = [
                    'userID' => session('userID'),
                    'companyName' => $this->request->getVar('companyName'),
                    'companyDesc' => $this->request->getVar('companyDesc'),
                    'companyAddress' => $this->request->getVar('address'),
                    'companyPostcode' => $this->request->getVar('postcode'),
                    'companyState' => $this->request->getVar('state'),
                    'companyPhone' => $this->request->getVar('phone'),
                    'companyStatus' => 'Pending'
                ];
                $companyModel->save($newData);

				$session = session();
				$session->setFlashdata('success', 'Company Registered Successful');
				return redirect()->to('/dashboard');
            }
        }

        echo view('template/header', $data);
        echo view('company/addCompany');
        echo view('template/footer');
    }

    public function viewCompany($companyID)
    {
        $data = [];
        $data['page'] = 'Company Dashboard';

        $companyModel = new CompanyModel();
        $data['companyDetail'] = $companyModel->where('companyID', $companyID)->first();

        $staffModel = new StaffModel();
        $data['staff'] = $staffModel->getStaffList($companyID);

        $ServiceModel = new ServiceModel();
        $data['service'] = $ServiceModel->getServiceList($companyID);

        echo view('template/header', $data);
        echo view('company/viewCompany');
        echo view('template/footer');
    }

    public function companyAnal($companyID)
    {
        $data = [];
        $data['page'] = 'Company Dashboard';

        $companyModel = new CompanyModel();
        $data['companyDetail'] = $companyModel->where('companyID', $companyID)->first();

        $ServiceModel = new ServiceModel(); 
        $data['service'] = $ServiceModel->getServiceList($companyID);
        
        echo view('template/header', $data);
        echo view('company/companyAnal');
        echo view('template/footer');
    }

    public function companyList()
    {
        if(!(session('userType') == 'admin'))
        return redirect()->to('/');

        $data = [];
        $data['page'] = 'Company List';

        $companyModel = new CompanyModel();
        $data['company'] = $companyModel->getCompanyList();

        echo view('template/header', $data);
        echo view('company/companyList');
        echo view('template/footer');
    }

    public function editCompany($companyID)
    {
        if(!(session('userType') == 'owner'))
            return redirect()->to('/');

        $data = [];
        $data['page'] = 'Company Detail';

        helper(['form']);

        $model = new CompanyModel();
        $data['companyDetail'] = $model->where('companyID', $companyID)->first();

        if ($this->request->getPost()) {
            $rules = [
                'companyName' => 'required|min_length[3]|max_length[128]',
                'companyDesc' => 'required|min_length[3]|max_length[512]',
                'address' => 'required|min_length[5]|max_length[100]',
                'postcode' => 'required|min_length[5]|max_length[5]',
                'state' => 'required|min_length[4]|max_length[100]',
                'phone' => 'required|min_length[10]|max_length[11]|numeric',
            ];

            $errors = [
                'companyName' => [  'required' => 'Company is required',
                                    'max_length' => 'Company must be less than {param} characters',
                                    'min_length' => 'Company must be more than {param} characters'
                ],
                'companyDesc' => [  'required' => 'Company description is required',
                                'max_length' => 'Company description must be less than {param} characters',
                                'min_length' => 'Company description must be more than {param} characters'
                ],
                'address' => [  'required' => 'Address is required',
                                'max_length' => 'Address must be less than {param} characters',
                                'min_length' => 'Address must be more than {param} characters'
                ],
                'postcode' => [ 'required' => 'Postcode is required',
                                'max_length' => 'Postcode must be {param} characters',
                                'min_length' => 'Postcode must be {param} characters'
                ],
                'state' => [    'required' => 'State is required',
                                'max_length' => 'State must be less than {param} characters',
                                'min_length' => 'State must be more than {param} characters',
                ],
                'phone' => [    'required' => 'Phone Number is required',
                                'max_length' => 'Phone Number must be less than {param} characters',
                                'min_length' => 'Phone Number must be more than {param} characters',
                                'numeric' => 'Phone Number must be numerical'
                ],
            ];
            
            if(!$this->validate($rules, $errors)){
                $data['validation'] = $this->validator;
            }else{
                $newData = [
                    'companyID' => $companyID,
                    'companyName' => $this->request->getVar('companyName'),
                    'companyDesc' => $this->request->getVar('companyDesc'),
                    'companyAddress' => $this->request->getVar('address'),
                    'companyPostcode' => $this->request->getVar('postcode'),
                    'companyState' => $this->request->getVar('state'),
                    'companyPhone' => $this->request->getVar('phone'),
                ];
                $model->save($newData);

				$session = session();
				$session->setFlashdata('success', 'Company Updated Successful');
			
                return redirect()->to('/companyDashboard/'.$companyID);
            }
        }
        echo view('template/header', $data);
        echo view('company/editCompany');
        echo view('template/footer');
    }

    public function acceptCompany($companyID)
    {
        if(!(session('userType') == 'admin'))
            return redirect()->to('/');

        $companyModel = new CompanyModel();

        $newData = [
            'companyID' => $companyID,
            'companyStatus' => 'Active'
        ];
        $companyModel->save($newData);
        return redirect()->to('/dashboard');
    }

    
    public function rejectCompany($companyID)
    {
        if(!(session('userType') == 'admin'))
            return redirect()->to('/');

        $companyModel = new CompanyModel();

        $newData = [
            'companyID' => $companyID,
            'companyStatus' => 'Rejected'
        ];
        $companyModel->save($newData);
        return redirect()->to('/dashboard');
    }

    public function deleteCompany($companyID)
    {
        if(!(session('userType') == 'owner'))
            return redirect()->to('/');
            
        $companyModel = new CompanyModel();
        $aptModel = new AptModel();

        if(!$aptModel->checkAptExistCompany($companyID))
        {
            $newData = [
                'companyID' => $companyID,
                'companyStatus' => 'Not Active'
            ];
            $companyModel->save($newData);

            $session = session();
            $session->setFlashdata('success', 'Company Deleted Successful');
            return redirect()->to('/dashboard');
        }
        $session = session();
        $session->setFlashdata('invalid', 'Unable to Delete Because of Existing Appointment');
        return redirect()->to('/dashboard');
    }
}