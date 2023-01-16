
<form action="/changePassword/<?=$userID?>" method="post">
<div class="container">
    <div class="row">
        <?php if(session()->get('success')):?>
        <div class="alert alert-dismissible alert-success" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong><?= session()->get('success')?></strong>
        </div>
        <?php endif;?>
        <div class="d-flex justify-content-center">
            <div class="col col-md-6 col-md-offset-5">
                <a href="/profile" class="btn btn-sm btn-secondary">Back</a>
            <div class="card bg-secondary py-3 px-5 my-2 mx-auto">
                <h2 class="text-center">Change Password</h2>
                <div class="form-floating mt-2">
                    <input type="password" name="password" id="floating1" class="form-control" value="<?= set_value('password')?>" placeholder="Enter New Password" autofocus>
                    <label for="floating1">New Password</label>
                </div>
            <?php if (isset($validation)): ?>
                <div class="mt-1 col-12 text-center">
                    <span class="badge bg-danger"><?= $validation->getError('email') ?></span>
                </div>
            <?php endif; ?> 
            <div class="row">
                <div class="mt-3 mb-3 text-center">
                    <a href="/profile" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to reset password?');">Confirm</button>
                </div>
            </div> 
        </div>
    </div>
</div>
</form>