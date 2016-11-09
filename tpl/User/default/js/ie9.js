$(document).ready(function(){
	var b = (function(){
	    var ua= navigator.userAgent, 
		    N= navigator.appName, tem, 
		    M= ua.match(/(opera|chrome|safari|firefox|msie|trident)\/?\s*([\d\.]+)/i) || [];
		    M= M[2]? [M[1], M[2]]:[N, navigator.appVersion, '-?'];
		    if(M && (tem= ua.match(/version\/([\.\d]+)/i))!= null) M[2]= tem[1];
		    // return M.join(' ');
		    return M;
	})();
	if ((b[0]=='msie' || b[0]=='MSIE') && (parseInt(b[1])<9)){
		$('.topNavBox').css('margin-top', '32px');
		$('#ie9version').css('display', 'inline');
	}
});
