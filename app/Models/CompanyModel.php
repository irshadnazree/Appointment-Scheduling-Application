<?php

namespace App\Models;

use App\Controllers\Company;
use CodeIgniter\Model;

class CompanyModel extends Model
{
    protected $table = 'company';

    protected $primaryKey = 'companyID'; 

    protected $allowedFields = ['userID','companyName','companyDesc','companyAddress','companyPostcode','companyState','companyPhone','companyStatus'];
    
    public function getCompanyApp()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('company');
        $companyList = $builder->getWhere(['companyStatus'=>'Pending'])->getResultArray();
        return $companyList;
    }

    public function getCompanyPending($userID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('company');

        $para = ['userID' => $userID, 'companyStatus' => 'Pending'];
        $builder->where($para);

        return $builder->get()->getResultArray();
    }

    public function getCompanyOwn($userID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('company');

        $para = ['userID' => $userID, 'companyStatus' => 'Active'];
        $builder->where($para);

        return $builder->get()->getResultArray();
    }
    public function getListCompany()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('company');
        return $builder->getWhere(['companyStatus'=>'Active'])->getResultArray();
    }

    public function getCompanyList()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('company');
        return $builder->get()->getResultArray();
    }

}
