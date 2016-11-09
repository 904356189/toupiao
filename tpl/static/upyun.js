function upyunPicUpload(domid,width,height,token){
	art.dialog.data('width', width);
	art.dialog.data('height', height);
	art.dialog.data('domid', domid);
	art.dialog.data('lastpic', $('#'+domid).val());
	art.dialog.open('?g=User&m=Upyun&a=upload&token='+token+'&width='+width,{lock:true,title:'上传图片',width:600,height:400,yesText:'关闭',background: '#000',opacity: 0.45});
}
function upyunWapPicUpload(domid,width,height,token){
	art.dialog.data('width', width);
	art.dialog.data('height', height);
	art.dialog.data('domid', domid);
	art.dialog.data('lastpic', $('#'+domid).val());
	art.dialog.open('?g=User&m=Upyun&a=upload&from=Wap&token='+token+'&width='+width,{lock:true,title:'上传图片',width:260,height:150,top:100,yesText:'关闭',background: '#000',opacity: 0.65});
}
function viewImg(domid){
	if($('#'+domid).val()){
		var html='<img src="'+$('#'+domid).val()+'" />';
	}else{
		var html='没有图片';
	}
	art.dialog({title:'图片预览',content:html,lock:true,background: '#000',opacity: 0.45});
}
function addLink(domid,iskeyword){
	art.dialog.data('domid', domid);
	art.dialog.open('?g=User&m=Link&a=insert&iskeyword='+iskeyword,{lock:true,title:'插入链接或关键词',width:600,height:400,yesText:'关闭',background: '#000',opacity: 0.45});
}
function chooseFile(domid,type){
	art.dialog.data('domid', domid);
	art.dialog.open('?g=User&m=Attachment&a=index&type='+type,{lock:true,title:'选择文件',width:600,height:400,yesText:'关闭',background: '#000',opacity: 0.45});
}

function chooseTpl(domid,domid2,type){
	art.dialog.data('domid', domid);
	art.dialog.data('domid2', domid2);
	if(type == 1 || type == 3 || type == 5 || type == 6){
		art.dialog.open('?g=User&m=Classify&a=chooseTpl&type='+type,{lock:true,title:'选择模板',width:1093,height:550,yesText:'关闭',background: '#000',opacity: 0.45});
	}else{
		art.dialog.open('?g=User&m=Classify&a=chooseTpl&tpid='+domid+'&type='+type,{lock:true,title:'预览选中模板',width:500,height:390,yesText:'关闭',background: '#000',opacity: 0.45});
	}
}
/*选择底部菜单*/
function chooseMenu(domid,domid2){
	art.dialog.data('domid', domid);
	art.dialog.data('domid2', domid2);
	art.dialog.open('?g=User&m=Catemenu&a=chooseMenu',{lock:true,title:'选择样式',width:1050,height:450,yesText:'关闭',background: '#000',opacity: 0.45});
}

function editClass(domid,domid2,cid){
	art.dialog.data('domid', domid);
	art.dialog.data('domid2', domid2);
	art.dialog.data('cid', cid);
	art.dialog.open('?g=User&m=Img&a=editClass&id='+cid,{lock:true,title:'选择分类',width:600,height:500,yesText:'关闭',background: '#000',opacity: 0.45});
}

function memberCardRecharge(uid){
	art.dialog.data('uid', uid);
	art.dialog.open('?g=User&m=Member_card&a=recharge&uid='+uid,{lock:true,title:'充值会员卡',width:600,height:400,yesText:'关闭',background: '#000',opacity: 0.45});
}
