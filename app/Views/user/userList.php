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
                            <div class="card-header"><h4 class="m-0">Admin</h4></div>
                            <div class="card-body px-4">
                                <?php foreach($admin as $ad):?>
                                    <div class="d-flex justify-content-between mb-1">
                                        <p class="card-text m-0"><?= ucfirst($ad['firstName'])." ".ucfirst($ad['lastName'])?></p>
                                        <a href="/userDetail/<?= $ad['userID']?>" class="btn btn-outline-primary btn-sm" >View Detail</a>
                                    </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">                    
                        <div class="card mb-3">
                            <div class="card-header"><h4 class="m-0">Owner</h4></div>
                            <div class="card-body px-4">
                                <?php foreach($owner as $ow):?>
                                    <div class="d-flex justify-content-between mb-1">
                                        <p class="card-text m-0"><?= ucfirst($ow['firstName'])." ".ucfirst($ow['lastName'])?></p>
                                        <a href="/userDetail/<?= $ow['userID']?>" class="btn btn-outline-primary btn-sm" >View Detail</a>
                                    </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">                    
                        <div class="card mb-3">
                            <div class="card-header"><h4 class="m-0">Staff</h4></div>
                            <div class="card-body px-4">
                                <?php foreach($staff as $st):?>
                                    <div class="d-flex justify-content-between mb-1">
                                        <p class="card-text m-0"><?= ucfirst($st['firstName'])." ".ucfirst($st['lastName'])?></p>
                                        <a href="/userDetail/<?= $st['userID']?>" class="btn btn-outline-primary btn-sm" >View Detail</a>
                                    </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">                    
                        <div class="card mb-3">
                            <div class="card-header"><h4 class="m-0">Customer</h4></div>
                            <div class="card-body px-4">
                                <?php foreach($customer as $cust):?>
                                    <div class="d-flex justify-content-between mb-1">
                                        <p class="card-text m-0"><?= ucfirst($cust['firstName'])." ".ucfirst($cust['lastName'])?></p>
                                        <a href="/userDetail/<?= $cust['userID']?>" class="btn btn-outline-primary btn-sm" >View Detail</a>
                                    </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>