<form action="/register" method="post">
    <div class="container">
        <div class="row">
            <div class="card bg-secondary col-md-6 col-md-offset-5 py-3 px-5 my-3 mx-auto">
                <h2 class="text-center">Register</h2>
                <div class="form-floating mt-2">
                    <input type="email" name="email" id="floatingEmail" class="form-control" placeholder="Enter Email Address" autofocus value="<?= set_value('email')?>">
                    <label for="floatingEmail">Email</label>
                    <?php if (isset($validation)): ?>
                        <div class="col-12">
                            <span class="badge bg-danger"><?= $validation->getError('email') ?></span>
                        </div>
                    <?php endif; ?> 
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" name="firstName" class="form-control" id="floatingFN" placeholder="Enter First Name" autofocus value="<?= set_value('firstName')?>">
                            <label for="floatingFN">First Name</label>
                            <?php if (isset($validation)): ?>
                                <div class="col-12">
                                    <span class="badge bg-danger"><?= $validation->getError('firstName') ?></span>
                                </div>
                            <?php endif; ?> 
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" name="lastName" class="form-control" id="floatingLN" placeholder="Enter Last Name" autofocus value="<?= set_value('lastName')?>">
                            <label for="floatingLN">Last Name</label>
                            <?php if (isset($validation)): ?>
                                <div class="col-12">
                                    <span class="badge bg-danger"><?= $validation->getError('lastName') ?></span>
                                </div>
                            <?php endif; ?> 
                        </div>
                    </div>
                </div>
                <div class="form-floating mt-2">
                    <input type="text" name="personalID" id="floatingPersonalID" class="form-control" placeholder="Enter IC Number" autofocus value="<?= set_value('personalID')?>">
                    <label for="floatingPersonalID">IC Number</label>
                    <?php if (isset($validation)): ?>
                        <div class="col-12">
                            <span class="badge bg-danger"><?= $validation->getError('personalID') ?></span>
                        </div>
                    <?php endif; ?> 
                </div>
                <div class="form-floating mt-2">
                    <input type="tel" name="phone" id="floatingPhone" class="form-control" placeholder="Enter Phone Number" autofocus value="<?= set_value('phone')?>">
                    <label for="floatingPhone">Phone Number</label>
                    <?php if (isset($validation)): ?>
                        <div class="col-12">
                            <span class="badge bg-danger"><?= $validation->getError('phone') ?></span>
                        </div>
                    <?php endif; ?> 
                </div>
                <div class="form-floating mt-2">
                    <input type="password" name="password" id="floatingPW" class="form-control" placeholder="Enter Password" autofocus>
                    <label for="floatingPW">Password</label>
                    <?php if (isset($validation)): ?>
                        <div class="col-12">
                            <span class="badge bg-danger"><?= $validation->getError('password') ?></span>
                        </div>
                    <?php endif; ?> 
                </div>
                <div class="row">
                    <div class="mt-3 mb-3 text-center">
                        <!-- <button type="submit" class="btn btn-secondary me-sm-2">Back</button> -->
                        <button type="submit" class="btn btn-primary">Create Account</button>
                    </div>
                    <div class="d-flex flex-column text-center">
                        <a class="btn-sm btn-link" href="<?= base_url('/login')?>">Already have an account?</a>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</form>