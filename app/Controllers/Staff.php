<?php 

namespace App\Controllers;

use App\Models\StaffModel;
use App\Models\UserModel;

class Staff extends BaseController
{
    public function viewStaff($staffID)
    {
        $data = [];
        $data['page'] = 'Staff Detail';

        $staffModel = new StaffModel();
        $data['user'] = $staffModel->getStaffDetails($staffID);

        echo view('template/header', $data);
        echo view('staff/viewStaff');
        echo view('template/footer');
    }

    public function addStaff($companyID)
    {
        if(!(session('userType') == 'owner'))
            return redirect()->to('/');

        $data = [];
        $data['page'] = 'Staff Registration';
        $data['company'] = $companyID;
        
        helper(['form']);

        if ($this->request->getPost()) {
            $rules = [
                'email' => 'required|valid_email|max_length[128]|is_unique[user.email]',
                'firstName' => 'required|min_length[2]|max_length[100]',
                'lastName' => 'required|min_length[2]|max_length[100]',
                'personalID' => 'required|min_length[8]|max_length[100]|numeric',
                'phone' => 'required|min_length[10]|max_length[12]|numeric',
                'password' => 'required|min_length[5]|max_length[100]',
            ];

            $errors = [
                'email'         =>[ 'required' => 'Email is required',
                                    'valid_email','max_length','is_unique' => 'Email is invalid',
                ],
                'firstName'     =>[ 'required' => 'First Name is required',
                                    'max_length' => 'First Name must be less than {param} characters',
                                    'min_length' => 'First Name must be more than {param} characters'
                ],
                'lastName'      =>[ 'required' => 'Last Name is required',
                                    'max_length' => 'Last Name must be less than {param} characters',
                                    'min_length' => 'Last Name must be more than {param} characters'
                ],
                'personalID'    =>[ 'required' => 'IC Number is required',
                                    'max_length' => 'IC Number must be less than {param} characters',
                                    'min_length' => 'IC Number must be more than {param} characters',
                                    'numeric' => 'IC Number must be numerical'
                ],
                'phone'         =>[ 'required' => 'IC Number is required',
                                    'max_length' => 'IC Number must be less than {param} characters',
                                    'min_length' => 'IC Number must be more than {param} characters',
                                    'numeric' => 'IC Number must be numerical'
                ],
                'password'      =>[ 'required' => 'Password is required',
                                    'max_length' => 'Password must be less than {param} characters',
                                    'min_length' => 'Password must be more than {param} characters',
                ],
            ];
            

            if(!$this->validate($rules, $errors)){
                $data['validation'] = $this->validator;
            }else{
                $userModel = new UserModel();
                $userData = [
                    'email' => $this->request->getVar('email'),
                    'firstName' => $this->request->getVar('firstName'),
                    'lastName' => $this->request->getVar('lastName'),
                    'personalID' => $this->request->getVar('personalID'),
                    'phoneNumber' => $this->request->getVar('phone'),
                    'password' => $this->request->getVar('password'),
                    'userStatus' => 'Active'
                ];
                $userModel->save($userData);
                $userID = $userModel->insertID();

                $staffModel = new StaffModel();
                $staffData = [
                    'userID' => $userID,
                    'companyID' => $companyID,
                    'staffStatus' => 'Active'
                ];
                $staffModel->save($staffData);

				$session = session();
				$session->setFlashdata('success', 'Staff Registered Successful');
				return redirect()->to('/companyDashboard/'.$companyID);;
            }
        }

        echo view('template/header', $data);
        echo view('staff/addStaff');
        echo view('template/footer');
    }

    public function editStaff($staffID)
    {
        if(!(session('userType') == 'owner'))
            return redirect()->to('/');

        $data = [];
        $data['page'] = 'Edit Staff';
        
        helper(['form']);

        $staffModel = new staffModel();
        $staff = $staffModel->where('staffID', $staffID)->first();

        if ($this->request->getPost()) {
            $rules = [
                'email' => 'required|valid_email|max_length[128]',
                'firstName' => 'required|min_length[2]|max_length[100]',
                'lastName' => 'required|min_length[2]|max_length[100]',
                'personalID' => 'required|min_length[8]|max_length[100]|numeric',
                'phone' => 'required|min_length[10]|max_length[12]|numeric',
            ];

            $errors = [
                'email'         =>[ 'required' => 'Email is required',
                                    'valid_email','max_length','is_unique' => 'Email is invalid',
                ],
                'firstName'     =>[ 'required' => 'First Name is required',
                                    'max_length' => 'First Name must be less than {param} characters',
                                    'min_length' => 'First Name must be more than {param} characters'
                ],
                'lastName'      =>[ 'required' => 'Last Name is required',
                                    'max_length' => 'Last Name must be less than {param} characters',
                                    'min_length' => 'Last Name must be more than {param} characters'
                ],
                'personalID'    =>[ 'required' => 'IC Number is required',
                                    'max_length' => 'IC Number must be less than {param} characters',
                                    'min_length' => 'IC Number must be more than {param} characters',
                                    'numeric' => 'IC Number must be numerical'
                ],
                'phone'         =>[ 'required' => 'IC Number is required',
                                    'max_length' => 'IC Number must be less than {param} characters',
                                    'min_length' => 'IC Number must be more than {param} characters',
                                    'numeric' => 'IC Number must be numerical'
                ],
            ];
            

            if(!$this->validate($rules, $errors)){
                $data['validation'] = $this->validator;
            }else{
                $userModel = new UserModel();

                $userData = [
                    'userID' => $staff['userID'],
                    'email' => $this->request->getVar('email'),
                    'firstName' => $this->request->getVar('firstName'),
                    'lastName' => $this->request->getVar('lastName'),
                    'personalID' => $this->request->getVar('personalID'),
                    'phoneNumber' => $this->request->getVar('phone'),
                    'password' => $this->request->getVar('password'),
                    'userStatus' => 'Active'
                ];
                $userModel->save($userData);

				$session = session();
				$session->setFlashdata('success', 'Staff Details Updated Successful');
				return redirect()->to('/companyDashboard/'.$staff['companyID']);
            }
        }

        $data['user'] = $staffModel->getStaffDetails($staffID);

        echo view('template/header', $data);
        echo view('staff/editStaff');
        echo view('template/footer');
    }

    public function deleteStaff($staffID)
    {
        if(!(session('userType') == 'owner'))
            return redirect()->to('/');
        
        $staffModel = new staffModel();
        
        $staffData = [
            'staffID' => $staffID,
            'staffStatus' => 'Inactive'
        ];

        $staffModel->save($staffData);
        
        $staff = $staffModel->where('staffID', $staffID)->first();
        return redirect()->to('/companyDashboard/'.$staff['companyID']);
    }
}