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
                                <p class="text-muted"><?= $service['serviceName']?></p>
                            </div>
                            <div class="col-6 mb-2">
                                <h6>Service Details</h6>
                                <p class="text-muted"><?= $service['serviceDesc']?></p>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <h6>Appointment Date</h6>
                                    <p class="text-muted"><?= date("D, d F Y", strtotime($service['scheduleDate']))?></p>
                                </div>
                                <div class="col-6 mb-2">
                                    <h6>Appointment Time</h6>
                                    <p class="text-muted"><?= date("h:i A",  strtotime($service['scheduleStartTime']))." - ".date("h:i A",  strtotime($service['scheduleEndTime']))?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="col text-center">
                    <button onclick="history.back()" class="btn btn-outline-secondary">Cancel</button>
                    <a href="/setApt/<?=$timeID?>"class="btn btn-primary">Set Appointment</a>
                </div>
            </div>
        </div>
    </div>
</div>