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
                                    <h3><?= ucfirst($companyDetail['companyName'])?></h3>

                                    <div>
                                    <a href="/deleteCompany/<?= $companyDetail['companyID']?>" class="btn btn-outline-secondary btn-sm px-2" onclick="return confirm('Are you sure you want to delete company?');">Delete Company</a>
                                        <a href="/companyDetail/<?= $companyDetail['companyID']?>" class="btn btn-primary btn-sm px-2">Edit Company</a>
                                    </div>
                                </div>
                                <hr class="mt-1 mb-3">
                                <div class="row">
                                    <h4 class="mb-3">Company Information</h4>
                                    <div class="col-6 mb-2">
                                        <h6>Company Description</h6>
                                        <p class="text-muted"><?= $companyDetail['companyDesc']?></p>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <h6>Address</h6>
                                        <p class="text-muted"><?= ucwords($companyDetail['companyAddress']).", ".ucwords($companyDetail['companyPostcode']).", ".ucwords($companyDetail['companyState'])?></p>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <h6>Phone Number</h6>
                                        <p class="text-muted"><?= $companyDetail['companyPhone']?></p>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>

                <div class="row mx-1 mb-3">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#staff">Staff</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#service">Service</a>
                        </li>
                    </ul>
                </div>

                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active show" id="staff">
                        <div class="card border-secondary mb-3">
                            <div class="card-header px-4 pt-2">
                                <div class="d-flex justify-content-between">
                                    <h4 class="mb-0">Staff List</h4>
                                    <a href="/staffRegistration/<?= $companyDetail['companyID']?>" class="btn btn-primary btn-sm px-2">Add Staff</a>
                                </div>
                            </div>
                            <div class="card-body px-4">
                            <?php foreach($staff as $stf):?>
                                <div class="row mb-2">
                                    <div class="d-flex justify-content-between">
                                        <p><?= ucfirst($stf['firstName'])." ".ucfirst($stf['lastName'])?></p>
                                        <div>
                                            <a href="/staffDeactivation/<?=$stf['staffID']?>" class="btn btn-sm btn-outline-secondary" onclick="return confirm('Are you sure you want to delete staff?');">Delete</a>
                                            <a href="/editStaff/<?=$stf['staffID']?>"" class="btn btn-sm btn-primary">Edit</a>
                                        </div>
                                    </div>
                                    <hr class="m-0">
                                </div>
                            <?php endforeach;?>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="service">
                        <div class="card border-secondary mb-3">
                            <div class="card-header px-4 pt-2">
                                <div class="d-flex justify-content-between">
                                    <h4 class="mb-0">Services List</h4>
                                    <a href="/addService/<?=$companyDetail['companyID']?>" class="btn btn-primary btn-sm px-2">Add Service</a>
                                </div>
                            </div>
                            <div class="card-body px-4">
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

