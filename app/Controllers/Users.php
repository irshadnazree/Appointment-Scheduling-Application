<?php

namespace App\Controllers;

use App\Models\AptModel;
use App\Models\CategoryModel;
use App\Models\CompanyModel;
use App\Models\userModel;

class Users extends BaseController
{    
    public function logout()
    {
        session()->destroy();
		return redirect()->to('/');
    }

    public function login()
    {
        $data = [];
        $data['page'] = 'Login';

        helper(['form']);
        
        if ($this->request->getPost()) {
            $rules = [
                'email' => 'required|valid_email|max_length[128]',
                'password' => 'required|min_length[5]|max_length[100]|validateUser[email,password]',
            ];

            $errors = [
                'email' => ['required' => 'Email is required',
                            'valid_email','max_length','is_unique' => 'Email is invalid',
                ],
                'password' => [ 'required' => 'Password is required',
                                'max_length' => 'Password must be less than 100 characters',
                                'min_length' => 'Password must be more than 5 characters',
                                'validateUser' => 'Email or Password is incorrect'
                ],
            ];
            

            if(!$this->validate($rules, $errors)){
                $data['validation'] = $this->validator;
            }else{
                $model = new UserModel();

                $user = $model->where('email', $this->request->getVar('email'))
                            ->first();

                $this->setUserSession($user);
                $session = session();
                $session->setFlashdata('success', 'Login Successful');
                return redirect()->to('dashboard');
                
            }
        }

        echo view('template/header', $data);
        echo view('user/login', $data);
        echo view('template/footer');
    }

    private function setUserSession($user)
    {
        $model = new userModel();

        $data = [
			'userID' => $user['userID'],
			'firstName' => $user['firstName'],
			'lastName' => $user['lastName'],
			'email' => $user['email'],
			'isLoggedIn' => true,
            'userType' => $model->checkUserType($user['userID'])
		];

		session()->set($data);
		return true;
    }

    public function register()
    {
        $data = [];
        $data['page'] = 'User Registration';
        helper(['form']);

        if ($this->request->getPost()) {
            $rules = [
                'email' => 'required|valid_email|max_length[128]|is_unique[user.email]',
                'firstName' => 'required|min_length[2]|max_length[100]',
                'lastName' => 'required|min_length[2]|max_length[100]',
                'personalID' => 'required|min_length[8]|max_length[100]|numeric',
                'phone' => 'required|min_length[10]|max_length[11]|numeric',
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
                $model = new UserModel();
                $newData = [
                    'email' => $this->request->getVar('email'),
                    'firstName' => $this->request->getVar('firstName'),
                    'lastName' => $this->request->getVar('lastName'),
                    'personalID' => $this->request->getVar('personalID'),
                    'phoneNumber' => $this->request->getVar('phone'),
                    'password' => $this->request->getVar('password'),
                    'userStatus' => 'Active'
                ];
                $model->save($newData);

                $userID = $model->insertID();
                $model->insertCustomer($userID);

				$session = session();
				$session->setFlashdata('success', 'Account Registered Successful');
				return redirect()->to('/login');;
            }
        }
        
        echo view('template/header', $data);
        echo view('user/register');
        echo view('template/footer');
    }

    public function dashboard()
    {
        $aptModel = new AptModel();
        $aptArchiveDate = $aptModel->checkAptDate();

        foreach($aptArchiveDate as $aptDt){
            $aptArchivTime = $aptModel->checkAptTime($aptDt['aptID']);
            foreach($aptArchivTime as $aptTm){
                $newData = [
                    'aptID' => $aptTm['aptID'],
                    'aptStatus' => 'Cancelled',
                ];
                $aptModel->save($newData);
            }
        }

        if(!session('isLoggedIn'))
            return redirect()->to('/login');

        $data = [];

        $data['page'] = 'Dashboard';

        $userModel = new userModel();
        $data['user'] = $userModel->where('userID', session('userID'))->first();

        $companyModel = new CompanyModel();
        $data['company'] = $companyModel->getCompanyApp();
        $data['companyOwnList'] = $companyModel->getCompanyOwn(session('userID'));
        $data['companyPending'] = $companyModel->getCompanyPending(session('userID'));

        $categoryModel = new CategoryModel();
        $data['category'] = $categoryModel->getCategoryList();

        if (session('userType') == 'owner') {
            $aptList = $aptModel->getUpAptListOwner(session('userID'));
            $data['aptList'] = $aptList;

            $aptHistory = $aptModel->getAptRecordOwner(session('userID'));
            $data['aptHistory'] = $aptHistory;
        }
        
        if (session('userType') == 'staff') {
            $aptList = $aptModel->getUpAptListStaff(session('userID'));
            $data['aptList'] = $aptList;

            $aptHistory = $aptModel->getAptRecordStaff(session('userID'));
            $data['aptHistory'] = $aptHistory;
        }

        if (session('userType') == 'customer') {
            $customer = $userModel->getCustomerDetail(session('userID'));
            $data['appointment'] = $aptModel->getApt($customer['customerID']);

            $aptHistory = $aptModel->getAptRecordCustomer(session('userID'));
            $data['aptHistory'] = $aptHistory;
        }

        echo view('template/header', $data);
        echo view('user/dashboard');
        echo view('template/footer');
    }

    public function profile()
    {
        if(!session('isLoggedIn'))
            return redirect()->to('/login');

        $data = [];

        $data['page'] = 'Profile';

        $model = new userModel();
        $data['user'] = $model->where('userID', session('userID'))->first();

        echo view('template/header', $data);
        echo view('user/profile');
        echo view('template/footer');
    }

