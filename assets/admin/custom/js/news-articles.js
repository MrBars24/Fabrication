$(document).ready(function(){
var index = null;
var table = $(".news-container").initTable({
url:"/admin/news/list",
pageContainer:".pagination-bars",
render:function(data){
var container = ``;
if(data.length > 0){
data.forEach(function(obj,index){
obj.created_at = new Date(obj.created_at);
obj.created_at = moment(obj.created_at).format('MM, DD YYYY - hh:mm A');
container += `
<tr>
   <td>${obj.title}</td>
   <td>${obj.slug}</td>
   <td>${obj.author}</td>
   <td>${obj.created_at}</td>
   <td>
      <a class="pointer view"><i class="text-primary fa fa-eye"></i></a>
      <a class="pointer edit"><i class="text-warning fa fa-pencil"></i></a>
      <a class="pointer delete"><i class="text-danger fa fa-trash"></i></a>
   </td>
</tr>
`;
});
}else{
container = `
<tr id="no-results">
   <td colspan="5">
      <h1 class="text-center">NO RESULTS FOUND</h1>
   </td>
</tr>
`;
}
return container;
}
});
$(document).on('submit','#frm-news',function(e){
e.preventDefault();
var serial = $('#frm-news').serializeArray();
var action = "/admin/news/create";
var that = $(this);
if($(this).attr('data-action') == "update"){
action = $(this).attr('action');
}
$.ajax({
url:action,
type:'POST',
data : serial,
success:function(res){
if(res.success){
var d = res.data;
$('#no-results').remove('tr');
d.created_at = new Date(d.created_at);
d.created_at = moment(d.created_at).format('MM, DD YYYY - hh:mm A');
var data = {
data:d,
template:`
<tr>
   <td>${d.title}</td>
   <td>${d.slug}</td>
   <td>${d.author}</td>
   <td>${d.created_at}</td>
   <td>
      <a class="pointer view"><i class="text-primary fa fa-eye"></i></a>
      <a class="pointer edit" data-index="${index}"><i class="text-warning fa fa-pencil"></i></a>
      <a class="pointer delete" data-id="${index}"><i class="text-danger fa fa-trash"></i></a>
   </td>
</tr>
`
}
if(that.attr('data-action') == "update"){
data.index = index;
table.dataReplace(data);
    toastr.success('You have successfully updated a Package setting!', 'Success');
}else{
table.dataPrepend(data);
    toastr.success('You have successfully added a Package setting.', 'Success');
}
index = null;
$('.create-modal').modal('toggle');
}else{
                    $('.title-error').text(res.errors.title);
					$('.slug-error').text(res.errors.slug);
					$('.desc-error').text(res.errors.desc);
}
}
});
});
    $(document).on('click','.add',function(e){
        $('.title-error').text('');
		$('.slug-error').text('');
        $('.desc-error').text('');
		$("input[name='title']").val('');
		$("input[name='slug']").val('');
        tinyMCE.activeEditor.setContent('');
	});
$(document).on('click','.edit',function(e){
    $('.title-error').text('');
		$('.slug-error').text('');
        $('.desc-error').text('');
index = $(this).parent().parent().index();
var data = table.fetch(index);
loadModal(data);
});
$(document).on('click','.view',function(e){
index = $(this).parent().parent().index();
var data = table.fetch(index);
viewModal(data);
});
    
$(document).on('click','.delete',function(e){
index = $(this).parent().parent().index();
var data = table.fetch(index);
$.ajax({
url:'/admin/news/delete/' + data.id,
type:'POST',
success:function(res){
if(res.success){
    toastr.error('You have just deleted an Article', 'Danger');
table.dataRemove(index);
}else{
alert("failed");
}
}
})
});
function loadModal(data){
$(".create-modal").modal('show');
$(".create-modal").find('form').attr('data-action','update');
$(".create-modal").find('form').attr('action','/admin/news/update/' + data.id);
$(".modal-title").text('Update News');
$("input[name='title']").val(data.title);
$("input[name='slug']").val(data.slug);
tinyMCE.activeEditor.setContent(data.description);
}
function viewModal(data){
$(".view-modal").modal('show');
$(".modal-title").text('News and Articles');
$(".title").html(data.title);
$(".slug").html(data.slug);
$(".desc").html(data.description);
}
if ($("#desc").length > 0) {
tinymce.init({
selector: "textarea#desc",
theme: "modern",
height: 300,
plugins: [
"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
"save table contextmenu directionality emoticons template paste textcolor"
],
toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
});
}
});