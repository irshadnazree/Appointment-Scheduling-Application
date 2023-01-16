<div class="container py-3 h-100">
    <div class="d-flex justify-content-center">
        <div class="col-lg-7 mb-4 mb-lg-0">
        <button class="btn btn-sm btn-secondary mb-2" onclick="history.back()">Back</button>      
            <div class="card">
                <div class="card-header pt-3">
                    <h4>Appointment Detail</h4>
                </div>
                <div class="card-body">
                    <div class="col">
                        <div class="row">
                            <div class="col-6 mb-2" style="width: 100%;">
                                <h6>Service Name</h6>
                                <p class="text-muted"><?= $apt['serviceName']?></p>
                            </div>
                            <div class="col-6 mb-2">
                                <h6>Service Details</h6>
                                <p class="text-muted"><?= $apt['serviceDesc']?></p>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <h6>Appointment Date</h6>
                                    <p class="text-muted"><?= date("D, d F Y", strtotime($apt['scheduleDate']))?></p>
                                </div>
                                <div class="col-6 mb-2">
                                    <h6>Appointment Time</h6>
                                    <p class="text-muted"><?= date("h:i A",  strtotime($apt['scheduleStartTime']))." - ".date("h:i A",  strtotime($apt['scheduleEndTime']))?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php if(session('userType')):?>
                    <div class="col">
                        <a href="/cancelApt/<?= $apt['aptID']?>" class="btn btn-sm btn-primary">Cancel Appointment</a>
                    </div>
                <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>