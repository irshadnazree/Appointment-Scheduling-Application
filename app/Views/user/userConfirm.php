
<form action="/checkCredential" method="post">
<div class="container">
    <div class="row">
        <div class="d-flex justify-content-center">
            <div class="col col-md-6 col-md-offset-5">
            <a href="/profile" class="btn btn-sm btn-secondary">Back</a>
            <div class="card bg-secondary py-3 px-5 my-2 mx-auto">
            <h2 class="text-center">User Confirmation</h2>
            <div class="form-floating mt-2">
                <input type="email" name="email" id="floatingEmail" class="form-control" value="<?= set_value('email')?>" placeholder="Enter Username" required autofocus value>
                <label for="floatingEmail">Email</label>
                <?php if (isset($validation)): ?>
                <div class="mt-1 col-12 text-center">
                    <span class="badge bg-danger"><?= $validation->getError('email') ?></span>
                </div>
            <?php endif; ?> 
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
            <?php if(session()->get('Invalid')):?>
                <div>
                    <span class="badge bg-danger"><?= session()->get('Invalid')?></span>
                </div>
            <?php endif;?>
            <div class="row">
                <div class="mt-3 mb-3 text-center">
                    <a href="/profile" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Next</button>
                </div>
            </div> 
        </div>
    </div>
</div>
</form>