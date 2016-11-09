;(function($){
	$.fn.mySlider = function( opt ) {
		var defaults = {
				speed: 300,
				direction: 'left', //  运动方向 可选 left,top
				prevClass: 'slider-prev',
				nextClass: 'slider-next',
				wrapperClass: 'slider-wrapper',
				moveClass: 'slider-move'
		};
		
		var options = $.extend( defaults, opt );
		var dir = options.direction;
		var $slider = $( this ),
			$wrapper = $( '.' + options.wrapperClass, $slider ),
			$sliderPrev = $( '.' + options.prevClass, $slider ),
			$sliderNext = $( '.' + options.nextClass, $slider ),
			$sliderMove = $( '.' + options.moveClass, $slider ),
			$item = $sliderMove.children(),
			timer = null;
		

		//初始化样式
		if( dir == 'left' ) {
			var $iSteep = $item.outerWidth();
			$sliderMove.css('width',$item.length * $iSteep +'px' );
		} 
		else if( dir == 'top' ) {
			var $iSteep = $item.outerHeight();
			$sliderMove.css('height',$item.length * $iSteep +'px' );
		};

		//添加点击事件
		$sliderNext.on('click',moveNext);
		$sliderPrev.on('click',movePrev);

		
		//缓存运动样式
		var data1 = {}, data2 = {};
		data1[dir] = -$iSteep;
		data2[dir] = 0;

		//运动样式函数
		function moveNext(){
			$sliderMove.css( dir,-$iSteep+'px').children().last().prependTo( $sliderMove );
			$sliderMove.animate(data2,  options.speed);
		};

		function movePrev(){
			$sliderMove.animate( data1,  options.speed, function(){
				$sliderMove.css( dir, 0 ).children().first().appendTo( $sliderMove );
			});
		};
		
		return this; //返回当前对象,保证可链式操作
	}
})(jQuery);
