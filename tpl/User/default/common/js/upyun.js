function upyunPicUpload(domid,width,height,token){
	art.dialog.data('width', width);
	art.dialog.data('height', height);
	art.dialog.data('domid', domid);
	art.dialog.data('lastpic', $('#'+domid).val());
	art.dialog.open('/index.php?g=User&m=Upyun&a=upload&token='+token+'&width='+width,{lock:false,title:'ÉÏ´«Í¼Æ¬',width:400,height:200,yesText:'¹Ø±Õ',background: '#000',opacity: 0.87});
}