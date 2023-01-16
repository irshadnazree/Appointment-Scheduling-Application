<form action="/editService/<?=$service['serviceID']?>" method="post">
    <div class="container">
    <div class="d-flex justify-content-center">
        <div class="col col-md-6 col-md-offset-5">
            <a href="/serviceDetail/<?=$service['serviceID']?>" class="btn btn-sm btn-secondary">Back</a>
            <div class="card bg-secondary py-3 px-5 my-2 mx-auto">
                <h2 class="text-center">Edit Service</h2>
                <div class="form-floating mt-2">
                    <input type="text" name="serviceName" id="floatingSName" class="form-control" placeholder="Enter Service Name" autofocus value="<?= set_value('serviceName',$service['serviceName'])?>">
                    <label for="floatingSName">Service Name</label>
                    <?php if (isset($validation)): ?>
                        <div class="col-12">
                            <span class="mt-1 badge bg-danger"><?= $validation->getError('serviceName') ?></span>
                        </div>
                    <?php endif; ?> 
                </div>
                <div class="form-floating mt-2">
                    <input type="text" name="serviceDesc" class="form-control" id="floatingCAdr" placeholder="Enter Service Description"  autofocus value="<?= set_value('serviceDesc',$service['serviceName'])?>">
                    <label for="floatingCAdr">Service Description</label>
                    <?php if (isset($validation)): ?>
                        <div class="col-12">
                            <span class="mt-1 badge bg-danger"><?= $validation->getError('serviceDesc') ?></span>
                        </div>
                    <?php endif; ?> 
                </div>
                <div class="form-floating mt-2">
                    <select class="form-select" name="category" id="category" placeholder="Select Category">
                    <?php foreach($category as $cat):?>
                        <option value="<?= $cat['categoryID']?>"><?=$cat['categoryName']?></option>
                    <?php endforeach;?>
                    </select>
                    <label for="exampleSelect2">Category</label>
                </div>
                <div class="row">
                    <div class="mt-3 mb-3 text-center">
                        <!-- <button type="submit" class="btn btn-secondary me-sm-2">Back</button> -->
                        <a href="/serviceDetail/<?=$service['serviceID']?>" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to update?');">Update Service</button>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</form>