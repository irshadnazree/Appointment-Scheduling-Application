<?php

namespace App\Controllers;

use App\Models\AptModel;
use App\Models\ServiceModel;
use App\Models\UserModel;

class Apt extends BaseController
{
    public function addApt($timeID)
    {
        if(!session('isLoggedIn'))
            return redirect()->to('/login');
        
        $data = [];
        $data['page'] = 'Set Appointment';
        $data['timeID'] = $timeID;

        $serviceModel = new ServiceModel();
        $data['service'] = $serviceModel->getServiceDetail($timeID);
        helper(['form']);

        echo view('template/header', $data);
        echo view('apt/setApt');
        echo view('template/footer');
    }

    public function setApt($timeID)
    {
        $AptModel = new AptModel();
        $UserModel = new UserModel();

        $customer = $UserModel->getCustomerDetail(session('userID'));

        $newData = [
            'scheduleTimeID' => $timeID,
            'customerID' => $customer['customerID'],
            'aptStatus' => 'Active',
        ];
        $AptModel->save($newData);

        $session = session();
        $session->setFlashdata('success', 'Category Added Succesfully');

        return redirect()->to('dashboard');
    }

    public function viewApt($aptID)
    {   
        $data = [];
        $data['page'] = 'Appointment Details';

        $aptModel = new AptModel();
        $data['apt'] = $aptModel->getAptDetail($aptID);

        helper(['form']);

        echo view('template/header', $data);
        echo view('apt/viewApt');
        echo view('template/footer');
    }

    public function cancelApt($aptID)
    {
        $AptModel = new AptModel();

        $newData = [
            'aptID' => $aptID,
            'aptStatus' => 'Canceled',
        ];
        $AptModel->save($newData);

        $session = session();
        $session->setFlashdata('success', 'Appointment Cancelled Succesfully');

        return redirect()->to('dashboard');
    }

    public function finishApt($aptID)
    {
        $aptModel = new AptModel();
        $service = $aptModel->getAptDetail($aptID);
        $newData = [
            'aptID' => $aptID,
            'aptStatus' => 'Finished',
        ];
        $aptModel->save($newData);

        $session = session();
        $session->setFlashdata('success', 'Appointment Updated Succesfully');

        return redirect()->to('/serviceDetail/'.$service['serviceID']);
    }

    public function updateApt()
    {
        $currentTime = date('Y-m-d');

        $AptModel = new AptModel();
        $aptID = $AptModel->checkAptDate($currentTime);

        $newData = [
            'aptID' => $aptID,
            'aptStatus' => 'Unknown',
        ];

        $AptModel->save($newData);
    }
}