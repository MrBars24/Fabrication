(function($){
	var _limit = 10,
	_data = [],
	_data_hash = "",
	_page = 1,
	_url = "",
	_cols = null,
	_ref = "",
	_options = {},
	_pageContainer = "",
	_search = "",
	_is_search = false,
	_threshold = 100,
	_processing = false,
	_type = null,
	_total = 100,
	_beforeRequest = null,
	_successRequest = null,
	_loaderContainer = '',
	_loader = `<svg class="circular-static d-flex" viewBox="25 25 50 50">
		<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle> 
	</svg>`,
	_pageLoader = `<svg class="circular d-flex" viewBox="25 25 50 50">
		<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle> 
	</svg>`;

	$.fn.initTable = function(option){
		_type = "pagination";
		_options = option;
		_url = option.url;
		_cols = option.columns;

		if(option.limit != null){
			_limit = option.limit;
		}

		if(option.search != null){
			_search = option.search;
		}

		if(option.onSuccessRequest != null){
			_successRequest = option.onSuccessRequest;
		}

		if(option.onBeforeRequest != null){
			_beforeRequest = option.onBeforeRequest;
		}

		_pageContainer = option.pageContainer;
		_loaderContainer = option.loaderContainer;
		_ref = this;
		$.fn.requestData();

		return this;
	}

	$.fn.infiniteScroll = function(option){
		_type = "infinity_scroll";
		_options = option;
		_url = option.url;
		_cols = option.columns;
		_ref = this;

		if(option.limit != null){
			_limit = option.limit;
		}

		if(option.threshold != null){
			_threshold = option.threshold;
		}

		if(option.onSuccessRequest != null){
			_successRequest = option.onSuccessRequest;
		}

		if(option.onBeforeRequest != null){
			_beforeRequest = option.onBeforeRequest;
		}

		if(option.search != null){
			_search = option.search;
		}

		if(option.loaderContainer != null){
			_loaderContainer = option.loaderContainer;
		}

		if(_loaderContainer == ''){
			_ref.after(_loader);
		}else{
			$(_loaderContainer).html(_loader);
		}

		$.fn.requestData();
		registerScrollEvent();
		return this;
	}

	function registerScrollEvent(){
		$(document).scroll(function(){
			if(_processing) return;
			if(_page >= _total) return;
			
			if ($(window).scrollTop() + $(window).height() > $(document).height() - _threshold){
				_page = _page + 1;
				_processing = true;
				if(_loaderContainer == ''){
					_ref.after(_loader);
				}else{
					$(_loaderContainer).html(_loader);
				}
				$.fn.requestData();
			}
		});
	}

	$.fn.requestData = function(){
		if(_beforeRequest != null){
			_beforeRequest();
		}
		$.ajax({
			url:_url,
			type:"GET",
			data:{
				limit : _limit,
				page : _page,
				search: _search
			},
			success:function(res){
				//console.log(res);
				if(_type == "pagination"){
					_data = res.data;
					_data_hash = btoa(JSON.stringify(_data));
					var template = _options.render(res.data);
					_processing = false;
					generatePagination(_page,res.total);
					_ref.html(template);
				}else{
					if(_data_hash != ""){
						_data = JSON.parse(atob(_data_hash));
					}

					if(_is_search){
						_data = res.data;
						_data_hash = btoa(JSON.stringify(_data));
						var template = _options.render(res.data);
						_total = res.total;
						_ref.html(template);
					}else{
						_data = _data.concat(res.data);
						_data_hash = btoa(JSON.stringify(_data));
						var template = _options.render(res.data);
						_total = res.total;
						_ref.append(template);
					}

					if(_loaderContainer == ''){
						_ref.after(``);
					}else{
						$(_loaderContainer).html(``);
					}

					setTimeout(function(){
						_processing = false;
					},1000);
				}
				if(_successRequest != null){
					_successRequest();
				}
			}
		});
	}


	$.fn.search = function(search){
		_search = search;
		_is_search = true;
		$.fn.requestData();
	}

	$.fn.fetch = function(index){
		var tmp = JSON.parse(atob(_data_hash));
		return tmp[index];
	}

	$.fn.dataFind = function(key,value){
		var tmp = JSON.parse(atob(_data_hash));
		for (var i = 0; i < tmp.length; i++) {
			if(value == tmp[i][key]){
				return tmp[i];
			}
		}

		return [];
	}

	$.fn.dataPrepend = function(t){
		this.prepend(t.template);
		var tmp = JSON.parse(atob(_data_hash));
		tmp.unshift(t.data);
		_data_hash = btoa(JSON.stringify(tmp));
	}

	$.fn.dataReplace = function(t){
		var tmp = JSON.parse(atob(_data_hash));
		tmp[t.index] = t.data;
		_data_hash = btoa(JSON.stringify(tmp));
		this.children().eq(t.index).replaceWith(t.template);
	}

	$.fn.dataRemove = function(index){
		var tmp = JSON.parse(atob(_data_hash));
		tmp.splice(index, 1);
		_data_hash = btoa(JSON.stringify(tmp));
		this.children().eq(index).remove();	
		console.log(_data);
	}

	$(document).on('click','.page-link',function(){
		if(_processing) return;
		//if($(this).text() == "Previous" || $(this).text() == "Next") return;
		if($(this).text() == "Next"){
			++_page;

		}else if($(this).text() == "Previous"){
			--_page;
		}else{
			_page = $(this).text();
		}
		_processing = true;
		$.fn.requestData();
	});

	function generatePagination(current,max){
		if(max == 0){
			$(_pageContainer).html("");
			return;
		}
		current = parseInt(current);
		$(_pageContainer).html(``);

		var left = 3;
		var right = 3;

		var prevStat = (current==1) ? "disabled" : "";
		var nextStat = (current == max) ? "disabled" : "";
		$(_pageContainer).prepend(`<li class="page-item page-item-prev ${prevStat}">
        	<a class="page-link" tabindex="-1">Previous</a>
    	</li>`);
		$(".page-item-prev").after(`<li class="page-item active"><a class="page-link">${_page}</a></li>`);

		for(var i=0; i < 6; i++){
			if(i%2==0){
				if(current+right > max){
					right--;
					continue;
				}
				$(".page-item.active").after(`<li class="page-item"><a class="page-link">${current+right}</a></li>`);
				right--;
			}else{
				if(current-left < 1){
					left--;
					continue;
				}
				$(".page-item.active").before(`<li class="page-item"><a class="page-link">${current-left}</a></li>`);
				left--;
			}
		}

        $(_pageContainer).append(`<li class="page-item page-item-next ${nextStat}">
            <a class="page-link">Next</a>
        </li>`);
	}

})(jQuery);