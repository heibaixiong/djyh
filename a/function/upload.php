<?php
if(!defined('PART'))exit;
$id=V1;
$form=V2;
function _upmovie($id,$form){
	if(!empty($_FILES['strPhoto']['name'])){
		_fun('file');
		$file_name=_file_load('strPhoto');
		if(empty($file_name)){
			echo '<span style=\"color:red;line-height: 25px;\">上传错误请重试！></span>';
		}else{
			echo '<script language=\'javascript\'>window.opener.document.'.$form.'.'.$id.'.value=\''.$file_name.'\';window.close();</script>';
		}
	}else{
		echo '<span style=\"color:red;line-height:25px;\">请选择需要上传的文件</span>';
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>图片上传</title>
</head>
<body>
<SCRIPT language=javascript>
function check(){
	var strFileName=document.form.strPhoto.value;
	if(strFileName==""){
		alert("请选择要上传的文件");
		document.form.strPhoto.focus();
		return false;
	}
	return true;
}
</SCRIPT>
<form action="<?php echo INDEX;?>?upload/<?php echo $id;?>/<?php echo $form;?>/" enctype="multipart/form-data" name="form" method="POST" onSubmit="if(!check())return false;">
<br/>
<?php
_upmovie($id,$form);
?><br/><br/>
<input name="strPhoto" type="file" id="strPhoto" size="35">
<input name="id" type="hidden" id="id" value="<? echo $id?>">
<input type="submit" name="Submit" value="上 传" class=inputbut />
</form>
</body>
</html>