$(document).ready(function(){
	var index = null;
	var table = $(".package-container").initTable({
		url:"/admin/settings/package-settings/list",
		onBeforeRequest:function(){
            $(".package-container").html(`<div class="preloader custom-preloader" style="display: none;">
                    <svg class="circular" viewBox="25 25 50 50">
                    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle> </svg>
                </div>`);
		      },
		render:function(data){
			var container = ``;
			if(data.length > 0){
				data.forEach(function(obj,index){
					if(obj.is_default == 1){
							var defaultChecked = `checked`;
							var defaultText = `Setted as default`;
						}else{
							var defaultChecked = '';
							var defaultText = `Set as default`;
						}
					container += `
				<div class="col-lg-4 package-item float-left">
		            <div class="card">
		                <div class="card-body">
			                <div class="d-flex justify-content-between">
			                	<div class="m-b-10">
				                <small class="text-center font-weight-bold radio-text">${defaultText}</small>
	                                <label class="pointer custom-control custom-radio">
	                                    <input id="radio" name="is_default" value="" type="radio" class="radio custom-control-input" ${defaultChecked}>
	                                    <span class="custom-control-label"></span>
	                                </label>
	                            </div>
			                	<div>
			                		<a class="pointer edit"><i class="text-warning fa fa-pencil mb-3"></i></a>
				                	<a class="pointer delete"><i class="text-danger fa fa-trash mb-3 ml-2"></i></a>
			                	</div>
	                        </div>
		                	<div class="b-all">
	                            <div class="pricing-header mt-3 mb-2">
	                                <h4 class="package-name pointer text-center px-3">${obj.package_name}</h4>

	                                <h1 class="package-price pointer text-center px-3"><span class="price-sign">$</span>${obj.package_price}</h1>
	                                <p class="text-center uppercase"><small class="font-weight-bold">per month</small></p>
	                            </div>
	                            <div class="price-table-content mb-3">
	                                <div class="package-desc pointer text-center p-20 px-3 b-t b-b">${obj.package_desc}</div>
	                                <div class="package-include pointer text-center p-20 px-3  b-t b-b">${obj.package_include}</div>
		                                <div class="text-center font-weight-bold mt-3">Package Includes</div>
				                                <div class="bid-number pointer text-center px-3">${obj.bid_number} number of bids</div>
				                                <div class="post-number pointer text-center px-3">${obj.post_number} number of post</div>
			                    </div>
	                                <div class="submit-edit pointer text-center mb-3"></div>
                            	</div>
                           
                          </div>
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

		$(document).on('change','#radio',function(e){
			e.preventDefault();
			var radioItem = $(this).parents('.package-item');
			index = $(this).parents('.package-item').index();
			var data = table.fetch(index);
			radioItem.find('.radio').attr('checked', 'checked');
			$('.radio-text').text('Set as default');
			radioItem.find('.radio-text').attr('checked', 'checked').text('Setted as default');
			var serial = $('#frm-package').serializeArray();
			var action = "/admin/settings/package-settings/default-package/" + data.id;
			var that = $(this);

			$.ajax({
				url:action,
				type:'POST',
				data : serial,
				success:function(res){
					if(res.success){
						toastr.success('You have changed the default Package!', 'Success');
					}
				}
			});

		});

		$(document).on('submit','#frm-package',function(e){
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
					if(d.is_default == 1){
							var defaultChecked = `checked`;
							var defaultText = `Setted as default`;
						}else{
							var defaultChecked = '';
							var defaultText = `Set as default`;
						}
					var data = {
						data:d,
						template:`
				<div class="col-lg-4 package-item float-left">
		            <div class="card">
		                <div class="card-body">
		               	<div class="d-flex justify-content-between">
			                <div class="m-b-10">
				                <small class="text-center font-weight-bold radio-text">${defaultText}</small>
	                                <label class="pointer custom-control custom-radio">
	                                    <input id="radio" name="is_default" value="" type="radio" class="radio custom-control-input" ${defaultChecked}>
	                                    <span class="custom-control-label"></span>
	                                </label>
	                            </div>
			                	<div>
			                		<a class="pointer edit"><i class="text-warning fa fa-pencil mb-3"></i></a>
				                	<a class="pointer delete"><i class="text-danger fa fa-trash mb-3 ml-2"></i></a>
			                	</div>
	                        </div>
		                	<div class="b-all">
	                            <div class="pricing-header mt-3 mb-2">
	                                <h4 class="package-name pointer text-center">${d.package_name}</h4>
	                                <h1 class="package-price pointer text-center px-3"><span class="price-sign">$</span>${d.package_price}</h1>
	                                <p class="text-center uppercase"><small class="font-weight-bold">per month</small></p>
	                            </div>
	                            <div class="price-table-content mb-3">
	                                <div class="package-desc pointer text-center p-20 px-3 b-t b-b">${d.package_desc}</div>
	                                <div class="package-include pointer text-center p-20 px-3  b-t b-b">${d.package_include}</div>
		                                <div class="text-center font-weight-bold mt-3">Package Includes</div>
				                                <div class="bid-number pointer text-center px-3">${d.bid_number} number of bids</div>
				                                <div class="post-number pointer text-center px-3">${d.post_number} number of post</div>
			                    </div>
	                                <div class="submit-edit pointer text-center"></div>
                            	</div>
                           
                          </div>
		                </div>
		            </div>
	        	</div><!--End of column-->
						`
					}

					if(that.attr('data-action') == "update"){
						data.index = index;
						table.dataReplace(data);
						toastr.success('You have successfully updated a Package setting!', 'Success');
					}else{
						table.dataPrepend(data);
						$('.add-field').remove();
						$('.button-edit').remove();
						toastr.success('You have successfully added a Package setting.', 'Success');
					}

					index = null;
				}else{
					$('.name-package').text(res.errors.package_name);
					$('.price-package').text(res.errors.package_price);
					$('.desc-package').text(res.errors.package_desc);
					$('.include-package').text(res.errors.package_include);
					$('.bid-package').text(res.errors.bid_number);
					$('.post-package').text(res.errors.post_number);
				}
			}
		});
	});
		$(document).on('click','.cancel-add',function(e){
			$('.add-field').remove();
		});
	$(document).on('click','.add',function(e){
		$('#no-results').remove();
		$(".container-fluid").find('form').attr('data-action','');
		$(".container-fluid").find('form').attr('action','/admin/settings/package-settings/create');
		if($('.package-item').hasClass('add-field') || $('.package-item').hasClass('form-edit')){
			toastr.warning('Oops!, you cannot add more package forms. Please submit the form and try again.', 'Warning', {timeOut: 8000});
			return
		}
		else{

		table.prepend(`

			<div class="col-lg-4 package-item add-field float-left">
		            <div class="card">
		                <div class="card-body">
		               	<table>
		               		<tr>
		                    	<td>
				                   <a class="pointer cancel-add" data-id="${index}"><i class="text-danger mdi mdi-close mb-3 ml-2"></i></a>
				                </td>
			                </tr>
						</table>
		                	<div class="">
	                            <div class="pricing-header mt-3">
	                                <input type="text" placeholder="Package Name" class="form-control" name="package_name">
	                                	<small class="name-package error text-danger"></small>
	                                <input type="text" placeholder="Price" class="form-control mt-3" name="package_price">
	                                	<small class="price-package error text-danger"></small>
	                                <p class="text-center uppercase"><small class="font-weight-bold">per month</small></p>
	                            </div>
	                            <div class="price-table-content mb-2 mt-3">
	                                <input type="text" placeholder="Description" class="form-control" name="package_desc">
	                                	<small class="desc-package error text-danger"></small>
	                                <textarea class="form-control mt-3" placeholder="Features" name="package_include" rows="2"></textarea>
	                                	<small class="include-package error text-danger px-3 p-20"></small>
		                                <div class="text-center font-weight-bold">Package Includes</div>
				                                <input type="number" class="form-control px-3" name="bid_number"><span>number of bids</span><br>
				                                	<small class="bid-package error text-danger"></small>
				                                <input type="number" class="form-control mt-3" name="post_number"><span>number of post</span><br>
				                                <small class="post-package error text-danger"></small>
			                    </div>
	                                <button type="submit" class="btn btn-danger waves-effect text-left mt-3">Save</button>
                            	</div>
                           
                          </div>
		                </div>
		            </div>
	        	</div><!--End of column-->
			`);
		}
	});

	$(document).on('click','.edit',function(e){
		if($('.package-item').hasClass('form-edit') || $('.package-item').hasClass('add-field')){
			toastr.warning('Oops!, there seems to be an open edit form. Please submit or cancel the form edit and try again.', 'Warning', {timeOut: 8000});
			return
		}
		else{
		index = $(this).parents('.package-item').index();
		$(this).parents('.package-item').addClass("form-edit");
		var data = table.fetch(index);
		var settingItem = $(this).parents('.package-item');
		$(".container-fluid").find('form').attr('data-action','update');
		$(".container-fluid").find('form').attr('action','/admin/settings/package-settings/update/' + data.id);
		settingItem.find('.package-name').html(`<input type="text" class="form-control" name="package_name" value="${data.package_name}">
												<small class="name-package error text-danger"></small>`);
		settingItem.find('.package-price').html(`<input type="text" class="form-control" name="package_price" value="${data.package_price}">
			<small class="price-package error text-danger"style="font-size:15px;"></small>`);
		settingItem.find('.package-desc').html(`<input type="text" class="form-control" name="package_desc" value="${data.package_desc}">
												<small class="desc-package error text-danger"></small>`);
		settingItem.find('.package-include').html(`<textarea rows="2" class="mt-3 form-control" name="package_include">${data.package_include}</textarea>
			<small class="include-package error text-danger"></small>`);
		settingItem.find('.bid-number').html(`<input type="number"class="mt-3 form-control" name="bid_number" value="${data.bid_number}"><span>number of bids</span>
			<small class="bid-package error text-danger"></small>`);
		settingItem.find('.post-number').html(`<input type="number"class="mt-3 form-control" name="post_number" value="${data.post_number}"><span>number of post</span>
			<small class="post-package error text-danger"></small>`);
		settingItem.find('.submit-edit').html(`<button type="submit" class="btn btn-danger waves-effect text-left mt-3 button-edit">Save</button>
			<button type="reset" class="btn btn-inverse waves-effect text-left mt-3 cancel-submit">Cancel</button>`);
		return false;
		}

	});

	$(document).on('click', '.cancel-submit',function(e){
		$(this).parents('.package-item').removeClass("form-edit");
		index = $(this).parents('.package-item').index();
		var data = table.fetch(index);
		if(data.is_default == 1){
							var defaultChecked = `checked`;
							var defaultText = `Setted as default`;
						}else{
							var defaultChecked = '';
							var defaultText = `Set as default`;
						}
			$(this).parents('.package-item').html(`
		             <div class="card">
		                <div class="card-body">
			               	<div class="m-b-10">
					                <small class="text-center font-weight-bold radio-text">${defaultText}</small>
		                                <label class="pointer custom-control custom-radio">
		                                    <input id="radio" name="is_default" value="" type="radio" class="radio custom-control-input" ${defaultChecked}>
		                                    <span class="custom-control-label"></span>
		                                </label>
		                            </div>
				                	<div>
				                		<a class="pointer edit"><i class="text-warning fa fa-pencil mb-3"></i></a>
					                	<a class="pointer delete"><i class="text-danger fa fa-trash mb-3 ml-2"></i></a>
				                	</div>
		                        </div>
		                	<div class="b-all">
	                            <div class="pricing-header mt-3 mb-2">
	                                <h4 class="package-name pointer text-center px-3">${data.package_name}</h4>

	                                <h1 class="package-price pointer text-center px-3"><span class="price-sign">$</span>${data.package_price}</h1>
	                                <p class="text-center uppercase"><small class="font-weight-bold">per month</small></p>
	                            </div>
	                            <div class="price-table-content mb-3">
	                                <div class="package-desc pointer text-center p-20 px-3 b-t b-b">${data.package_desc}</div>
	                                <div class="package-include pointer text-center p-20 px-3  b-t b-b">${data.package_include}</div>
		                                <div class="text-center font-weight-bold mt-3">Package Includes</div>
				                                <div class="bid-number pointer text-center px-3">${data.bid_number} number of bids</div>
				                                <div class="post-number pointer text-center px-3">${data.post_number} number of post</div>
			                    </div>
	                                <div class="submit-edit pointer text-center mb-3"></div>
                            	</div>
                           
                          </div>
		                </div>
		            </div>

					`);
	});

	$(document).on('click','.delete',function(e){
		index = $(this).parents('.package-item').index();
		var data = table.fetch(index);

		$.ajax({
			url:'/admin/settings/package-settings/delete/' + data.id,
			type:'POST',
			success:function(res){
				if(res.success){
					toastr.error('You have just deleted a  Package settings', 'Danger')
					table.dataRemove(index);
				}else{
					alert("failed");
				}
			}
		})
	});


});