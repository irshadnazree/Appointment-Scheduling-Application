<form action="/editTime/<?=$timeID?>" method="post">
    <div class="container">
        <div class="row">
            <div class="card bg-secondary col-md-6 col-md-offset-5 py-3 px-5 my-3 mx-auto">
                <h2 class="text-center">Edit Time</h2>
                <div id="dynamic_field">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div class="flex-grow-1">
                            <div class="col form-floating">
                                <input type="time" class="form-control" id="float1" name="startTime[]" value="<?= $time['scheduleStartTime']?>" required>
                                <label for="float1">Start Time</label>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="col form-floating mx-1">
                                <input type="time" class="form-control" id="float2" name="endTime[]" value="<?= $time['scheduleEndTime']?>" required>
                                <label for="float2">End Time</label>
                            </div>
                        </div>
                        <div>
                            <button type="button" name="addTime" id="addTime" class="btn btn-success btn-sm"> + </button>
                        </div>
                    </div>
                </div>
            <div class="row">
                <div class="mt-3 mb-3 text-center">
                    <!-- <button type="submit" class="btn btn-secondary me-sm-2">Back</button> -->
                    <a href="/dashboard" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to update?');">Update Category</button>
                </div>
            </div> 
        </div>
        </div>
    </div>
</form>