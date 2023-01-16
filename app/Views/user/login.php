
<form action="/login" method="post">
<div class="container">
    <div class="row">
        <?php if(session()->get('success')):?>
        <div class="alert alert-dismissible alert-success" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong><?= session()->get('success')?></strong>
        </div>
        <?php endif;?>
        <div class="card bg-secondary col-md-6 col-md-offset-5 py-3 px-5 my-3 mx-auto">
            <h2 class="text-center">Login</h2>
            <div class="form-floating mt-2">
                <input type="email" name="email" id="floatingEmail" class="form-control" value="<?= set_value('email')?>" placeholder="Enter Username" required autofocus value>
                <label for="floatingEmail">Email</label>
            </div>
            <?php if (isset($validation)): ?>
                <div class="mt-1 col-12 text-center">
                    <span class="badge bg-danger"><?= $validation->getError('email') ?></span>
                </div>
            <?php endif; ?> 
            <div class="form-floating mt-2">
                <input type="password" name="password" id="floatingPW" class="form-control" placeholder="Enter Password" required autofocus>
                <label for="floatingPW">Password</label>
            </div>
            <?php if (isset($validation)): ?>
                <div class="mt-1 col-12 text-center">
                    <span class="badge bg-danger"><?= $validation->getError('password') ?></span>
                </div>
            <?php endif; ?> 
            <div class="row">
                <div class="mt-3 mb-3 text-center">
                    <!-- <button type="submit" class="btn btn-secondary me-sm-2">Back</button> -->
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                <div class="d-flex flex-column text-center">
                    <a class="btn-sm btn-link" href="/checkCredential">Forget Password</a>
                    <a class="btn-sm btn-link" href="/register">"Create an Account</a>
                </div>
            </div> 
        </div>
    </div>
</div>
</form>