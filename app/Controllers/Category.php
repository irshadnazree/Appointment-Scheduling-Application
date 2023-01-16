<?php 

namespace App\Controllers;

use App\Models\AptModel;
use App\Models\CategoryModel;

class Category extends BaseController
{
    public function addCategory()
    {
        if(!(session('userType') == 'admin'))
            return redirect()->to('/');

        $data = [];
        $data['page'] = 'Add Category';

        helper(['form']);

        if ($this->request->getPost()) {
            $rules = [
                'categoryName' => 'required|max_length[128]',
            ];

            $errors = [
                'categoryName' => [ 'required' => 'Category Name is required',
                                    'max_length' => 'Category must be less than {param} characters',
                ],
            ];
            

            if(!$this->validate($rules, $errors)){
                $data['validation'] = $this->validator;
            }else{
                $model = new CategoryModel();

                $newData = [
                    'categoryName' => $this->request->getVar('categoryName'),
                ];
                $model->save($newData);

                $session = session();
                $session->setFlashdata('success', 'Category Added Succesfully');

                return redirect()->to('dashboard');
                
            }
        }
        
        echo view('template/header', $data);
        echo view('category/addCategory');
        echo view('template/footer');
    }
    
    public function editCategory($categoryID)
    {
        if(!(session('userType') == 'admin'))
            return redirect()->to('/');

        $data = [];
        $data['page'] = 'Edit Category';
        
        helper(['form']);

        $model = new CategoryModel();

        if ($this->request->getPost()) {
            $rules = [
                'categoryName' => 'required|max_length[128]',
            ];

            $errors = [
                'categoryName' => ['required' => 'Category Name is required'
                ],
            ];
            

            if(!$this->validate($rules, $errors)){
                $data['validation'] = $this->validator;
            }else{
                $newData = [
                    'categoryID' => $categoryID,
                    'categoryName' => $this->request->getVar('categoryName'),
                ];
                $model->save($newData);
                
                $session = session();
                $session->setFlashdata('success', 'Category Updated Succesfully');

                return redirect()->to('dashboard');
                
            }
        }
        $data['category'] = $model->where('categoryID', $categoryID)->first();
        echo view('template/header', $data);
        echo view('category/editCategory', $data);
        echo view('template/footer');
    }

    public function deleteCategory($categoryID)
    {
        if(!(session('userType') == 'admin'))
            return redirect()->to('/login');
                    
        $aptModel = new AptModel();

        if(!$aptModel->checkAptExistCategory($categoryID))
        {
            $model = new CategoryModel();
            $model->delete(['categoryID' => $categoryID]);
            return redirect()->to('dashboard');

            $session = session();
            $session->setFlashdata('success', 'Company Deleted Successful');
        }

        $session = session();
        $session->setFlashdata('invalid', 'Unable to Delete Because of Existing Appointment');
        return redirect()->to('/dashboard');
    }
}