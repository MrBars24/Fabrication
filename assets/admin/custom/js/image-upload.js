$(document).ready(function(){
	var f = null;
	var options = null;
	var $image = null;
	var $download = null;
	var $dataX = null;
	var $dataY = null;
	var $dataHeight = null;
	var $dataWidth = null;
	var $dataRotate = null;
	var $dataScaleX = null;
	var $dataScaleY = null;
	var type = '';
	var name = '';

	$('#uploadModal').on('hidden.bs.modal', function() {
		$("#upload").val('');
	});

	$('#uploadModal').on('shown.bs.modal', function() { 
		$image = $('#image');
		$download = $('#download');
		$dataX = $('#dataX');
		$dataY = $('#dataY');
		$dataHeight = $('#dataHeight');
		$dataWidth = $('#dataWidth');
		$dataRotate = $('#dataRotate');
		$dataScaleX = $('#dataScaleX');
		$dataScaleY = $('#dataScaleY');	

		options = {
	    aspectRatio: 16 / 9,
	    preview: '.img-preview',
	    crop: function (e) {
	      $dataX.val(Math.round(e.x));
	      $dataY.val(Math.round(e.y));
	      $dataHeight.val(Math.round(e.height));
	      $dataWidth.val(Math.round(e.width));
	      $dataRotate.val(e.rotate);
	      $dataScaleX.val(e.scaleX);
	      $dataScaleY.val(e.scaleY);
	    },
	    viewMode:1,
	    dragMode:'crop'
	  	};

		$image.cropper(options).on({
		    'build.cropper': function (e) {
		      //console.log(e.type);
		    },
		    'built.cropper': function (e) {
		      //console.log(e.type);
		    },
		    'cropstart.cropper': function (e) {
		      //console.log(e.type, e.action);
		    },
		    'cropmove.cropper': function (e) {
		      //console.log(e.type, e.action);
		    },
		    'cropend.cropper': function (e) {
		      //console.log(e.type, e.action);
		    },
		    'crop.cropper': function (e) {
		      //console.log(e.type, e.x, e.y, e.width, e.height, e.rotate, e.scaleX, e.scaleY);
		    },
		    'zoom.cropper': function (e) {
		    	e.preventDefault();
		    },
		    'ready.cropper':function(e){
		    	
		    }
		});
	});

	$(document).on("submit","#frm-upload",function(e){
		e.preventDefault();

		result = $image.cropper('getCroppedCanvas');
		var tmp = result.toDataURL();
		$.ajax({
			url:"/admin/upload/image",
			type:"POST",
			data:{
				src:tmp,
				filename:name,
				filetype:type
			},
			success:function(res){
				if(res.success){
					console.log(res);
					$('#uploadModal').modal('toggle');
				}
			}
		});
	});

	$(document).on('click',".btn-image",function(){
		$("#upload").trigger('click');
	});

	$(document).on('change',"#upload",function () {
	    var files = this.files;
	    var file;

      	if (files && files.length) {
	        file = files[0];
	        type = file.type;
	        name = file.name;
	        var fr = new FileReader();
	        fr.onload = function () {
	            document.getElementById("image").src = fr.result;
	        }
	        fr.readAsDataURL(files[0]);
	        //return;
	        $('#uploadModal').modal('toggle');
	    }
	});

	$('.docs-toggles').on('change', 'input', function () {
	    var $this = $(this);
	    var name = $this.attr('name');
	    var type = $this.prop('type');
	    var cropBoxData;
	    var canvasData;

	    if (!$image.data('cropper')) {
	      return;
	    }

	    if (type === 'checkbox') {
	      options[name] = $this.prop('checked');
	      cropBoxData = $image.cropper('getCropBoxData');
	      canvasData = $image.cropper('getCanvasData');

	      options.built = function () {
	        $image.cropper('setCropBoxData', cropBoxData);
	        $image.cropper('setCanvasData', canvasData);
	      };
	    } else if (type === 'radio') {
	      options[name] = $this.val();
	    }

	    $image.cropper('destroy').cropper(options);
	});


	/*$(".table-assets").initTable({
		url:"/admin/image/assets/list",
		columns:[
			{"data":"path"},
			{"data":"filename"},
			{"data":"add_time"}
		]
	});*/

	var table = $(".pagination-container").initTable({
		url:"/admin/image/assets/list",
		pageContainer:".pagination-bars",
		render:function(data){
			var container = ``;
			data.forEach(function(obj,index){
				container += `
					<tr>
						<td>${obj.path}</td>
						<td>${obj.filename}</td>
						<td>${obj.add_time}</td>
					</tr>
				`;
			});

			return container;
		}
	});

	$(document).on("keydown",".frm-search",function(e){
		if(e.keyCode==13){
			var search = {
				filename : $(this).val()
			};

			table.search(search);
		}
	});

	/*initTable({
		element: $(".table-assets"),
		
	});*/
});