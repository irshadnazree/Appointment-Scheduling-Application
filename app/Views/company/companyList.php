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
                                    <h4 class="btn <?php if(($cm['companyStatus']) == 'Active') echo 'disabled btn-success'; else echo'disabled btn-warning';?>"><?= ucfirst($cm['companyStatus'])?></h4>
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
                            </div>  
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
