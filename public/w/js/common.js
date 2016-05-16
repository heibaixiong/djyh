/* 公共JS函数、事件文件 */
/* 需引入jQuery库 */


/* 手机号验证 */
function checkTel(tel){
	var reg = /^1[34578]\d{9}$/;
	if(tel == ""){
		return false;	//电话为空
	}else{
		if(reg.test(tel)){				
			return true;	//验证通过
		}else{
			return false;	//格式不正确
		}
	}	
}

/* 脚底冒泡提示事件 */
function tips(name){
	var str='<p id="tips">'+name+'</p>';
	$("body").append(str);
	$("#tips").animate({bottom:'30px'});
	setTimeout(function(){
		$("#tips").remove();
	}, 2000);
}

/* 表单提示事件 */
function tips2(name){
	var str = '';
	str += '<div class="aui-tips aui-tips-danger">';
	str += '<div class="aui-tips-content aui-ellipsis-1">';
	str += '<i class="aui-iconfont aui-icon-warnfill"></i>';
	str += name;
	str += '<i class="aui-iconfont aui-icon-roundclosefill"></i>';
	str += '</div>';
	str += '</div>';
	str += '<p class="aui-text-center">&nbsp;</p>';
	$("#tips2").append(str);
	$("#tips2").fadeToggle();
	setTimeout(function(){
		$("#tips2").fadeToggle();
		$("#tips2").html('');
	}, 2000);
}

/* 加载样式 tag:1打开加载样式;其他关闭加载样式 */
function loading(tag){
	if(tag == 1){
		$("body").append('<div class="aui-loading"><div class="aui-loading-1"></div><div class="aui-loading-2"></div></div>');
	}else{
		$(".aui-loading").remove();
	}
}

/* dialog弹框 */
var dialog = function(opts,callback){
	var title='提示',
		content = '消息',
		radius=0,
		buttons=['确定','取消'],
		titleColor='#333',
		contColor='#666',
		btnColor='#ff6464';
	var _setting = function(){
		title = opts.title?opts.title:title;
		content = opts.content?opts.content:content;
		radius = opts.radius?opts.radius:radius;
		buttons = opts.buttons?opts.buttons:buttons;
		titleColor = opts.titleColor?opts.titleColor:titleColor;
		contColor = opts.contColor?opts.contColor:contColor;
		btnColor = opts.btnColor?opts.btnColor:btnColor;
	}
	var _init = function(){
		var str = '<div style="position:fixed;width:100%;height:100%;top:0;left:0;background:rgba(0, 0, 0, 0.6);z-index:1000;" id="dialog-box">';
		str += '<div style="position:fixed;z-index:10000;width:85%;top:40%;left:50%;-webkit-transform: translate(-50%, -50%);transform:translate(-50%, -50%);background-color:#FAFAFC;text-align: center;border-radius:3px">';
		if(title.length > 0){
			str +='<div style="padding:10px 15px 0 15px;text-align:center;font-size:1em;color:'+titleColor+'">'+title+'</div>';
		}
		str += '<div style="padding:15px;overflow:hidden;font-size:0.875em;color:'+contColor+';text-align:left !important;">'+content+'</div>';
		str += '<div style="position:relative;font-size:1em;height:54px;border-top:1px solid #e5e5e5;">';
		str += '<div style="position:absolute;width:'+(buttons.length == 1 ? '100%' : '50%')+';top:0;right:0;text-align:center;padding:15px 0;display: block;color:'+btnColor+'" id="dialog-ok">'+buttons[0]+'</div>';
		if(buttons.length == 2){
			str += '<div style="position:absolute;width:50%;top:0;left:0;text-align:center;padding:15px 0;display:block;-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1;border-right:1px solid #e5e5e5;color:'+btnColor+'" id="dialog-cancle">'+buttons[1]+'</div>';
		}
		str += '</div>';
		str += '</div>';
		str += '</div>';
		$("body").append(str);
		document.getElementById("dialog-ok").addEventListener('click',cb1);
		buttons.length == 2 ? document.getElementById("dialog-cancle").addEventListener('click',cb2) : '';
	}
	var cb1 = function(){
		document.getElementById("dialog-box").remove();
		if(callback){
			callback(1);
		}
	}
	var cb2 = function(){
		document.getElementById("dialog-box").remove();
		if(callback){
			callback(2);
		}
	}
	_setting();
	_init();
}


