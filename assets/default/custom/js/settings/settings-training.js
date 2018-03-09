$(document).ready(function() {
    
    $(document).on("submit", "#form-training-create", function(e){
        
        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serializeArray();
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: data,
            url: url,
            success: function(result){
                console.log(result);
                if(result.success){
                    var text = "Training post, added!";
                    var heading = "Success!!";
                    //successtoast(text,heading);
                    
                    $("#training-id").prepend(`
                        <li class="list-group-item">
                            <h5 class="font-weight-bold mb-1">${result.data.training_name}
</h5>
                            <h6 class="text-muted">${result.data.created_at}</h6>
                            <h6>${result.data.description}</h6>
                                        
        <a href="http://dev.e-fab/settings/training/${result.data.id}" class="btn btn-success"><span class="align-middle">View</span><i class="icon-eye align-middle ml-2"></i></a>

                            <a href="http://dev.e-fab/settings/training/${result.data.id}" class="btn btn-warning"><span class="align-middle">Edit</span><i class="icon-pencil align-middle ml-2"></i></a>

                            <!--<button type="submit" class="btn btn-danger"><span class="align-middle">Delete</span></button>-->

                            <a class="btn btn-deleted btn-danger text-white" data-id="${result.data.id}"><span class="align-middle">Delete</span><i class="icon-trash align-middle ml-2"></i></a>
            
                        </li>
                    `);
                    $('#myModal').modal("hide");
                }else{
                    alert('error');
                }
            },
            error: function(){
            
            }

        });     
    });

    $('#training-link').click(function(){
        var training_id = $(this).attr("data-target");
        $.ajax ({
           
        });
        $('#training-mymodal').modal("show");
    });
     
});
