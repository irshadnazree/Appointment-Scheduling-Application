<?php

namespace App\Models;

use CodeIgniter\Model;

class ScheduleTimeModel extends Model
{
    protected $table = 'scheduleTime';

    protected $primaryKey = 'scheduleTimeID'; 

    protected $allowedFields = ['scheduleStartTime','scheduleEndTime','scheduleDateID'];

    public function getTimeList($scheduleDateID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('scheduleTime');

        $currentTime = date('h:i:s');

        $para = ['scheduleDateID' => $scheduleDateID, 'scheduleStartTime >=' => $currentTime];
        $builder->where($para);

        return $builder->get()->getResultArray();
    }
    
    public function getTime($timeID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('scheduleTime');
        $builder->join('scheduledate','scheduletime.scheduleDateID = scheduledate.scheduleDateID');
        $builder->join('service','scheduledate.serviceID = service.serviceID');

        $para = ['scheduleTimeID' => $timeID];
        $builder->where($para);

        return $builder->get()->getRowArray();
    }

    public function deleteTime($scheduleTimeID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('scheduleTime');

        $builder->where('scheduleTimeID', $scheduleTimeID);
        $builder->delete();
    }
}

