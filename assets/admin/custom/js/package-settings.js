$(document).ready(function(){
	var index = null;
	var table = $(".package-container").initTable({
		url:"/admin/settings/package-settings/list",
		render:function(data){
			var container = ``;
			if(data != null){
				data.forEach(function(obj,index){
					container += `
				<div id="hello" class="col-lg-4 package-item float-left">
		            <div class="card">
		                <div class="card-body">
		               	<table>
		               		<tr>
		                    	<td>
			                		<a class="pointer edit"><i class="text-warning fa fa-pencil mb-3"></i></a>
			                    	<a class="pointer delete"><i class="text-danger fa fa-trash mb-3 ml-2"></i></a>
			                    </td>
			                </tr>
						</table>
		                	<div class="pricing-body b-l">
	                            <div class="pricing-header">
	                                <h4 class="package-name pointer text-center">${obj.package_name}</h4>

	                                <h2 class="package-price pointer text-center"><span class="price-sign">$</span>${obj.package_price}</h2>
	                                <p class="pointer text-center uppercase">per month</p>
	                            </div>
	                            <div class="price-table-content">
	                                <div class="package-desc pointer text-center">${obj.package_desc}</div>
	                                <div class="package-include pointer text-center px-3">${obj.package_include}</div>
		                                <div class="text-center font-weight-bold">Package Includes</div>
			                                <div class="row">
				                                <div class="col-md-6">
				                                <div class="bid-number pointer text-center px-3">${obj.bid_number} number of bids</div>
				                                </div>
				                                <div class="col-md-6">
				                                <div class="post-number pointer text-center px-3">${obj.post_number} number of post</div>
				                                </div>
			                                </div>
	                                <div class="submit-edit pointer text-center"></div>
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
				$('.add-field').remove();
				if(res.success){
					var d = res.data;
					$('#no-results').remove('tr');
					var data = {
						data:d,
						template:`
				<div class="col-lg-4 package-item float-left">
		            <div class="card">
		                <div class="card-body">
	                    	<table>
			               		<tr>
			                    	<td>
				                		<a class="pointer edit" data-index="${index}"><i class="text-warning fa fa-pencil mb-3"></i></a>
				                    	<a class="pointer delete" data-id="${index}"><i class="text-danger fa fa-trash mb-3 ml-2"></i></a>
				                    </td>
				                </tr>
							</table>
		                	<div class="pricing-body b-l">
	                            <div class="pricing-header">
	                                <h4 class="package-name pointer text-center">${d.package_name}</h4>
	                                <h2 class="package-price pointer text-center"><span class="price-sign">$</span>${d.package_price}</h2>
	                                <p class="pointer text-center uppercase">per month</p>
	                            </div>
	                            <div class="price-table-content">
	                                <div class="package-desc pointer text-center">${d.package_desc}</div>
	                                <div class="package-include pointer text-center px-3">${d.package_include}</div>
	                                <div class="text-center font-weight-bold">Package Includes</div>
			                                <div class="row">
				                                <div class="col-md-6">
				                                <div class="bid-number pointer text-center px-3">${d.bid_number} number of bids</div>
				                                </div>
				                                <div class="col-md-6">
				                                <div class="post-number pointer text-center px-3">${d.post_number} number of post</div>
				                                </div>
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
					}else{
						table.dataPrepend(data);
						$('.add-field').remove();
						$('.button-edit').remove();
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
		if($('.package-item').hasClass('add-field')){
			return
		}
		else{

		table.prepend(`
			<div class="col-lg-4 float-left package-item add-field">
		            <div class="card">
		                <div class="card-body">
		                			<td>
				                    	<a class="pointer cancel-add" data-id="${index}"><i class="text-danger mdi mdi-close mb-3 ml-2"></i></a>
				                    </td>
		                	<div class="pricing-body b-l">
	                            <div class="pricing-header">
	                                <input type="text" placeholder="Package Name" class="form-control" name="package_name">
	                                <small class="name-package error text-danger"></small>
	                                <input type="text" placeholder="Price" class="form-control mt-3" name="package_price">
	                                <small class="price-package error text-danger"></small>
	                                <p class="pointer text-center uppercase">per month</p>
	                            </div>
	                            <div class="price-table-content">
	                                <input type="text" placeholder="Description" class="form-control mt-3" name="package_desc">
	                                <small class="desc-package error text-danger"></small>
	                                <textarea class="form-control mt-3" placeholder="Features" name="package_include" rows="5"></textarea>
	                                <small class="include-package error text-danger"></small>
	                                <div class="pointer text-center">
	                                <div class="text-center font-weight-bold">Package Includes</div>
			                                <div class="row">
				                                <div class="col-md-6">
				                                	<input type="number" class="form-control mt-3" name="bid_number"><span>number of bids</span>
				                                	<small class="bid-package error text-danger"></small>
				                                </div>
				                                <div class="col-md-6">
				                                <input type="number" class="form-control mt-3" name="post_number"><span>number of post</span>
				                                <small class="post-package error text-danger"></small>
			                               		</div>
	                            			</div>
	                            			<div class="text-center">
	                                     	<button type="submit" class="btn btn-danger waves-effect text-left mt-3">Save</button>
	                                     </div>
                            </div>
                          </div>
		                </div>
		            </div>
	        	</div><!--End of column-->

					`);
		}
	});

	$(document).on('click','.edit',function(e){
		if($('.package-item').hasClass('form-edit')){
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
		settingItem.find('.package-price').html(`<input type="number" class="form-control" name="package_price" value="${data.package_price}">
			<small class="price-package error text-danger"style="font-size:15px;"></small>`);
		settingItem.find('.package-desc').html(`<input type="text" class="form-control" name="package_desc" value="${data.package_desc}">
												<small class="desc-package error text-danger"></small>`);
		settingItem.find('.package-include').html(`<textarea rows="5" class="mt-3 form-control" name="package_include">${data.package_include}</textarea>
			<small class="include-package error text-danger"></small>`);
		settingItem.find('.bid-number').html(`<input type="number"class="mt-3 form-control" name="bid_number" value="${data.bid_number}"><span>number of bids</span>
			<small class="bid-package error text-danger"></small>`);
		settingItem.find('.post-number').html(`<input type="number"class="mt-3 form-control" name="post_number" value="${data.post_number}"><span>number of bids</span>
			<small class="post-package error text-danger"></small>`);
		settingItem.find('.submit-edit').html(`<button type="submit" class="btn btn-danger waves-effect text-left mt-3 button-edit">Save</button>
			<button type="reset" class="btn btn-inverse waves-effect text-left mt-3 cancel-submit">Cancel</button>`);
		return false;
		}

	});

	$(document).on('click', '.cancel-submit',function(e){
		index = $(this).parents('.package-item').index();
		var data = table.fetch(index);
			$(this).parents('.package-item').html(`
		            <div class="card">
		                <div class="card-body">
		               	<table>
		               		<tr>
		                    	<td>
			                		<a class="pointer edit"><i class="text-warning fa fa-pencil mb-3"></i></a>
			                    	<a class="pointer delete"><i class="text-danger fa fa-trash mb-3 ml-2"></i></a>
			                    </td>
			                </tr>
						</table>
		                	<div class="pricing-body b-l">
	                            <div class="pricing-header">
	                                <h4 class="package-name pointer text-center">${data.package_name}</h4>

	                                <h2 class="package-price pointer text-center"><span class="price-sign">$</span>${data.package_price}</h2>
	                                <p class="pointer text-center uppercase">per month</p>
	                            </div>
	                            <div class="price-table-content">
	                                <div class="package-desc pointer text-center">${data.package_desc}</div>
	                                <div class="package-include pointer text-center px-3">${data.package_include}</div>
		                                <div class="text-center font-weight-bold">Package Includes</div>
			                                <div class="row">
				                                <div class="col-md-6">
				                                <div class="bid-number pointer text-center px-3">${data.bid_number} number of bids</div>
				                                </div>
				                                <div class="col-md-6">
				                                <div class="post-number pointer text-center px-3">${data.post_number} number of post</div>
				                                </div>
			                                </div>
	                                <div class="submit-edit pointer text-center"></div>
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
					table.dataRemove(index);
				}else{
					alert("failed");
				}
			}
		})
	});


});