<?php

namespace App\Models;

use CodeIgniter\Model;

class AptModel extends Model
{
    protected $table = 'appointment';

    protected $primaryKey = 'aptID'; 

    protected $allowedFields = ['scheduleTimeID','customerID','aptStatus'];

    public function getApt($customerID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('appointment');
        $builder->join('scheduletime','appointment.scheduleTimeID = scheduletime.scheduleTimeID');
        $builder->join('scheduledate','scheduletime.scheduleDateID = scheduledate.scheduleDateID');
        $builder->join('service','scheduledate.serviceID = service.serviceID');

        $currentDate = date('Y-m-d');
        $currentTime = date('h:i:s');
        
        $para = ['customerID' => $customerID,'scheduleDate >=' => $currentDate,'scheduleStartTime >=' => $currentTime,'aptStatus' => 'Active'];
        $builder->where($para);

        return $builder->get()->getResultArray();
    } 

    public function getAptRecord($userID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('appointment');
        $builder->join('scheduletime','appointment.scheduleTimeID = scheduletime.scheduleTimeID');
        $builder->join('scheduledate','scheduletime.scheduleDateID = scheduledate.scheduleDateID');
        $builder->join('service','scheduledate.serviceID = service.serviceID');        
        $builder->join('customer','appointment.customerID = customer.customerID');
        $builder->join('user','user.userID = customer.userID');

        $para = ['customer.userID' => $userID, 'aptStatus !=' => 'Active'];
        $builder->where($para);

        return $builder->get()->getRowArray();
    }

    public function getUpAptListOwner($userID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('appointment');
        $builder->join('scheduletime','appointment.scheduleTimeID = scheduletime.scheduleTimeID');
        $builder->join('scheduledate','scheduletime.scheduleDateID = scheduledate.scheduleDateID');
        $builder->join('service','scheduledate.serviceID = service.serviceID');
        $builder->join('company','service.companyID = company.companyID');

        $para = ['company.userID' => $userID, 'aptStatus' => 'Active'];
        $builder->where($para);

        return $builder->get()->getResultArray();
    }

    public function getUpAptListStaff($userID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('appointment');
        $builder->join('scheduletime','appointment.scheduleTimeID = scheduletime.scheduleTimeID');
        $builder->join('scheduledate','scheduletime.scheduleDateID = scheduledate.scheduleDateID');
        $builder->join('service','scheduledate.serviceID = service.serviceID');
        $builder->join('company','service.companyID = company.companyID');
        $builder->join('staff','company.companyID = staff.companyID');

        $para = ['staff.userID' => $userID, 'aptStatus' => 'Active'];
        $builder->where($para);

        return $builder->get()->getResultArray();
    }
    
    public function getAptRecordOwner($userID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('appointment');
        $builder->join('scheduletime','appointment.scheduleTimeID = scheduletime.scheduleTimeID');
        $builder->join('scheduledate','scheduletime.scheduleDateID = scheduledate.scheduleDateID');
        $builder->join('service','scheduledate.serviceID = service.serviceID');
        $builder->join('company','service.companyID = company.companyID');

        $para = ['company.userID' => $userID, 'aptStatus !=' => 'Active'];
        $builder->where($para);

        return $builder->get()->getResultArray();
    }

    public function getAptRecordStaff($userID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('appointment');
        $builder->join('scheduletime','appointment.scheduleTimeID = scheduletime.scheduleTimeID');
        $builder->join('scheduledate','scheduletime.scheduleDateID = scheduledate.scheduleDateID');
        $builder->join('service','scheduledate.serviceID = service.serviceID');
        $builder->join('company','service.companyID = company.companyID');
        $builder->join('staff','company.companyID = staff.companyID');

        $para = ['staff.userID' => $userID, 'aptStatus !=' => 'Active'];
        $builder->where($para);

        return $builder->get()->getResultArray();
    }

    public function getAptRecordCustomer($userID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('appointment');
        $builder->join('scheduletime','appointment.scheduleTimeID = scheduletime.scheduleTimeID');
        $builder->join('scheduledate','scheduletime.scheduleDateID = scheduledate.scheduleDateID');
        $builder->join('service','scheduledate.serviceID = service.serviceID');        
        $builder->join('customer','appointment.customerID = customer.customerID');

        $currentTime = date('h:i:s');

        $para = ['customer.userID' => $userID,'aptStatus !=' => 'Active'];
        $builder->where($para);

        return $builder->get()->getResultArray();
    }

    public function getAptDetail($aptID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('appointment');
        $builder->join('scheduletime','appointment.scheduleTimeID = scheduletime.scheduleTimeID');
        $builder->join('scheduledate','scheduletime.scheduleDateID = scheduledate.scheduleDateID');
        $builder->join('service','scheduledate.serviceID = service.serviceID');

        $para = ['aptID' => $aptID, 'aptStatus' => 'Active'];
        $builder->where($para);

        return $builder->get()->getRowArray();
    }

