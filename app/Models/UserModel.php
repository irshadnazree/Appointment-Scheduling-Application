<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';

    protected $primaryKey   = 'userID'; 

    protected $allowedFields = ['email','firstName','lastName','personalID','phoneNumber','password','userStatus'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data){
        $data = $this->passwordHash($data);
        return $data;
    }

    protected function beforeUpdate(array $data){
        $data = $this->passwordHash($data);
        return $data;
    }

    protected function passwordHash(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'] ,PASSWORD_DEFAULT);
        }

        return $data;
    }

    public function checkUserType($userID) {
        $db = \Config\Database::connect();

        if ($db->query("SELECT * FROM `admin` WHERE userID = $userID")->getRow())
            return 'admin';
        elseif ($db->query("SELECT * FROM `company` WHERE userID = $userID AND companyStatus = 'Active'")->getRow())
            return 'owner';
        elseif ($db->query("SELECT * FROM `staff` WHERE userID = $userID")->getRow())
            return 'staff';
        elseif ($db->query("SELECT * FROM `customer` WHERE userID = $userID")->getRow())
            return 'customer';
    }

    public function checkEmailExist($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user');

        $para = ['userID' => session('userID'), 'email' => $email];
        $builder->where($para);

        return $builder->get()->getRowArray();
    }

    public function checkIDTrue($email, $personalID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user');

        $para = ['email' => $email, 'personalID' => $personalID];
        $builder->where($para);

        return $builder->get()->getRowArray();
    }

    public function insertCustomer($userID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('customer');
        $data= [
            'userID' => $userID
        ];
        $builder->insert($data);
    }

    public function getCustomerDetail($userID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('customer');
        return $builder->getWhere(['userID' => $userID])->getRowArray();
    }

    public function getAdminList()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->join('admin','user.userID = admin.userID');
        return $builder->get()->getResultArray();
    }
    
    public function getOwnerList()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->join('company','user.userID = company.userID');
        $builder->distinct('company.userID');
        $builder->groupBy('company.userID');
        return $builder->get()->getResultArray();
    }

    public function getStaffList()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->join('staff','user.userID = staff.userID');
        return $builder->get()->getResultArray();
    }

    public function getCustomerList()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->join('customer','user.userID = customer.userID');
        return $builder->get()->getResultArray();
    }

    public function getUserDetail($userID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user');

        $para = ['userID' => $userID];
        $builder->where($para);

        return $builder->get()->getRowArray();
    }
}
