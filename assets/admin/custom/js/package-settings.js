$(document).ready(function(){
	var index = null;
	var table = $(".package-container").initTable({
		url:"/admin/settings/package-settings/list",
		render:function(data){
			var container = ``;
			if(data != null){
				data.forEach(function(obj,index){
					container += `
				<div class="col-lg-6 float-left">
		            <div class="card">
		                <div class="card-body">

		                	<a class="pointer delete" data-id="${index}"><i class="text-danger fa fa-trash float-right mb-3 ml-2"></i></a>

		                	<a class="pointer edit" data-index="${index}"><i class="text-warning fa fa-pencil float-right mb-3"></i></a>

		                    <table style="clear: both" class="table table-bordered table-striped" id="user">
		                        <tbody>
						 	<tr>
                                <td>Package Name</td>
                                <td>
                                    <a href="#" id="package-name" class="editable editable-click">${obj.package_name}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Price<small>/month</small></td>
                                <td>
                                    <a href="#" id="package-price" class="editable editable-click">${obj.package_price}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Package Description</td>
                                <td>
                                    <a href="#" id="package-desc" class="editable editable-click">${obj.package_desc}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Package Includes</td>
                                <td><a href="#" id="package-include" class="editable editable-pre-wrapped editable-click">${obj.package_include}</a></td>
                            </tr>
                         </tbody>
		                    </table>
		                    <input type="hidden" class="hidden-name" name="package_name">
				        	<input type="hidden" class="hidden-include" name="package_include">
				        	<input type="hidden" class="hidden-price" name="package_price">
				        	<input type="hidden" class="hidden-desc" name="package_desc">
		                </div>
		            </div>
	        	</div><!--End of column-->
					`
					;
				});
			}else{
				container = `<tr id="no-results">
								<td colspan="5">
									<h1 class="text-center">NO RESULTS FOUND</h1>
								</td>
							</tr>`;
			}

			return container;
		}
	});


		$(document).on('submit','#frm-package',function(e){
		$('.hidden-name').attr('value', $('#package-name').text());
		$('.hidden-include').attr('value', $('#package-include').text());
		$('.hidden-price').attr('value', $('#package-price').text());
		$('.hidden-desc').attr('value', $('#package-desc').text());
		e.preventDefault();
		var serial = $('#frm-package').serializeArray();
		var action = "/admin/settings/package-settings/create";
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
					var data = {
						data:d,
						template:`
					<div class="col-lg-6 float-left add-field">
		            <div class="card">
		                <div class="card-body">

		                	<a class="pointer delete" data-id="${index}"><i class="text-danger fa fa-trash float-right mb-3 ml-2"></i></a>

		                	<a class="pointer edit" data-index="${index}"><i class="text-warning fa fa-pencil float-right mb-3"></i></a>

		                    <table style="clear: both" class="table table-bordered table-striped" id="user">
		                        <tbody>
						 	<tr>
                                <td>Package Name</td>
                                <td>
                                    <a href="#" id="package-name" class="editable editable-click">${d.package_name}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Price<small>/month</small></td>
                                <td>
                                    <a href="#" id="package-price" class="editable editable-click">${d.package_price}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Package Description</td>
                                <td>
                                    <a href="#" id="package-desc" class="editaSble editable-click">${d.package_desc}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Package Includes</td>
                                <td><a href="#" id="package-include" class="editable editable-pre-wrapped editable-click">${d.package_include}</a></td>
                            </tr>
                         </tbody>
		                    </table>
		                </div>
		            </div>
	        	</div><!--End of column-->
						`
					}

					if(that.attr('data-action') == "update"){
						data.index = index;
						table.dataReplace(data);
						table.html(data);
					}else{
						table.dataPrepend(data);
						$('.add-field').remove();
					}

					index = null;
				}else{
					alert("failed");
				}
			}
		});
	});
		$(document).on('click','.cancel-add',function(e){
			$('.add-field').remove();
		});
	$(document).on('click','.add',function(e){
		table.prepend(`
						<div class="col-lg-6 float-left">
		            <div class="card">
		                <div class="card-body">
		                <a class="pointer delete"><i class="text-danger fa fa-window-close-o float-right mb-3 ml-2 cancel-add"></i></a>
		                    <table style="clear: both" class="table table-bordered table-striped" id="user">
		                        <tbody>
						 	<tr>
                                <td>Package Name</td>
                                <td>
                                    <a href="#" id="package-name" class="editable editable-click">Package Name</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Price<small>/month</small></td>
                                <td>
                                    <a href="#" id="package-price" class="editable editable-click">Package Price</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Package Description</td>
                                <td>
                                    <a href="#" id="package-desc" class="editable editable-click">Package Description</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Package Includes</td>
                                <td><a href="#" id="package-include" class="editable editable-pre-wrapped editable-click">Package Include</a></td>
                            </tr>
                         </tbody>
		                    </table>
		                    <input type="hidden" class="hidden-name" name="package_name">
				        	<input type="hidden" class="hidden-include" name="package_include">
				        	<input type="hidden" class="hidden-price" name="package_price">
				        	<input type="hidden" class="hidden-desc" name="package_desc">
		                     <button type="submit" class="btn btn-danger waves-effect text-left float-right">Save</button>
		                </div>
		            </div>
	        	</div><!--End of column-->

					`);
	});

	$(document).on('click','.edit',function(e){
		index = $(this).parent().parent().index();
		var data = table.fetch(index);
				$(".container-fluid").find('form').attr('data-action','update');
		$(".container-fluid").find('form').attr('action','/admin/settings/package-settings/update/' + data.id);
		table.prepend(`<button type="submit" class="btn btn-danger waves-effect text-left float-right ">Save</button>`);
		$('#package-name').editable({
            validate: function(value) {
                if ($.trim(value) == '') return;
            },
            type: 'text',
            name: 'package-name',
            mode: 'inline'
        });
        $('#package-price').editable({
            validate: function(value) {
                if ($.trim(value) == '') return;
            },
            type: 'text',
            name: 'package-price',
            mode: 'inline'
        });
        $('#package-desc').editable({
            validate: function(value) {
                if ($.trim(value) == '') return;
            },
          	type: 'textarea',
            name: 'package-desc',
            mode: 'inline'
        });
        $('#package-include').editable({
            validate: function(value) {
                if ($.trim(value) == '') return;
            },
            type: 'textarea',
            name: 'package-include',
            showbuttons: 'bottom',
            mode: 'inline'
        });

	});
	$(document).on('click','.add',function(e){
		index = $(this).parent().parent().index();
		var data = table.fetch(index);

		$('#package-name').editable({
            validate: function(value) {
                if ($.trim(value) == '') return;
            },
            type: 'text',
            name: 'package-name',
            mode: 'inline'
        });
        $('#package-price').editable({
            validate: function(value) {
                if ($.trim(value) == '') return;
            },
            type: 'text',
            name: 'package-price',
            mode: 'inline'
        });
        $('#package-desc').editable({
            validate: function(value) {
                if ($.trim(value) == '') return;
            },
          	type: 'textarea',
            name: 'package-desc',
            mode: 'inline'
        });
        $('#package-include').editable({
            validate: function(value) {
                if ($.trim(value) == '') return;
            },
            type: 'textarea',
            name: 'package-include',
            showbuttons: 'bottom',
            mode: 'inline'
        });

	});

	$(document).on('click','.delete',function(e){
		index = $(this).parent().parent().index();
		var data = table.fetch(index);

		$.ajax({
			url:'/admin/settings/package-settings/delete/' + data.id,
			type:'POST',
			success:function(res){

				if(res.success){
					table.dataRemove(index);
				}else{
					alert("failed");
				}
			}
		})
	});


});