<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Hello, <?= ucfirst(session('firstName')) ?></h1>
            <hr> 
        </div>
    </div>
    <?php if(session()->get('success')):?>
                <div class="alert alert-dismissible alert-success" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong><?= session()->get('success')?></strong>
                </div>
    <?php endif;?>
    <?php if(session()->get('invalid')):?>
    <div class="alert alert-dismissible alert-danger" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong><?= session()->get('invalid')?></strong>
    </div>
    <?php endif;?>
    <?php if(session('userType') == "customer"):?>
    <div class="row mt-2">
    <?php if(!empty($companyPending)):?>
        <h4>Pending Company Registration</h4>
            <?php foreach($companyPending as $cm):?>
                <div class="col">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-body">
                        <h4 class="card-title"><?= ucfirst($cm['companyName'])?></h4>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        <?php endif;?>
    </div>
    <div class="row mt-2">
        <h4>Upcoming Appointment</h4>
        <?php if(!empty($appointment)):?>
            <?php foreach($appointment as $apt):?>
                <div class="col">
                    <div class="card text-white bg-secondary mb-3">
                        <div class="card-body">
                            <h4 class="card-title"><?= $apt['serviceName']?></h4>
                            <p class="card-text"><?=date("l", strtotime($apt['scheduleDate']));?></p>
                            <a href="/aptDetail/<?= $apt['aptID']?>" class="btn btn-sm btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        <?php else:?>
            <p>No Upcoming Appointment</p>
        <?php endif;?>
    </div>
    <div class="row mt-2">
        <h4>Previous Appointment</h4>
        <?php if(!empty($aptHistory)):?>
            <?php foreach($aptHistory as $apt):?>
            <div class="col">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-body">
                        <h4 class="card-title"><?= ucfirst($apt['serviceName'])?></h4>
                        <div class="row">
                            <p><span class="text-muted">Appointment Status: </span><?= ($apt['aptStatus'])?></p>
                            <p><span class="text-muted">Date: </span><?= date("D, d F Y", strtotime($apt['scheduleDate']))?></p>
                            <p><span class="text-muted">Time: </span><?= date("h:i A",  strtotime($apt['scheduleStartTime']))?> - <?= date("h:i A",  strtotime($apt['scheduleEndTime']))?></p>
                        </div>
                        <a href="/timeDetail/<?= $apt['scheduleTimeID']?>" class="btn btn-outline-secondary btn-sm">More Details</a>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        <?php else:?>
            <p>No Upcoming Appointment</p>
        <?php endif;?>
    </div>
    <?php endif?>
    <?php if(session('userType') == "admin"):?>
    <div class="row mt-2">
        <h4>Pending Company Request</h4>
        <?php if(!empty($company)):?>
            <?php foreach($company as $cm):?>
            <div class="col">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-body">
                        <h4 class="card-title"><?= ucfirst($cm['companyName'])?></h4>
                        <a href="/rejectCompany/<?= $cm['companyID']?>" class="btn btn-outline-secondary btn-sm" onclick="return confirm('Are you sure you want to reject company?');">Reject</a>
                        <a href="/acceptCompany/<?= $cm['companyID']?>" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to accept company?');">Accept</a>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
        <?php else:?>
            <p>No Pending Company Request</p>
        <?php endif;?>
    </div>
    <div class="row mt-2">
        <div class="d-flex justify-content-between mb-2">
            <h4 class="mb-0">Category List</h4>
            <a href="/addCategory" class="btn btn-primary btn-sm px-2">Add Category</a>
        </div>
        <?php foreach($category as $cat):?>
            <div class="col">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-body">
                        <h4 class="card-title"><?= ucfirst($cat['categoryName'])?></h4>
                        <a href="/deleteCategory/<?= $cat['categoryID']?>" class="btn btn-outline-secondary btn-sm" onclick="return confirm('Are you sure you want to delete category?');">Delete</a>
                        <a href="/editCategory/<?= $cat['categoryID']?>" class="btn btn-primary btn-sm">Edit</a>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
    <div class="row mt-2">
            <h4 class="mb-2">Admin Navigation</h4>
            <div class="col">
                <div class="card text-white bg-secondary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="m-0">User List</h4>
                            <a href="/userList" class="btn btn-primary btn-sm px-2">View More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-secondary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="m-0">Company List</h4>
                            <a href="/companyList" class="btn btn-primary btn-sm px-2">View More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-secondary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="m-0">Service List</h4>
                            <a href="/serviceList" class="btn btn-primary btn-sm px-2">View More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif;?>
    <?php 
    if(session('userType') == "owner"):?>
    <div class="row mt-2">
        <h4>Company List</h4>
        <?php 
        foreach($companyOwnList as $cm):?>
        <div class="col">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-body">
                    <h4 class="card-title"><?= ucfirst($cm['companyName'])?></h4>
                    <a href="/companyDashboard/<?= $cm['companyID']?>" class="btn btn-outline-secondary btn-sm">More Details</a>
                    <a href="/companyAnalytics/<?= $cm['companyID']?>" class="btn btn-outline-secondary btn-sm">View Analytics</a>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
    <?php endif;?>
    <?php 
    if(session('userType') == "owner" || session('userType') == "staff"):?>
    <div class="row mt-2">
        <h4>Current Appointment</h4>
        <?php if(!empty($aptList)):?>
            <?php foreach($aptList as $apt):?>
            <div class="col">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-body">
                        <h4 class="card-title"><?= ucfirst($apt['serviceName'])?></h4>
                        <div class="row">
                            <p class="text-muted"><?= date("D, d F Y", strtotime($apt['scheduleDate']))?></p>
                            <p class="text-muted"><?= date("h:i A",  strtotime($apt['scheduleStartTime']))?> - <?= date("h:i A",  strtotime($apt['scheduleEndTime']))?></p>
                        </div>
                        <a href="/timeDetail/<?= $apt['scheduleTimeID']?>" class="btn btn-outline-secondary btn-sm">More Details</a>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        <?php else:?>
            <p>No Upcoming Appointment</p>
        <?php endif;?>
    </div>

    <div class="row mt-2">
        <h4>Appointment History</h4>
        <?php if(!empty($aptHistory)):?>
            <?php foreach($aptHistory as $apt):?>
            <div class="col">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-body">
                        <h4 class="card-title"><?= ucfirst($apt['serviceName'])?></h4>
                        <div class="row">
                            <p class="text-muted"><?= date("D, d F Y", strtotime($apt['scheduleDate']))?></p>
                            <p class="text-muted"><?= date("h:i A",  strtotime($apt['scheduleStartTime']))?> - <?= date("h:i A",  strtotime($apt['scheduleEndTime']))?></p>
                        </div>
                        <a href="/timeDetail/<?= $apt['scheduleTimeID']?>" class="btn btn-outline-secondary btn-sm">More Details</a>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        <?php else:?>
            <p>No Upcoming Appointment</p>
        <?php endif;?>
    </div>

    <?php endif;?>
</div>