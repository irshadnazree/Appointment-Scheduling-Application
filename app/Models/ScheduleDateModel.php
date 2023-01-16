<?php

namespace App\Models;

use CodeIgniter\Model;

class ScheduleDateModel extends Model
{
    protected $table = 'scheduleDate';

    protected $primaryKey = 'scheduleDateID'; 

    protected $allowedFields = ['scheduleDate','serviceID'];

    public function getScheduleDateList($serviceID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('scheduleDate');

        $startDate = date('Y/m/d', strtotime("monday this week"));
        $endDate = date('Y/m/d', strtotime("sunday this week"));

        $para = ['serviceID' => $serviceID, 'scheduleDate >=' => $startDate, 'scheduleDate <=' => $endDate];
        $builder->where($para);

        return $builder->get()->getResultArray();
    }

    public function deleteSchedule($scheduleDateID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('scheduleDate');

        $builder->where('scheduleDateID', $scheduleDateID);
        $builder->delete();
    }
}



