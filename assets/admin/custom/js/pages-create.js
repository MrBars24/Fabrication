$(document).ready(function() {
    if ($("#page_content").length > 0) {
        tinymce.init({
            selector: "textarea#page_content",
            theme: "modern",
            height: 300,
            protect: [
                /<\?php.*?\?>/g
            ],
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",

        });
    }

    $(document).on("submit","#create-page",function(e){
        e.preventDefault();
        var serial = $(this).serializeArray();
        var action = $(this).attr("action");        
        
        $.ajax({
            url:action,
            type:"POST",
            data:serial,
            success:function(res){
                if(res.success){
                    location.href = "/admin/pages";
                }
            }
        })
    });

    $(document).on("submit","#update-page",function(e){
        e.preventDefault();
        var serial = $(this).serializeArray();
        var action = $(this).attr("action");
        $.ajax({
            url:action,
            type:"POST",
            data:serial,
            success:function(res){
                if(res.success){
                    location.href = "/admin/pages";
                }
            }
        })
    });

    $(document).on("click",".btn-delete",function(e){
        var id = $(this).attr("data-id");
        var that = $(this);

        $.ajax({
            url:"/admin/pages/delete/" + id,
            type:"POST",
            success:function(res){
                if(res.success){
                    that.parent().parent().remove();

                    setTimeout(function(){
                        if($(".page-container > .alert").length > 0){
                            $(".page-container > .alert").fadeOut();
                        }
                    },3000);
                    
                    $(".page-container").prepend(`
                        <div class="alert alert-success">
                            <span class="content">Page successfully deleted.</span> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span> 
                            </button>
                        </div>
                    `);
                }
            }
        })
    });

    setTimeout(function(){
        if($(".page-container > .alert").length > 0){
            $(".page-container > .alert").fadeOut();
        }
    },3000);
});
