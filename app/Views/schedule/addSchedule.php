<form action="/addSchedule/<?=$service?>" method="post">
    <div class="container">
        <div class="row">
            <div class="card bg-secondary col-md-6 col-md-offset-5 py-3 px-5 my-3 mx-auto">
                <h2 class="text-center">Add Schedule</h2>
                <div class="btn-group-vertical" role="group" aria-label="Basic checkbox toggle button group">
                    <input type="checkbox" name="day[]" class="btn-check" id="btncheck1" autocomplete="off" value="<?=$date['mon']?>">
                    <label class="btn btn-outline-secondary" for="btncheck1">Monday</label>
                    <input type="checkbox" name="day[]" class="btn-check" id="btncheck2" autocomplete="off" value="<?=$date['tue']?>">
                    <label class="btn btn-outline-secondary" for="btncheck2">Tuesday</label>
                    <input type="checkbox" name="day[]" class="btn-check" id="btncheck3" autocomplete="off" value="<?=$date['wed']?>">
                    <label class="btn btn-outline-secondary" for="btncheck3">Wednesday</label>
                    <input type="checkbox" name="day[]" class="btn-check" id="btncheck4" autocomplete="off" value="<?=$date['thu']?>">
                    <label class="btn btn-outline-secondary" for="btncheck4">Thursday</label>
                    <input type="checkbox" name="day[]" class="btn-check" id="btncheck5" autocomplete="off" value="<?=$date['fri']?>">
                    <label class="btn btn-outline-secondary" for="btncheck5">Friday</label>
                    <input type="checkbox" name="day[]" class="btn-check" id="btncheck6" autocomplete="off" value="<?=$date['sat']?>">
                    <label class="btn btn-outline-secondary" for="btncheck6">Saturday</label>
                    <input type="checkbox" name="day[]" class="btn-check" id="btncheck7" autocomplete="off" value="<?=$date['sun']?>">
                    <label class="btn btn-outline-secondary" for="btncheck7">Sunday</label>
                </div>

                <div class="row">
                    <div class="mt-3 mb-3 text-center">
                        <!-- <button type="submit" class="btn btn-secondary me-sm-2">Back</button> -->
                        <a href="/serviceDetail/<?=$service?>" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to add schedule?');">Add Schedule</button>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</form>