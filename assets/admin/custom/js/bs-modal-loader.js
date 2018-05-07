(function($){
	$.fn.modalLoader = function(){
		this.find('.modal-content').addClass('modal-animate');
		this.find('.modal-content').prepend(`<div class="container-info">
			<div class="modal-info">
				<div class="signal"></div>
			</div>
		</div>`);
		this.find('.modal-info').css({background:'#1976D2'});
		return this;
	}
	
	$.fn.load = function(){
		this.find('.container-info').addClass('active');
	}
	
	$.fn.unload = function(){
		this.find('.container-info').removeClass('active');
	}
})(jQuery);