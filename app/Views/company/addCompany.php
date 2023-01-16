<form action="/companyRegistration" method="post">
    <div class="container">
    <div class="d-flex justify-content-center">
    <div class="col col-md-6">
        <a class="btn btn-sm btn-secondary mb-2" href="/profile">Back</a>
        <div class="card bg-secondary col-md-offset-5 py-3 px-5 my-2 mx-auto">
                <h2 class="text-center">Company Registration</h2>
                <div class="form-floating mt-2">
                    <input type="text" name="companyName" id="floatingCName" class="form-control" placeholder="Enter Company Name" autofocus value="<?= set_value('companyName')?>">
                    <label for="floatingCName">Company Name</label>
                    <?php if (isset($validation)): ?>
                        <div class="col-12">
                            <span class="mt-1 badge bg-danger"><?= $validation->getError('companyName') ?></span>
                        </div>
                    <?php endif; ?> 
                </div>
                <div class="form-floating mt-2">
                    <input type="text" name="companyDesc" id="floatingCName" class="form-control" placeholder="Enter Company Description" autofocus value="<?= set_value('companyDesc')?>">
                    <label for="floatingCName">Company Description</label>
                    <?php if (isset($validation)): ?>
                        <div class="col-12">
                            <span class="mt-1 badge bg-danger"><?= $validation->getError('companyDesc') ?></span>
                        </div>
                    <?php endif; ?> 
                </div>
                <div class="form-floating mt-2">
                    <input type="text" name="address" class="form-control" id="floatingCAdr" placeholder="Enter Address" autofocus value="<?= set_value('address')?>">
                    <label for="floatingCAdr">Company Address</label>
                    <?php if (isset($validation)): ?>
                        <div class="col-12">
                            <span class="mt-1 badge bg-danger"><?= $validation->getError('address') ?></span>
                        </div>
                    <?php endif; ?> 
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mt-2">
                            <input type="text" name="postcode" class="form-control" id="floatingCpost" placeholder="Enter Postcode" autofocus value="<?= set_value('postcode')?>">
                            <label for="floatingCpost">Postcode</label>
                            <?php if (isset($validation)): ?>
                                <div class="col-12">
                                    <span class="mt-1 badge bg-danger text-start text-wrap"><?= $validation->getError('postcode') ?></span>
                                </div>
                            <?php endif; ?> 
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mt-2">
                            <input type="text" name="state" id="floatingCState" class="form-control" placeholder="Enter State" autofocus value="<?= set_value('state')?>">
                            <label for="floatingCState">State</label>
                            <?php if (isset($validation)): ?>
                                <div class="col-12">
                                    <span class="mt-1 badge bg-danger text-start text-wrap"><?= $validation->getError('state') ?></span>
                                </div>
                            <?php endif; ?> 
                        </div>
                    </div>
                </div>
                <div class="form-floating mt-2">
                            <input type="tel" name="phone" id="floatingCState" class="form-control" placeholder="Enter Phone Number" autofocus value="<?= set_value('phone')?>">
                            <label for="floatingCState">Phone Number</label>
                            <?php if (isset($validation)): ?>
                                <div class="col-12">
                                    <span class="mt-1 badge bg-danger"><?= $validation->getError('phone') ?></span>
                                </div>
                            <?php endif; ?> 
                        </div>
                <div class="row">
                    <div class="mt-3 mb-3 text-center">
                        <!-- <button type="submit" class="btn btn-secondary me-sm-2">Back</button> -->
                        <a href="/profile" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to register a new company?');">Register Company</button>
                    </div>
                </div> 
            </div>
            </div>
        </div>
    </div>
</form>