<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table = 'service';

    protected $primaryKey = 'serviceID';

    protected $allowedFields = ['serviceName','serviceDesc','categoryID','companyID','serviceStatus'];

    public function getServiceList($companyID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('service');

        $para = ['companyID' => $companyID, 'serviceStatus' => 'Active'];
        $builder->where($para);

        return $builder->get()->getResultArray();
    }

    public function getListService()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('service');
        return $builder->getWhere(['serviceStatus'=>'Active'])->getResultArray();
    }

    public function getServiceDetail($timeID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('scheduletime');
        $builder->join('scheduledate','scheduletime.scheduleDateID = scheduledate.scheduleDateID');
        $builder->join('service','scheduledate.serviceID = service.serviceID');

        $para = ['ScheduleTimeID' => $timeID];
        $builder->where($para);

        return $builder->get()->getRowArray();
    }

    public function getAptFinishService($serviceID){
        $db = \Config\Database::connect();
        $sql = "SELECT
            DATE_FORMAT(scheduledate.scheduleDate, '%Y-%m') AS Year_and_month,
            SUM(aptStatus = 'Finished') AS finCount,
            SUM(aptStatus = 'Cancelled') AS canCount
        FROM
            service
            JOIN scheduledate ON service.serviceID = scheduledate.serviceID
            JOIN scheduletime ON scheduledate.scheduleDateID = scheduletime.scheduleDateID
            JOIN appointment ON scheduletime.scheduleTimeID = appointment.scheduleTimeID
        WHERE
            service.serviceID = $serviceID
            AND aptStatus != 'Active'
        GROUP BY
            scheduledate.scheduleDate
        ";
        $query = $db->query($sql);
        
        return $query->getResultArray();
    }

    public function getAptCancelService($serviceID){
        $db = \Config\Database::connect();
        $builder = $db->table('service');
        $builder->join('scheduledate','service.serviceID = scheduledate.serviceID');
        $builder->join('scheduletime','scheduledate.scheduleDateID = scheduletime.scheduleDateID');
        $builder->join('appointment','scheduletime.scheduleTimeID = appointment.scheduleTimeID');

        $para = ['service.serviceID' => $serviceID,'aptStatus' => 'Cancelled'];
        
        $builder->select('appointment.aptID');
        $builder->where($para);
        
        return $builder->get()->getNumRows();
    }

}