    public function editProfile()
    {
        if(!session('isLoggedIn'))
            return redirect()->to('/login');

        $data = [];

        $data['page'] = 'Update Profile';

        helper(['form']);

        $model = new userModel();

        if ($this->request->getPost()) {
            $rules = [
                'email' => 'required|valid_email|max_length[128]|is_exist[email]',
                'firstName' => 'required|min_length[2]|max_length[100]',
                'lastName' => 'required|min_length[2]|max_length[100]',
                'personalID' => 'required|min_length[5]|max_length[100]|numeric',
                'phone' => 'required|min_length[10]|max_length[12]|numeric',
            ];  
			if($this->request->getPost('password') != ''){
                $rules['password'] = 'required|min_length[5]|max_length[100]';
            }

            $errors = [
                'email' => ['required' => 'Email is required',
                            'valid_email','max_length','is_unique' => 'Email is invalid',
                            'is_exist' => 'Email already exist'
                ],
                'firstName' => ['required' => 'First Name is required',
                                'max_length' => 'First Name must be less than {param} characters',
                                'min_length' => 'First Name must be more than {param} characters'
                ],
                'lastName' => [ 'required' => 'Last Name is required',
                                'max_length' => 'Last Name must be less than {param} characters',
                                'min_length' => 'Last Name must be more than {param} characters'
                ],
                'personalID' => [   'required' => 'IC Number is required',
                                    'max_length' => 'IC Number must be less than {param} characters',
                                    'min_length' => 'IC Number must be more than {param} characters',
                                    'numeric' => 'IC Number must be numerical'
                ],
                'phone'         =>[ 'required' => 'IC Number is required',
                                    'max_length' => 'IC Number must be less than {param} characters',
                                    'min_length' => 'IC Number must be more than {param} characters',
                                    'numeric' => 'IC Number must be numerical'
                ],
                'password' => [ 'required' => 'Password is required',
                                'max_length' => 'Password must be less than {param} characters',
                                'min_length' => 'Password must be more than {param} characters',
                ],
            ];
            

            if (!$this->validate($rules,$errors)) {
				$data['validation'] = $this->validator;
			}else{
                $newData = [
                    'email' => $this->request->getPost('email'),
                    'firstName' => $this->request->getPost('firstName'),
                    'lastName' => $this->request->getPost('lastName'),
                    'personalID' => $this->request->getPost('personalID'),
                    'phoneNumber' => $this->request->getVar('phone'),
                ];
                if($this->request->getPost('password') != ''){
                    $newData['password'] = $this->request->getPost('password');
                }
                $model->update(session('userID'),$newData);
                session()->setFlashdata('success', 'Successfuly Updated');
				return redirect()->to('/profile');
            }
        }
        $data['user'] = $model->where('userID', session('userID'))->first();
        echo view('template/header', $data);
        echo view('user/editProfile');
        echo view('template/footer');
    }

    public function userList()
    {
        $data = [];
        $data['page'] = 'Service Detail';

        $userModel = new userModel();
        $data['admin'] = $userModel->getAdminList();
        $data['owner'] = $userModel->getOwnerList();
        $data['staff'] = $userModel->getStaffList();
        $data['customer'] = $userModel->getCustomerList();
        
        echo view('template/header', $data);
        echo view('user/userList');
        echo view('template/footer');
    }

    public function viewUser($userID)
    {
        $data = [];
        $data['page'] = 'User Detail';

        $userModel = new userModel();
        $data['user'] = $userModel->getUserDetail($userID);

        echo view('template/header', $data);
        echo view('user/viewUser');
        echo view('template/footer');
    }

    public function userConfirm()
    {
        $data = [];

        $data['page'] = 'Update Profile';

        helper(['form']);

        $model = new userModel();

        if ($this->request->getPost()) {
            $rules = [
                'email' => 'required|valid_email|max_length[128]',
                'personalID' => 'required|min_length[5]|max_length[100]|numeric',
            ];
            $errors = [
                'email' => ['required' => 'Email is required',
                            'valid_email','max_length' => 'Email is invalid',
                ],
                'personalID' => [   'required' => 'IC Number is required',
                                'max_length' => 'IC Number must be less than {param} characters',
                                'min_length' => 'IC Number must be more than {param} characters',
                                'numeric' => 'IC Number must be numerical'
                ],
            ];

            if (!$this->validate($rules,$errors)) {
                $data['validation'] = $this->validator;
			}else{
                $user = $model->checkIDTrue($this->request->getPost('email'),$this->request->getPost('personalID'));
                if($user)
                    return redirect()->to('/changePassword/'.$user['userID']);
                else
                    session()->setFlashdata('Invalid', 'Incorrect Email or PersonalID');
            }
        }

        echo view('template/header', $data);
        echo view('user/userConfirm');
        echo view('template/footer');
    }

    public function resetPassword($userID)
    {
        $data = [];
        $data['userID'] = $userID;
        $data['page'] = 'Update Profile';

        helper(['form']);

        $model = new userModel();

        if ($this->request->getPost()) {
			if($this->request->getPost('password')){
                $rules['password'] = 'required|min_length[5]|max_length[100]';
            }

            $errors = [
                'password' => [ 'required' => 'Password is required',
                                'max_length' => 'Password must be less than {param} characters',
                                'min_length' => 'Password must be more than {param} characters',
                ],
            ];
            

            if (!$this->validate($rules,$errors)) {
				$data['validation'] = $this->validator;
			}else{
                $newData = [
                    'password' => $this->request->getPost('password'),
                ];
                $model->update($userID,$newData);
                session()->setFlashdata('success', 'Successfuly Updated');
				return redirect()->to('/profile');
            }
        }
        $data['user'] = $model->where('userID', session('userID'))->first();
        echo view('template/header', $data);
        echo view('user/resetPassword');
        echo view('template/footer');
    }
}
