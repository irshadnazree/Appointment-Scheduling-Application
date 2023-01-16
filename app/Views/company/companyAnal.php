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
                        <div class="card bg-primary mb-3">
                            <div class="card-body px-4">
                                <div class="d-flex justify-content-between">
                                    <h3><?= ucfirst($companyDetail['companyName'])?></h3>
                                </div>
                            </div>  
                        </div>
                        <h4>Services</h4>
                        <?php foreach($service as $srv):?>
                        <div class="col mb-3">
                            <div class="card text-white bg-primary mb-1">
                                <div class="card-body px-4 py-2">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="card-title m-0"><?= ucfirst($srv['serviceName'])?></h4>
                                    </div>
                                </div>  
                            </div>
                            <?php if(true):?>
                            <table class="table">
                                <tr>
                                    <th>Month</th>
                                    <th>Cancelled Appointment</th>
                                    <th>Finished Appointment</th>
                                    <th></th>
                                </tr>
                                <?php $srvModel = model('ServiceModel'); $monthApt = $srvModel->getAptFinishService($srv['serviceID']);?>
                                <?php foreach($monthApt as $mthApt):?>
                                <tr>
                                    <td><?= date("F Y", strtotime($mthApt['Year_and_month']))?></td>
                                    <td><?= $mthApt['canCount']?></td>
                                    <td><?= $mthApt['finCount']?></td>
                                    <!-- <td><a href="/monthlyAnalytics/" class="btn btn-sm btn-outline-primary float-end">View Details</a></td> -->
                                </tr>
                                <?php endforeach;?>
                            </table>
                            <?php endif;?>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>

            </div>
        </div>
            <!-- <div>
                <div class="card border-secondary mb-3" style="max-width: 20rem;">
                    <h4 class="card-header">Schedule</h4>
                    <div class="card-body">
                        <div class="row m-0">
                            <h4 class="card-title">Monday</h4>
                            <a href=""  class="m-0 btn btn-sm btn-primary">More Detail</a>
                            <hr>
                        </div>
                        <div class="row m-0">
                            <h4 class="card-title">Monday</h4>
                            <a href=""  class="m-0 btn btn-sm btn-primary">More Detail</a>
                            <hr>
                        </div>
                        <div class="row m-0">
                            <h4 class="card-title">Monday</h4>
                            <a href=""  class="m-0 btn btn-sm btn-primary">More Detail</a>
                            <hr>
                        </div>
                        <div class="row m-0">
                            <h4 class="card-title">Monday</h4>
                            <a href=""  class="m-0 btn btn-sm btn-primary">More Detail</a>
                            <hr>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>

