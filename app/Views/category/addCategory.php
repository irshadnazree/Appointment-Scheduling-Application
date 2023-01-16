<form action="/addCategory" method="post">
    <div class="container">
    <div class="d-flex justify-content-center">
        <div class="col col-md-6 col-md-offset-5">
        <a href="/dashboard" class="btn btn-sm btn-secondary">Back</a>
            <div class="card bg-secondary py-3 px-5 my-2 mx-auto">
                <h2 class="text-center">Add Category</h2>
                <div class="form-floating mt-2">
                    <input type="text" name="categoryName" id="floatingCName" class="form-control" placeholder="Enter Category Name" autofocus value="<?= set_value('categoryName')?>">
                    <label for="floatingCName">Category Name</label>
                    <?php if (isset($validation)): ?>
                        <div class="col-12">
                            <span class="mt-1 badge bg-danger"><?= $validation->getError('categoryName') ?></span>
                        </div>
                    <?php endif; ?> 
                </div>
            <div class="row">
                <div class="mt-3 mb-3 text-center">
                    <!-- <button type="submit" class="btn btn-secondary me-sm-2">Back</button> -->
                    <a href="/dashboard" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to add new category?');">Add Category</button>
                </div>
            </div> 
        </div>
        </div>
    </div>
</form>