/* 日历展示 */
var calendar = function(element,opts,callback){
	var todayDate = new Date();
	var _startDate = '',
		_endDate = '',
		beforeStartDateClick = false;
	var _weekArr = "日,一,二,三,四,五,六",
		_monthArr = new Array ('1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月');
	var calendarData = new Array(100);
	var madd = new Array(12);
	var numString = "一二三四五六七八九十";
	var monString = "正二三四五六七八九十冬腊";
	var cYear,cMonth,cDay,TheDate;
	calendarData = new Array(0xA4B,0x5164B,0x6A5,0x6D4,0x415B5,0x2B6,0x957,0x2092F,0x497,0x60C96,0xD4A,0xEA5,0x50DA9,0x5AD,0x2B6,0x3126E, 0x92E,0x7192D,0xC95,0xD4A,0x61B4A,0xB55,0x56A,0x4155B, 0x25D,0x92D,0x2192B,0xA95,0x71695,0x6CA,0xB55,0x50AB5,0x4DA,0xA5B,0x30A57,0x52B,0x8152A,0xE95,0x6AA,0x615AA,0xAB5,0x4B6,0x414AE,0xA57,0x526,0x31D26,0xD95,0x70B55,0x56A,0x96D,0x5095D,0x4AD,0xA4D,0x41A4D,0xD25,0x81AA5,0xB54,0xB6A,0x612DA,0x95B,0x49B,0x41497,0xA4B,0xA164B, 0x6A5,0x6D4,0x615B4,0xAB6,0x957,0x5092F,0x497,0x64B, 0x30D4A,0xEA5,0x80D65,0x5AC,0xAB6,0x5126D,0x92E,0xC96,0x41A95,0xD4A,0xDA5,0x20B55,0x56A,0x7155B,0x25D,0x92D,0x5192B,0xA95,0xB4A,0x416AA,0xAD5,0x90AB5,0x4BA,0xA5B, 0x60A57,0x52B,0xA93,0x40E95);
	madd[0] = 0;
	madd[1] = 31;
	madd[2] = 59;
	madd[3] = 90;
	madd[4] = 120;
	madd[5] = 151;
	madd[6] = 181;
	madd[7] = 212;
	madd[8] = 243;
	madd[9] = 273;
	madd[10] = 304;
	madd[11] = 334;
	if(!opts.startDate || opts.startDate == ''){
		_startDate = todayDate.getFullYear()+'-'+(todayDate.getMonth()+1);
	}else{
		_startDate = opts.startDate;
	}
	if(!opts.endDate || opts.endDate == ''){
		_endDate = _startDate;
	}else{
		_endDate = opts.endDate;
	}
	beforeStartDateClick = opts.beforeStartDateClick?opts.beforeStartDateClick:beforeStartDateClick;
	var _init = function(){
		var tableHtml = '';
		var startDate = _startDate.split('-');
		var startYear = parseFloat(startDate[0]);
		var startMonth = parseFloat(startDate[1]);

		var endDate = _endDate.split('-');
		var endYear = parseFloat(endDate[0]);
		var endMonth = parseFloat(endDate[1]);
		// 判断年开始、结束
		if(startYear == endYear){
			if(startMonth > endMonth){// 当为同一年时，如果开始月大于结束月返回错误
				return false;
			}else{
				var yearLen = startYear;
			}
		}else if(endYear > startYear){
			var yearLen = startYear + (endYear - startYear);
		}else{
			return false;
		}
		// 生成日历
		tableHtml += '<div id="calendar" class="aui-content aui-calendar" style="position:absolute;top:0;left:0;z-index:10000;background-color:#f1f1f1;width:100%;min-height:100%;padding:0;">';
		for (var i = startYear; i <= yearLen; i++) {
			if(startYear != i){
				startMonth = 0;
			}else {
				startMonth = startMonth-1;
			}
			for (var ii = startMonth; ii < 12; ii++) {
				if(endYear == i && ii >= endMonth){
					tableHtml += '';
				}else{
					tableHtml += '<table style="position:relative;">';
						tableHtml += '<thead class="aui-calendar-header">';
						tableHtml += '<tr>';
							tableHtml += '<th class="aui-calendar-title aui-text-primary" colspan="7">'+i+'年'+_monthArr[ii]+'</th>';
						tableHtml += '</tr>';
						tableHtml += '<tr class="aui-text-primary" data-year="'+i+'" data-month="'+ii+'">'+_createWeek()+'</tr>';
						tableHtml += '</thead>';
						tableHtml += '<tbody class="aui-calendar-body">';
						tableHtml += _createDay(i,''+(ii+1)+'');
						tableHtml += '</tbody>';
					tableHtml += '</table>';
				}
			}
			tableHtml += '</div>';
		}
		if($("body").append(tableHtml)){
			_callBack();
		}
	}
	// 返回处理
	var _callBack = function(){
		$("#calendar td").click(function(){
			var sel = $(this).attr('date');
			if(sel){
				if(beforeStartDateClick == false){
					// 获取当前时间戳(以s为单位)
					var timestamp = Date.parse(new Date(_startDate));
					//获取选择的时间戳
					var timestamp2 = Date.parse(new Date(sel));
					if(timestamp > timestamp2){
						return false;
					}
				}
				$("#calendar").remove();
				callback(sel);
			}
		});
	}
	// 月份为一位时自动补全0
	var _foo = function(str){
		str ='0'+str;
		return str.substring(str.length-2,str.length);
	}
	// 创建顶部星期
	var _createWeek = function(){
		var html = '';
		var week = _weekArr.split(',');
		for (var i = 0; i < week.length; i++) {
			if(i == 0 || i == 6){
				html += '<th class="aui-text-danger">';
			}else{
				html += '<th class="aui-text-primary">';
			}
			html += week[i];
			html += '</th>';
		}
		return html;
	}
	// 创建日历天
	var _createDay = function(year,month){
		var html = '',
			s = 0,
			d = 1,
			_d = 1;
		// 开始日期有传入天时计算
		if(_startDate.split('-').length > 2 && year == parseFloat(_startDate.split('-')[0]) && month == parseFloat(_startDate.split('-')[1])){
			_d = parseFloat(_startDate.split('-')[2]);
		}
		var firstDay = _getFirstDay(year,month);
		// 当结束日期有传入天时计算
		if(_endDate.split('-').length > 2 && year == parseFloat(_endDate.split('-')[0]) && month == parseFloat(_endDate.split('-')[1])){
			var monthLen = parseFloat(_endDate.split('-')[2]);
			if(_getMonthLen(year,month) < monthLen){
				monthLen = _getMonthLen(year,month);
			}
		}else{
			var monthLen = _getMonthLen(year,month);
		}
		for (var row = 0; row < 6; row++){
			html += '<tr>';
				for (var col = 0; col < 7; col++) {
					if(s >= firstDay && d <= monthLen){
						if(_d > d & beforeStartDateClick == false){
							html += '<td date="'+year+'-'+_foo(month)+'-'+_foo(d)+'" class="before-day" click-status="'+beforeStartDateClick+'">';
						}else{
							if(col==0 || col==6){
								html += '<td date="'+year+'-'+_foo(month)+'-'+_foo(d)+'" class="aui-text-danger">';
							}else{
								html += '<td date="'+year+'-'+_foo(month)+'-'+_foo(d)+'" class="aui-text-primary">';
							}
						}
						// 判断是否为今天
						if(_getToday(year,month,d)){
							html += '<div class="today"></div>' + d;
						}else{
							html += d;
						}
						// 农历
						html += '<p>'+_getLunarDay(''+year+'-'+_foo(month)+'-'+_foo(d)+'')+'</p>';
						d++;
					}else{
						html += '<td>';
					}
					html += '</td>';
					s++;
				}
			html += '</tr>';
			firstDay = firstDay+row;
		}
		return html;
	}
	// 获取当月天数
	var _getMonthLen = function (year,month){
		month = parseInt(month, 10);
		var monthLen = new Date(year, month, 0);
		return monthLen.getDate();
	}
	// 获取今天日期
	var _getToday = function(year,month,date){
		if(year == todayDate.getFullYear() && month == todayDate.getMonth()+1 && date == todayDate.getDate()){
			return true;
		}else {
			return false;
		}
	}
	// 获取月第一天
	var _getFirstDay = function(year,month){ //获取每个月第一天再星期几，月份减一
		month = parseInt(month, 10)-1;
		var firstDay = new Date(year,month,1);
		return firstDay.getDay();
	}
	// 农历的组装
	var _getBit = function(m,n){
		return (m>>n)&1;
	}
	var _e2c = function(){
		TheDate = (arguments.length!=3) ? new Date() : new Date(arguments[0],arguments[1],arguments[2]);
		var total,m,n,k;
		var isEnd = false;
		var tmp = TheDate.getYear();
		if(tmp < 1900){
			tmp += 1900;
		}
		total = (tmp-1921)*365+Math.floor((tmp-1921)/4)+madd[TheDate.getMonth()]+TheDate.getDate()-38;

		if(TheDate.getYear()%4 == 0 && TheDate.getMonth() > 1) {
			total++;
		}
		for(m = 0;;m++){
			k = (calendarData[m]<0xfff)?11:12;
			for(n=k;n>=0;n--){
				if(total<=29 + _getBit(calendarData[m],n)){
					isEnd = true; break;
				}
				total = total-29-_getBit(calendarData[m],n);
			}
			if(isEnd) break;
		}
		cYear = 1921 + m;
		cMonth = k-n+1;
		cDay = total;
		if(k == 12){
			if(cMonth == Math.floor(calendarData[m]/0x10000)+1){
				cMonth = 1-cMonth;
			}
			if(cMonth > Math.floor(calendarData[m]/0x10000)+1){
				cMonth--;
			}
		}
	}

	var _getcDateString = function (){
		var tmp = "";
		if(cDay == 1){
			if(cMonth < 1){
				tmp += "闰";
				tmp += monString.charAt(-cMonth-1)
			}else{
				tmp += monString.charAt(cMonth-1);
			}
			 tmp+="月";
		}else{
			// tmp += monString.charAt(-cMonth-1);
			tmp += (cDay == 20) ? "二十" : ((cDay < 11) ? "初" : ((cDay < 20) ? "十" : ((cDay < 30) ? "廿" : "三十")));
			if (cDay%10 != 0||cDay == 10){
				tmp += numString.charAt((cDay-1)%10);
			}
		}
		return tmp;
	}
	var _getLunarDay = function (data){
		var d = data.split('-');
		var solarYear = d[0];
		var solarMonth = d[1];
		var solarDay = d[2];
		if (solarYear < 100) solarYear = "19" + solarYear;
		if(solarYear < 1921 || solarYear > 2020){
			return "";
		}else{
			solarMonth = (parseInt(solarMonth) > 0) ? (solarMonth - 1) : 11;
			_e2c(solarYear,solarMonth,solarDay);
			return _getcDateString();
		}
	}
	_init();
}