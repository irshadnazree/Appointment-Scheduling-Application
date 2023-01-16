<div class="container py-3 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-lg-7 mb-4 mb-lg-0">      
            <div class="row">
                <div class="col-12">
                    <h1>Profile</h1>
                </div>
            </div>
            <?php if(session()->get('success')):?>
            <div class="alert alert-dismissible alert-success" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong><?= session()->get('success')?></strong>
            </div>
            <?php endif;?>
            <div class="card mb-3 p-4">
                <div class="row g-3">
                    <div class="col-md-4 gradient-custom text-center">
                        <img src="/assets/jpg/default-profile.jpg" alt="Avatar" class="img-fluid mb-3" style="width: 120px; border-radius: 100px;"/>
                        <h5 class="mb-0"><?= ucfirst($user['firstName'])." ".ucfirst($user['lastName'])?></h5>
                        <p><?= ucfirst(session('userType'))?></p>
                        <a href="/checkCredential" class="btn btn-primary btn-sm mb-1">Change Password</a>
                        <a href="/editProfile" class="btn btn-primary btn-sm">Edit Profile</a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h6>Information</h6>
                            <hr class="mt-0 mb-3">
                            <div class="row">
                                <div class="col-6 mb-2" style="width: 100%;">
                                <h6>Email</h6>
                                    <p class="text-muted"><?= $user['email']?></p>
                                    </div>
                                <div class="col-6 mb-2">
                                    <h6>IC Number</h6>
                                    <p class="text-muted"><?= $user['personalID']?></p>
                                </div>
                                <div class="col-6 mb-2">
                                    <h6>Phone</h6>
                                    <p class="text-muted"><?= $user['phoneNumber']?></p>
                                </div>
                            </div>
                        </div>
                        <?php if(session('userType') != 'admin'):?>
                        <div class="col">
                            <a href="/companyRegistration" class="btn-sm btn-link">Register a Company</a>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>