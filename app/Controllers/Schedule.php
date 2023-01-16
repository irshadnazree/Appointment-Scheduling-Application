<?php

namespace app\Controllers;

use App\Controllers\BaseController;
use App\Models\AptModel;
use App\Models\ScheduleDateModel;
use App\Models\ScheduleTimeModel;
use App\Models\ServiceModel;

class Schedule extends BaseController
{
    public function viewSchedule($scheduleID)
    {   
        $dateModel = new ScheduleDateModel();
        $date[] = $dateModel->getScheduleDateList(1);

        dd($date);
    }

    public function addSchedule($serviceID)
    {
        if(!(session('userType') == 'owner') && !(session('userType') == 'staff'))
            return redirect()->to('/');
        
        $data = [];
        $data['service'] = $serviceID;
        $data['page'] = 'Add Schedule';

        $data['date'] = $this->getDateWeek();

        if ($this->request->getPost()) {
            // $rules = [
            // ];

            // $errors = [
            // ];
            

            // if(!$this->validate($rules, $errors)){
            //     $data['validation'] = $this->validator;
            // }else{
                $date = $this->request->getVar('day');
                $dateModel = new ScheduleDateModel();
                foreach($date as $dt){
                    $userData = [
                        'scheduleDate' => $dt,
                        'serviceID' => $serviceID,
                    ];
                    $dateModel->save($userData);
                }
				// $session = session();
				// $session->setFlashdata('success', 'Schedule Added Successful');

				return redirect()->to('/serviceDetail/'.$serviceID);
            }
        // }

        echo view('template/header', $data);
        echo view('schedule/addSchedule');
        echo view('template/footer');
    }

    public function getDateWeek()
    {
        $week = [];
        $week['mon'] = date('Y-m-d', strtotime("monday this week"));
        $week['tue'] = date('Y-m-d', strtotime("tuesday this week"));
        $week['wed'] = date('Y-m-d', strtotime("wednesday this week"));
        $week['thu'] = date('Y-m-d', strtotime("thursday this week"));
        $week['fri'] = date('Y-m-d', strtotime("friday this week"));
        $week['sat'] = date('Y-m-d', strtotime("saturday this week"));
        $week['sun'] = date('Y-m-d', strtotime("sunday this week"));

        return $week;
    }

    public function editDate($serviceID)
    {
        if(!(session('userType') == 'owner') && !(session('userType') == 'staff'))
            return redirect()->to('/');

        $data = [];
        $data['service'] = $serviceID;
        $data['page'] = 'Edit Date';

        $dateModel = new ScheduleDateModel();
        $aptModel = new AptModel();

        $selectedDate = $data['selectedDate'] = $dateModel->getScheduleDateList($serviceID);
        $data['date'] = $this->getDateWeek();


        // dd($data['selectedDate']);
        if ($this->request->getPost()) {
            // $rules = [
            // ];

            // $errors = [
            // ];
            

            // if(!$this->validate($rules, $errors)){
            //     $data['validation'] = $this->validator;
            // }else{
            foreach ($selectedDate as $sd) {
                if ($aptModel->checkAptExistDate($sd['scheduleDateID']))
                {   
                    $session = session();
                    $session->setFlashdata('invalid', 'Unable to Edit Because of Existing Appointment');
                    return redirect()->to('/editDate/'.$serviceID);
                }else
                    $dateModel->deleteSchedule($sd['scheduleDateID']);
            }

            $date = $this->request->getVar('day');
            foreach($date as $dt){
                $userData = [
                    'scheduleDate' => $dt,
                    'serviceID' => $serviceID,
                ];
                $dateModel->save($userData);
            }
                    // $session = session();
				// $session->setFlashdata('success', 'Schedule Added Successful');

            return redirect()->to('/serviceDetail/'.$serviceID);
            
        }
        // }

        echo view('template/header', $data);
        echo view('schedule/editSchedule');
        echo view('template/footer');
    }

    public function viewTime($timeID)
    {
        $data = [];
        $data['page'] = 'Edit Date';

        $timeModel = new ScheduleTimeModel();
        $aptModel = new AptModel();

        $data['time'] = $timeModel->getTime($timeID);
        $data['cust'] = $aptModel->getAptCustName($timeID);
        $data['historyCust'] = $aptModel->getAptRecord(session('userID'));
        
        echo view('template/header', $data);
        echo view('schedule/viewTime');
        echo view('template/footer');
    }

    public function addTime($scheduleDateID)
    {
        if(!(session('userType') == 'owner') && !(session('userType') == 'staff'))
            return redirect()->to('/');

        $data = [];
        $data['dateID'] = $scheduleDateID;
        $data['page'] = 'Add Time';

        if ($this->request->getPost()) {
            $dateModel = new ScheduleDateModel();
            $date = $dateModel->where('scheduleDateID', $scheduleDateID)->first();
            // $rules = [
            // ];

            // $errors = [
            // ];
            

            // if(!$this->validate($rules, $errors)){
            //     $data['validation'] = $this->validator;
            // }else{
                $startTime = $this->request->getVar('startTime');
                $endTime = $this->request->getVar('endTime');

            
                $timeModel = new ScheduleTimeModel();
                foreach($startTime as $i => $stTime){
                    $userData = [
                        'scheduleStartTime' => $stTime,
                        'scheduleEndTime' => $endTime[$i],
                        'scheduleDateID' => $scheduleDateID,
                    ];
                    $timeModel->save($userData);
                }
				// $session = session();
				// $session->setFlashdata('success', 'Schedule Added Successful');

				return redirect()->to('/serviceDetail/'.$date['serviceID']);
            }

        echo view('template/header', $data);
        echo view('schedule/addTime');
        echo view('template/footer');
    }

    public function editTime($timeID)
    {
        if(!(session('userType') == 'owner') && !(session('userType') == 'staff'))
            return redirect()->to('/');

        $data = [];
        $data['timeID'] = $timeID;
        $data['page'] = 'Add Time';

        $timeModel = new ScheduleTimeModel();
        $data['time'] = $timeModel->where('scheduleTimeID ', $timeID)->first();

        if ($this->request->getPost()) {
            // $rules = [
            // ];

            // $errors = [
            // ];
            

            // if(!$this->validate($rules, $errors)){
            //     $data['validation'] = $this->validator;
            // }else{
                $startTime = $this->request->getVar('startTime');
                $endTime = $this->request->getVar('endTime');

                $userData = [
                    'scheduleTimeID' => $timeID,
                    'scheduleStartTime' => $startTime,
                    'scheduleEndTime' => $endTime,
                ];
                $timeModel->save($userData);

                $serviceModel = new ServiceModel();
                $service = $serviceModel->getServiceDetail($timeID);

				// $session = session();
				// $session->setFlashdata('success', 'Schedule Added Successful');

				return redirect()->to('/serviceDetail/'.$service['serviceID']);
            }

        echo view('template/header', $data);
        echo view('schedule/editTime');
        echo view('template/footer');
    }

    public function deleteTime($timeID)
    {
        if(!(session('userType') == 'owner') && !(session('userType') == 'staff'))
            return redirect()->to('/');

        $timeModel = new ScheduleTimeModel();
        $time = $timeModel->getTime($timeID);
        $timeModel->deleteTime($timeID);
        
        return redirect()->to('/serviceDetail/'.$time['serviceID']);
    }
}