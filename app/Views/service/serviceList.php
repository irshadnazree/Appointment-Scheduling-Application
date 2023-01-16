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
                        <?php foreach($company as $cm):?>
                        <div class="card mb-3">
                            <div class="card-body px-4">
                                <div class="d-flex justify-content-between">
                                    <h3 class="m-0"><?= ucfirst($cm['companyName'])?></h3>
                                </div>
                                <hr class="my-2">
                                <div class="row">
                                    <div class="col">
                                        <h6>Company Description</h6>
                                        <p class="text-muted"><?= ucwords($cm['companyDesc'])?></p>
                                    </div>
                                    <div class="col">
                                        <h6>Address</h6>
                                        <p class="text-muted"><?= ucwords($cm['companyAddress']).", ".ucwords($cm['companyPostcode']).", ".ucwords($cm['companyState'])?></p>
                                    </div>
                                    <div class="col">
                                        <h6>Phone Number</h6>
                                        <p class="text-muted"><?= $cm['companyPhone']?></p>
                                    </div>
                                </div>
                                <hr class="mt-0 mb-2">
                                <div class="row">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="mb-0">Services List</h4>
                                    </div>
                                    <div class="card-body px-4 pb-0">
                                    <?php $srvModel = model('ServiceModel'); $service = $srvModel->getServiceList($cm['companyID']);?>
                                        <?php foreach($service as $srv):?>
                                            <div class="row mb-2">
                                                <div class="d-flex justify-content-between">
                                                    <p><?= $srv['serviceName']?></p>
                                                    <div>
                                                        <a href="/serviceDetail/<?= $srv['serviceID']?>" class="btn btn-sm btn-primary">More Details</a>
                                                    </div>
                                                </div>
                                                <hr class="m-0">
                                            </div>
                                        <?php endforeach;?>
                                    </div>
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
