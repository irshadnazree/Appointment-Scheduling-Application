<div class="container py-3 h-100">
    <div class="d-flex justify-content-center">
        <div class="col-lg-7 mb-4 mb-lg-0">      
        <button class="btn btn-sm btn-secondary mb-2" onclick="history.back()">Back</button>
            <div class="card">
                <div class="card-header pt-3">
                    <h4>Time Detail</h4>
                </div>
                <div class="card-body">
                    <div class="col">
                        <div class="row">
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <h6>Date</h6>
                                    <p class="text-muted"><?= date("D, d F Y", strtotime($time['scheduleDate']))?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <h6>Start Time</h6>
                                    <p class="text-muted"><?= date("h:i A",  strtotime($time['scheduleStartTime']))?></p>
                                </div>
                                <div class="col-6 mb-2">
                                    <h6>Start Time</h6>
                                    <p class="text-muted"><?= date("h:i A",  strtotime($time['scheduleEndTime']))?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php if(session('userType') == 'staff' || session('userType') == 'owner'):?>
                    <div class="col">
                        <a href="/deleteTime/<?= $time['scheduleTimeID']?>" class="btn btn-sm btn-outline-secondary" <?php $aptmodel = model('AptModel'); if($aptmodel->checkAptExist($time['scheduleTimeID'])) echo 'hidden';?> onclick="return confirm('Are you sure you want to delete?');">Delete Time</a>
                        <a href="/editTime/<?= $time['scheduleTimeID']?>" class="btn btn-sm btn-primary" <?php $aptmodel = model('AptModel'); if($aptmodel->checkAptExist($time['scheduleTimeID'])) echo 'hidden';?> onclick="return confirm('Are you sure you want to update?');">Edit Time</a>
                    </div>
                <?php endif;?>
                </div>
            </div>
            <?php if(!empty($cust)):?>
            <div class="card mt-2">
                <div class="card-header pt-3">
                    <h4>Appointment Detail</h4>
                </div>
                <div class="card-body">
                    <div class="col">
                        <div class="row">
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <h6>Customer Name</h6>
                                    <p class="text-muted"><?= ucfirst($cust['firstName'])." ".ucfirst($cust['lastName'])?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(session('userType') == 'staff' || session('userType') == 'owner'):?>
                    <div class="col">
                        <a href="/finishApt/<?= $cust['aptID']?>" class="btn btn-sm btn-primary" >Finished</a>
                    </div>
                <?php endif;?>
                </div>
            </div>
            <?php endif;?>

            <?php if(!empty($historyCust)):?>
            <div class="card mt-2">
                <div class="card-header pt-3">
                    <h4>Appointment Detail</h4>
                </div>
                <div class="card-body">
                    <div class="col">
                        <div class="row">
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <h6>Customer Name</h6>
                                    <p class="text-muted"><?= ucfirst($historyCust['firstName'])." ".ucfirst($historyCust['lastName'])?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(session('userType') == 'staff' || session('userType') == 'owner'):?>
                    <div class="col">
                        <a href="/finishApt/<?= $historyCust['aptID']?>" class="btn btn-sm btn-primary" >Finished</a>
                    </div>
                <?php endif;?>
                </div>
            </div>
            <?php endif;?>
        </div>
    </div>
    
</div>