    public function getAptCustName($timeID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('appointment');
        $builder->join('scheduletime','appointment.scheduleTimeID = scheduletime.scheduleTimeID');
        $builder->join('scheduledate','scheduletime.scheduleDateID = scheduledate.scheduleDateID');
        $builder->join('service','scheduledate.serviceID = service.serviceID');
        $builder->join('customer','appointment.customerID = customer.customerID');
        $builder->join('user','customer.userID = user.userID');

        $para = ['appointment.scheduleTimeID' => $timeID, 'aptStatus' => 'Active'];
        $builder->where($para);

        return $builder->get()->getRowArray();
    }

    public function checkAptExist($timeID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('appointment');
        $builder->join('scheduletime','appointment.scheduleTimeID = scheduletime.scheduleTimeID');
        $builder->join('scheduledate','scheduletime.scheduleDateID = scheduledate.scheduleDateID');
        $builder->join('service','scheduledate.serviceID = service.serviceID');

        $para = ['appointment.ScheduleTimeID' => $timeID, 'aptStatus' => 'Active'];
        $builder->where($para);

        if($builder->get()->getRowArray())
            return true;
        else
            return false;
    }

    public function checkAptFinish($timeID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('appointment');
        $builder->join('scheduletime','appointment.scheduleTimeID = scheduletime.scheduleTimeID');
        $builder->join('scheduledate','scheduletime.scheduleDateID = scheduledate.scheduleDateID');
        $builder->join('service','scheduledate.serviceID = service.serviceID');

        $para = ['appointment.ScheduleTimeID' => $timeID, 'aptStatus' => 'Finished'];
        $builder->where($para);

        if($builder->get()->getRowArray())
            return true;
        else
            return false;
    }
    public function checkAptExistDate($scheduleDateID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('appointment');
        $builder->join('scheduletime','appointment.scheduleTimeID = scheduletime.scheduleTimeID');
        $builder->join('scheduledate','scheduletime.scheduleDateID = scheduledate.scheduleDateID');
        $builder->join('service','scheduledate.serviceID = service.serviceID');

        $para = ['scheduledate.scheduleDateID' => $scheduleDateID, 'aptStatus' => 'Active'];
        $builder->where($para);

        if($builder->get()->getRowArray())
            return true;
        else
            return false;
    }   

    public function checkAptExistCompany($companyID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('appointment');
        $builder->join('scheduletime','appointment.scheduleTimeID = scheduletime.scheduleTimeID');
        $builder->join('scheduledate','scheduletime.scheduleDateID = scheduledate.scheduleDateID');
        $builder->join('service','scheduledate.serviceID = service.serviceID');
        $builder->join('company','service.companyID = company.companyID');

        $para = ['company.companyID' => $companyID, 'aptStatus' => 'Active'];
        $builder->where($para);

        if($builder->get()->getRowArray())
            return true;
        else
            return false;
    } 

    public function checkAptExistCategory($categoryID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('appointment');
        $builder->join('scheduletime','appointment.scheduleTimeID = scheduletime.scheduleTimeID');
        $builder->join('scheduledate','scheduletime.scheduleDateID = scheduledate.scheduleDateID');
        $builder->join('service','scheduledate.serviceID = service.serviceID');
        $builder->join('category','service.categoryID = category.categoryID');
        $builder->join('company','service.companyID = company.companyID');

        $para = ['service.categoryID' => $categoryID, 'aptStatus' => 'Active'];
        $builder->where($para);

        if($builder->get()->getRowArray())
            return true;
        else
            return false;
    } 

    public function checkAptDate()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('appointment');
        $builder->join('scheduletime','appointment.scheduleTimeID = scheduletime.scheduleTimeID');
        $builder->join('scheduledate','scheduletime.scheduleDateID = scheduledate.scheduleDateID');

        $currentDate = date('Y-m-d');
        
        $para = ['scheduleDate <=' => $currentDate,'aptStatus' => 'Active'];
        $builder->where($para);

        return $builder->get()->getResultArray();
    }

    public function checkAptTime($dateID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('appointment');
        $builder->join('scheduletime','appointment.scheduleTimeID = scheduletime.scheduleTimeID');
        $builder->join('scheduledate','scheduletime.scheduleDateID = scheduledate.scheduleDateID');

        $currentTime = date('h:i:s');
        
        $para = ['scheduletime.scheduleDateID' => $dateID,'scheduleStartTime <=' => $currentTime,'aptStatus' => 'Active'];
        $builder->where($para);

        return $builder->get()->getResultArray();
    }
}