
<form action="/editDate/<?=$service?>" method="post">
    <div class="container">
        <div class="row">
            <div class="card bg-secondary col-md-6 col-md-offset-5 py-3 px-5 my-3 mx-auto">
                <h2 class="text-center">Edit Schedule</h2>
                <div class="btn-group-vertical" role="group" aria-label="Basic checkbox toggle button group">
                    <input type="checkbox" name="day[]" class="btn-check" id="btncheck1" autocomplete="off" value="<?=$date['mon']?>" <?php foreach($selectedDate as $sd) if($date['mon'] == $sd['scheduleDate']) echo 'checked';?>>
                    <label class="btn btn-outline-secondary" for="btncheck1">Monday</label>
                    <input type="checkbox" name="day[]" class="btn-check" id="btncheck2" autocomplete="off" value="<?=$date['tue']?>" <?php foreach($selectedDate as $sd) if($date['tue'] == $sd['scheduleDate']) echo 'checked';?>>
                    <label class="btn btn-outline-secondary" for="btncheck2">Tuesday</label>
                    <input type="checkbox" name="day[]" class="btn-check" id="btncheck3" autocomplete="off" value="<?=$date['wed']?>" <?php foreach($selectedDate as $sd) if($date['wed'] == $sd['scheduleDate']) echo 'checked';?>>
                    <label class="btn btn-outline-secondary" for="btncheck3">Wednesday</label>
                    <input type="checkbox" name="day[]" class="btn-check" id="btncheck4" autocomplete="off" value="<?=$date['thu']?>" <?php foreach($selectedDate as $sd) if($date['thu'] == $sd['scheduleDate']) echo 'checked';?>>
                    <label class="btn btn-outline-secondary" for="btncheck4">Thursday</label>
                    <input type="checkbox" name="day[]" class="btn-check" id="btncheck5" autocomplete="off" value="<?=$date['fri']?>" <?php foreach($selectedDate as $sd) if($date['fri'] == $sd['scheduleDate']) echo 'checked';?>>
                    <label class="btn btn-outline-secondary" for="btncheck5">Friday</label>
                    <input type="checkbox" name="day[]" class="btn-check" id="btncheck6" autocomplete="off" value="<?=$date['sat']?>" <?php foreach($selectedDate as $sd) if($date['sat'] == $sd['scheduleDate']) echo 'checked';?>>
                    <label class="btn btn-outline-secondary" for="btncheck6">Saturday</label>
                    <input type="checkbox" name="day[]" class="btn-check" id="btncheck7" autocomplete="off" value="<?=$date['sun']?>" <?php foreach($selectedDate as $sd) if($date['sun'] == $sd['scheduleDate']) echo 'checked';?>>
                    <label class="btn btn-outline-secondary" for="btncheck7">Sunday</label>
                </div>
                <?php if(session()->get('invalid')):?>
                <div class="text-center mt-2">
                    <span class="badge bg-danger"><?= session()->get('invalid')?></span>
                </div>
            <?php endif;?>
                <div class="row">
                    <div class="mt-3 mb-3 text-center">
                        <!-- <button type="submit" class="btn btn-secondary me-sm-2">Back</button> -->
                        <a href="/serviceDetail/1" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to update?');">Update Schedule</button>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</form>