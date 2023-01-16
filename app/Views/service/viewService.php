<div class="container pb-4 h-100">
    <div class="row h-100">
        <div class="d-flex justify-content-between gap-3">
            <div class="flex-grow-1">
                <?php if(session()->get('success')):?>
                <div class="alert alert-dismissible alert-success" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong><?= session()->get('success')?></strong>
                </div>
                <?php endif;?>
                <div class="row">
                    <div class="col">
                    <button class="btn btn-sm btn-secondary mb-2" onclick="history.back()">Back</button>
                        <div class="card mb-3">
                            <div class="card-body px-4">
                                <div class="d-flex justify-content-between">
                                <h3><?= ucfirst($service['serviceName'])?></h3>
                                <?php if(session('userType') == 'staff' || session('userType') == 'owner'):?>
                                    <div>
                                        <a href="/deleteService/<?= $service['serviceID']?>" class="btn btn-outline-secondary btn-sm px-2" onclick="return confirm('Are you sure you want to delete service?');">Delete Service</a>
                                        <a href="/editService/<?= $service['serviceID']?>" class="btn btn-primary btn-sm px-2">Edit Service</a>
                                    </div>
                                <?php endif;?>
                                </div>
                                <hr class="mt-1 mb-3">
                                <div class="row">
                                    <h4 class="mb-3">Service Information</h4>
                                    <div class="col-6 mb-2">
                                        <h6>Service Description</h6>
                                        <p class="text-muted"><?= ucwords($service['serviceDesc'])?></p>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header px-4 pt-2">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-0">Schedule</h4>
                            </div>
                            <div>
                            <?php if(session('userType') == 'staff' || session('userType') == 'owner'):?>
                                <?php if(!empty($date)):?>
                                <a href="/editDate/<?= $service['serviceID']?>" class="btn btn-outline-secondary btn-sm px-2">Edit Schedule</a>
                                <?php else:?>
                                <a href="/addSchedule/<?= $service['serviceID']?>" class="btn btn-primary btn-sm px-2">Add Schedule</a>
                                <?php endif;?>
                            <?php endif;?>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-4">
                        <div class="row g-1">
                        <?php foreach($date as $dt):?>
                            <div class="col">
                                <div class="card <?php if($dt['scheduleDate'] == $currentDate) echo 'border-light'; else echo 'border-primary'?> bg-dark">
                                    <div class="card-header text-center">
                                        <h5><?=date("D", strtotime($dt['scheduleDate']));?></h5>
                                    </div>
                                    <div class="card-body">
                                        <?php if(session('userType') == 'staff' || session('userType') == 'owner'):?>
                                        <div class="row">
                                            <a href="/addTime/<?= $dt['scheduleDateID']?>" class="btn btn-outline-secondary btn-sm mb-1 <?php if($dt['scheduleDate'] < $currentDate) echo 'disabled'?>">Add Time</a>
                                            <hr class="my-2">
                                        </div>
                                        <?php endif;?>
                                        <?php $timeModel = model('ScheduleTimeModel'); $time = $timeModel->getTimeList($dt['scheduleDateID']);?>
                                        <?php foreach($time as $tm):?>
                                            <?php $aptmodel = model('AptModel')?>
                                            <?php if(session('userType') == 'staff' || session('userType') == 'owner'):?>
                                                <?php if(!($aptmodel->checkAptFinish($tm['scheduleTimeID']))):?>
                                                    <div class="row text-center mb-1">
                                                        <a href="/timeDetail/<?= $tm['scheduleTimeID']?>" class="btn <?php if($aptmodel->checkAptExist($tm['scheduleTimeID'])) echo ' btn-outline-warning'; else echo 'btn-outline-primary';?> btn-sm"><?=date("h:i A", strtotime($tm['scheduleStartTime']))?> - <?=date("h:i A",  strtotime($tm['scheduleEndTime']))?></a>
                                                    </div>
                                                <?php endif;?>
                                            <?php elseif(session('userType') == 'customer'):?>
                                                <div class="row text-center mb-1">
                                                    <a href="/setAppointment/<?= $tm['scheduleTimeID']?>" class="btn btn-sm <?php if($aptmodel->checkAptExist($tm['scheduleTimeID'])) echo 'disabled btn-outline-secondary'; else echo 'btn-outline-primary';?>"><?=date("h:i A", strtotime($tm['scheduleStartTime']))?> - <?=date("h:i A",  strtotime($tm['scheduleEndTime']))?></a>
                                                </div>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


