(function($) {                                          // Compliant with jquery.noConflict()
$.fn.jCarouselLite = function(o) {
    o = $.extend({
        auto: null,

        speed: 200,
        easing: null,

        vertical: false,
        circular: true,
        visible: 4,
        start: 0,
        scroll: 2,

        beforeStart: null,
        afterEnd: null
    }, o || {});

    return this.each(function() {                           // Returns the element collection. Chainable.

        var running = false, animCss="top", sizeCss="height";
        var div = $(this), ul = $("ul", div), tLi = $("li", ul), tl = tLi.size(), v = o.visible;
		var slide_interval = null;
		if(tl <= v) return;
		if(tl % 2 == 1){
			ul.append('<li class="blank"></li>');
			tLi = $("li", ul), tl = tLi.size();
		}
        if(o.circular) {
            ul.prepend(tLi.slice(tl-v).clone())
              .append(tLi.slice(0,v).clone());
            o.start += v;
        }

        var li = $("li", ul), itemLength = li.size(), curr = o.start;
        div.css("visibility", "visible");

        ul.css({position: "relative", "z-index": "1"});
        div.css({position: "relative", "z-index": "2"});

        var liSize = li.outerHeight();   // Full li size(incl margin)-Used for animation
        var ulSize = liSize * itemLength / 2;                   // size of full ul(total length, not just for the visible items)
        var divSize = liSize * v / 2;                           // size of entire div(total length for just the visible items)

        ul.css(sizeCss, ulSize+"px").css(animCss, -(curr*liSize/2));
		if(o.auto) {
			ul.hover(function() {
				clearInterval(slide_interval);
			},function(){
				slide_interval = setInterval(function() {
					go(curr+o.scroll);
				}, o.auto+o.speed);
			});
		}
        div.css(sizeCss, divSize+"px");                     // Width of the DIV. length of visible images

        if(o.auto)
            slide_interval = setInterval(function() {
                go(curr+o.scroll);
            }, o.auto+o.speed);

        function vis() {
            return li.slice(curr).slice(0,v);
        };

        function go(to) {
            if(!running) {

                if(o.beforeStart)
                    o.beforeStart.call(this, vis());

                if(o.circular) {            // If circular we are in first or last, then goto the other end
                    if(to<=o.start-v-2) {           // If first, then goto last 2
                        ul.css(animCss, -((itemLength-(v*2))*liSize)+"px");
                        // If "scroll" > 1, then the "to" might not be equal to the condition; it can be lesser depending on the number of elements.
                        curr = to==o.start-v-1 ? itemLength-(v*2)-1 : itemLength-(v*2)-o.scroll;
                    } else if(to>=itemLength-v+2) { // If last, then goto first 2
                        ul.css(animCss, -liSize + "px" );
                        // If "scroll" > 1, then the "to" might not be equal to the condition; it can be greater depending on the number of elements.
                        curr = to==itemLength-v+2 ? v+2 : v+o.scroll;
                    } else curr = to;
                } else {                    // If non-circular and to points to first or last, we just return.
                    if(to<0 || to>itemLength-v+2) return;
                    else curr = to;
                }                           // If neither overrides it, the curr will still be "to" and we can proceed.

                running = true;

                ul.animate(
                    { top: -(curr*liSize/2) } , o.speed, o.easing,
                    function() {
                        if(o.afterEnd)
                            o.afterEnd.call(this, vis());
                        running = false;
                    }
                );

            }
            return false;
        };
    });
};

function css(el, prop) {
    return parseInt($.css(el[0], prop)) || 0;
};
function width(el) {
    return  el[0].offsetWidth + css(el, 'marginLeft') + css(el, 'marginRight');
};
function height(el) {
    return el[0].offsetHeight + css(el, 'marginTop') + css(el, 'marginBottom');
};

})(jQuery);