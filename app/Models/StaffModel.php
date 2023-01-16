<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffModel extends Model
{
    protected $table = 'staff';

    protected $primaryKey = 'staffID';

    protected $allowedFields = ['userID','companyID','staffStatus'];

    public function getStaffList($companyID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('staff');
        $builder->join('user','staff.userID = user.userID');

        $para = ['companyID' => $companyID, 'staffStatus' => 'Active'];
        $builder->where($para);

        return $builder->get()->getResultArray();
    }

    public function getStaffDetails($staffID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('staff');
        $builder->join('user','staff.userID = user.userID');
        return $builder->getWhere(['staffID' => $staffID])->getRowArray();
    }
}