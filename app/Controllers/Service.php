<?php 

namespace App\Controllers;

use App\Models\AptModel;
use App\Models\CategoryModel;
use App\Models\CompanyModel;
use App\Models\ScheduleDateModel;
use App\Models\ScheduleTimeModel;
use App\Models\ServiceModel;

class Service extends BaseController{
    public function viewService($serviceID)
    {
        $data = [];
        $data['page'] = 'Service Detail';

        $dateModel = new ScheduleDateModel();
        
        $week = [];
        $week['startDate'] = date('Y/m/d', strtotime("monday this week"));
        $week['endDate'] = date('Y/m/d', strtotime("sunday this week"));

        $data['date'] = $dateModel->getScheduleDateList($serviceID);
        $data['checkDate'] = $week;
        $data['currentDate'] = date('Y-m-d');

        $model = new ServiceModel();
        $data['service'] = $model->where('serviceID', $serviceID)->first();

        echo view('template/header', $data);
        echo view('service/viewService');
        echo view('template/footer');
    }
    
    public function serviceList()
    {        
        $data = [];
        $data['page'] = 'Service Detail';

        $companyModel = new CompanyModel();
        $data['company'] = $companyModel->getListCompany();
        
        echo view('template/header', $data);
        echo view('service/serviceList');
        echo view('template/footer');
    }

    public function addService($companyID)
    {
        if(!(session('userType') == 'owner') && !(session('userType') == 'staff'))
            return redirect()->to('/');

        $data = [];
        $data['page'] = 'Add Service';
        $data['company'] = $companyID;

        helper(['form']);
            
        if ($this->request->getPost()) {
            $rules = [
                'serviceName' => 'required|max_length[128]',
                'serviceDesc' => 'required|max_length[512]',
            ];

            $errors = [
                'serviceName' => [  'required' => 'Service Name is required',
                                    'max_length' => 'Service Name must be less than {param} characters',
                ], 
                'serviceDesc' =>[   'required' => 'Service Description is required',
                                    'max_length' => 'Service Description must be less than {param} characters',
                ]
            ];
            

            if(!$this->validate($rules, $errors)){
                $data['validation'] = $this->validator;
            }else{
                $model = new ServiceModel();

                $newData = [
                    'serviceName' => $this->request->getVar('serviceName'),
                    'serviceDesc' => $this->request->getVar('serviceDesc'),
                    'categoryID' => $this->request->getVar('category'),
                    'companyID' => $companyID,
                    'serviceStatus' => 'Active'
                ];
                $model->save($newData);

                $session = session();
                $session->setFlashdata('success', 'Service Added Succesfully');

                return redirect()->to('/companyDashboard/'.$companyID);
            }
        }
        
        $categoryModel = new CategoryModel();
        $data['category'] = $categoryModel->getCategoryList();

        echo view('template/header', $data);
        echo view('service/addService');
        echo view('template/footer');
    }

    public function editService($serviceID)
    {
        if(!(session('userType') == 'owner') && !(session('userType') == 'staff'))
            return redirect()->to('/');
        
        $data = [];
        $data['page'] = 'Edit Service';

        helper(['form']);

        $serviceModel = new ServiceModel();
        $service = $serviceModel->where('serviceID', $serviceID)->first();

        if ($this->request->getPost()) {
            $rules = [
                'serviceName' => 'required|max_length[128]',
                'serviceDesc' => 'required|max_length[512]',
            ];

            $errors = [
                'serviceName' => [  'required' => 'Service Name is required',
                                    'max_length' => 'Service Name must be less than {param} characters',
                ], 
                'serviceDesc' =>[   'required' => 'Service Description is required',
                                    'max_length' => 'Service Description must be less than {param} characters',
                ]
            ];
            

            if(!$this->validate($rules, $errors)){
                $data['validation'] = $this->validator;
            }else{
                $model = new ServiceModel();

                $newData = [
                    'serviceID' => $serviceID,
                    'serviceName' => $this->request->getVar('serviceName'),
                    'serviceDesc' => $this->request->getVar('serviceDesc'),
                    'categoryID' => $this->request->getVar('category')
                ];
                $model->save($newData);

                $session = session();
                $session->setFlashdata('success', 'Service Added Succesfully');

                return redirect()->to('/serviceDetail/'.$serviceID);
            }
        }
        
        $data['service'] = $service;

        $categoryModel = new CategoryModel();
        $data['category'] = $categoryModel->getCategoryList();


        echo view('template/header', $data);
        echo view('service/editService');
        echo view('template/footer');
    }
    
    public function deleteService($serviceID)
    {
        if(!(session('userType') == 'owner') && !(session('userType') == 'staff'))
            return redirect()->to('/');
        
        $ServiceModel = new ServiceModel();
        
        $serviceData = [
            'serviceID' => $serviceID,
            'serviceStatus' => 'Inactive'
        ];

        $ServiceModel->save($serviceData);
        
        $service = $ServiceModel->where('serviceID', $serviceID)->first();
        return redirect()->to('/companyDashboard/'.$service['companyID']);
    }
}