function onloadjs(func){var oldonload=window.onload;if(typeof window.onload!='function'){window.onload = func;}else{window.onload=function(){oldonload();func();}}}
function $$(id){return document.getElementById(id);}
function f(id,name){return id=="d"?document.getElementsByTagName(name):id.getElementsByTagName(name);}
function u(a){return a.getAttribute("u");}
function uu(a,b){return a.setAttribute("u",b);}
function ee(a){return encodeURIComponent(a);}
function para(){
	if(!$$('para'))return false;
	if (u($$('para')) == null) return false;

	var para=u($$('para')).split('@@@');
	var button=f($$('para'),'input');
	for(var i=0;i<para.length-1;i=i+2){
		for(var j=0;j<button.length-1;j=j+2){
			if(para[i]==button[j].value){
				button[j+1].value=para[i+1];
			}
		}
	}
}
function attri(){
	var button=f($$('attri1'),'input');
	for(var i=0;i<button.length;i++){
		button[i].onclick=function(){
			this.className=this.className=='button'?'redbutton':'button';
			u(this)!=false?uu(this,''):uu(this,this.value);
			var li=f($$('attri1'),'li');
			var li_value=Array();
			for(var j=0;j<li.length;j++){
				var button_li=f(li[j],'input');
				li_value[j]='';
				for(var k=0;k<button_li.length;k++){
					if(u(button_li[k])!=false){
						li_value[j]+=u(button_li[k])+',';
					}
				}
			}
			$$('attri2').innerHTML='';
			if(1==li_value.length){
				var arr=li_value[0].split(',');
				for(var i=0;i<arr.length-1;i++){
					$$('attri2').innerHTML+='<li><span>属性：</span>'+arr[i]+' <span>库存：</span><input name=\"attri[]\" type=\"hidden\" value=\"'+arr[i]+'\" /><input name=\"attrivalues[]\" type=\"text\" class=\"ninput\" value=\"0\" /></li>';
				}
			}
			if(2==li_value.length){
				var arr0=li_value[0].split(',');
				var arr1=li_value[1].split(',');
				for(var i=0;i<arr0.length-1;i++){
					for(var j=0;j<arr1.length-1;j++){
						$$('attri2').innerHTML+='<li><span>属性：</span>'+arr0[i]+' × '+arr1[j]+' <span>库存：</span><input name=\"attri[]\" type=\"hidden\" value=\"'+arr0[i]+' × '+arr1[j]+'\" /><input name=\"attrivalues[]\" type=\"text\" class=\"ninput\" value=\"0\" /></li>';
					}
				}
			}
			if(3==li_value.length){
				var arr0=li_value[0].split(',');
				var arr1=li_value[1].split(',');
				var arr2=li_value[2].split(',');
				for(var i=0;i<arr0.length-1;i++){
					for(var j=0;j<arr1.length-1;j++){
						for(var k=0;k<arr2.length-1;k++){
							$$('attri2').innerHTML+='<li><span>属性：</span>'+arr0[i]+' × '+arr1[j]+' × '+arr2[k]+' <span>库存：</span><input name=\"attri[]\" type=\"hidden\" value=\"'+arr0[i]+' × '+arr1[j]+' × '+arr2[k]+'\" /><input name=\"attrivalues[]\" type=\"text\" class=\"ninput\" value=\"0\" /></li>';
							}
					}
				}
			}
			setattri();
		}
	}
}
function setattri(){
	if (!$$('attri1')) return false;
	if (u($$('attri1')) == null) return false;

	var attri=u($$('attri1')).split('@@@');
	var input=f($$('attri2'),'input');
	for(var i=0;i<input.length;i=i+2){
		for(var j=0;j<attri.length;j=j+2){
			if(input[i].value==attri[j]){
				input[i+1].value=attri[j+1];
			}
		}
	}
}
function autoattri(){
	if (!$$('attri1')) return false;
	if (u($$('attri1')) == null) return false;

	var attri=u($$('attri1')).split('@@@');
	var button=f($$('attri1'),'input');
	for(var i=0;i<attri.length-1;i=i+2){
		for(var j=0;j<button.length;j++){
			if(attri[i].indexOf(button[j].value)>-1){
				button[j].className='redbutton';
				uu(button[j],button[j].value);
				}
			}
		$$('attri2').innerHTML+='<li><span>属性：</span>'+attri[i]+' <span>库存：</span><input name=\"attri[]\" type=\"hidden\" value=\"'+attri[i]+'\" /><input name=\"attrivalues[]\" type=\"text\" class=\"ninput\" value=\"'+attri[i+1]+'\" /></li>';
	}
}
//onloadjs(para);
onloadjs(attri);
onloadjs(autoattri);