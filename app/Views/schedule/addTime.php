<form action="/addTime/<?=$dateID?>" method="post">
    <div class="container">
        <div class="row">
            <div class="card bg-secondary col-md-6 col-md-offset-5 py-3 px-5 my-3 mx-auto">
                <h2 class="text-center">Add Time</h2>
                <div id="dynamic_field">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div class="flex-grow-1">
                            <div class="col form-floating">
                                <input type="time" class="form-control" id="float1" name="startTime[]" required>
                                <label for="float1">Start Time</label>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="col form-floating mx-1">
                                <input type="time" class="form-control" id="float2" name="endTime[]" required>
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
                        <a href="/serviceDetail/1" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to add time?');">Add Time</button>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</form>

<script>  
$(document).ready(function(){  
    var i=1;  
    $('#addTime').click(function(){  
        i++;  
        // $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
        $('#dynamic_field').append('<div class="d-flex justify-content-between align-items-center mb-1" id="row'+i+'"><div class="flex-grow-1"><div class="col form-floating"><input type="time" class="form-control" id="float1" name="startTime[]"><label for="float1">Start Time</label></div></div><div class="flex-grow-1"><div class="col form-floating mx-1"><input type="time" class="form-control" id="float2" name="endTime[]"><label for="float2">End Time</label></div></div><div><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove btn-sm"> X </button></div></div>');  
    });  
    $(document).on('click', '.btn_remove', function(){  
        var button_id = $(this).attr("id");   
        $('#row'+button_id+'').remove();  
    });  
});  
</script>