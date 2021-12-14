$.fn.serializeObject = function(){

	var self = this,
		json = {},
		push_counters = {},
		patterns = {
			"validate": /^[a-zA-Z][a-zA-Z0-9_]*(?:\[(?:\d*|[a-zA-Z0-9_]+)\])*$/,
			"key":      /[a-zA-Z0-9_]+|(?=\[\])/g,
			"push":     /^$/,
			"fixed":    /^\d+$/,
			"named":    /^[a-zA-Z0-9_]+$/
		};


	this.build = function(base, key, value){
		base[key] = value;
		return base;
	};

	this.push_counter = function(key){
		if(push_counters[key] === undefined){
			push_counters[key] = 0;
		}
		return push_counters[key]++;
	};

	$.each($(this).serializeArray(), function(){

		// Skip invalid keys
		if(!patterns.validate.test(this.name)){
			return;
		}

		var k,
			keys = this.name.match(patterns.key),
			merge = this.value,
			reverse_key = this.name;

		while((k = keys.pop()) !== undefined){

			// Adjust reverse_key
			reverse_key = reverse_key.replace(new RegExp("\\[" + k + "\\]$"), '');

			// Push
			if(k.match(patterns.push)){
				merge = self.build([], self.push_counter(reverse_key), merge);
			}

			// Fixed
			else if(k.match(patterns.fixed)){
				merge = self.build([], k, merge);
			}

			// Named
			else if(k.match(patterns.named)){
				merge = self.build({}, k, merge);
			}
		}

		json = $.extend(true, json, merge);
	});

	return json;
};

class Funct_main {
	constructor() {
		this.datenow = new Date().toISOString().slice(0, 10);
		this.notifyDangerBox(false,false,true);
	}

	notifyDangerBox(t,msg,load=false,timeout=1500){
		if(msg===0){
			let root = t.next(".root-notifybox");
			if(root.length>0){
				root.hide('slow', function(){ 
					t.removeClass("input-notifybox");
					$(this).remove(); 
				});
			}
			return false;
		}
		if(!load){
			let root = t.next(".root-notifybox");
			if(root.length>0){
				root.remove();
			}

			t.addClass("input-notifybox");
			$.when(t.after(`
				<div class="root-notifybox">
					<i class="fa fa-caret-up caretup-notifybox"></i>
					<i class="fa fa-exclamation-circle icon-notifybox"></i>
					<div class="parent-notifybox">
						${msg}
					</div>
					<i class="fa fa-close close-notifybox"></i>
				</div>
			`)).done(function(){
				$(".close-notifybox").off('click');
				$(".close-notifybox").on('click',function(){
					$(this).parents(".root-notifybox").hide('slow', function(){ 
						t.removeClass("input-notifybox");
						$(this).remove(); 
					});
				});
				if(!timeout){
					return false;
				}
				setTimeout(() => {
					root = t.next(".root-notifybox");
					root.hide('slow', function(){ 
						t.removeClass("input-notifybox");
						$(this).remove(); 
					});
				}, timeout);
			});
		}else{
			let style_notify = $("#style_notify");
			let style =`
				<style>
					.input-notifybox{
						border: 1px solid #fbc02d !important;
						color: #fbc02d !important;
					}
					.root-notifybox{
						display:flex;
						align-items: center;
						z-index: 1000;
						position: relative;
						margin-top: 5px;
						background: rgb(11, 9, 9);
						border-radius: 3px;
					}
					.parent-notifybox{
						width:100%;
						padding-top:5px;
						padding-bottom:5px; 
						padding-left:5px;
						padding-right:5px; 
						text-align:left;
						color:#fbc02d;
						z-index: 2;
						position: relative;
					}
					.caretup-notifybox{
						position: absolute;
						top: -10.2px;
						color: rgb(11, 9, 9);
						z-index: 1;
						margin-left: 7px;
					}
					.icon-notifybox{
						color: #fbc02d;
						z-index: 3;
						margin-left: 8px;
						margin-top: -2px;
					}
					.close-notifybox{
						color: #fbc02d;
						z-index: 3;
						margin-right: 8px;
						margin-top: -2px;
						cursor: pointer;
					}
				</style>
			`;
			if(style_notify.length>0){
				style_notify.html(style);
			}else{
				$('body').append(`
					<div id="style_notify"></div>
				`);
				style_notify = $("#style_notify");
				style_notify.html(style);
			}
		}
	}

	loading(call='timer', callback=false, t_delay=1000){
		if(call==='timer'){
			$.when($("#preloader").fadeIn(500).delay(t_delay).fadeOut(500))
			.done(function(){
				if(callback){
					callback();
				}
			});
		}
		else if(call===true){
			$.when($("#preloader").fadeIn(500))
			.done(function(){
				if(callback){
					callback();
				}
			});
		}
		else if(call===false){
			$.when($("#preloader").fadeOut(500))
			.done(function(){
				if(callback){
					callback();
				}
			});
		}
		return;
	}

	ssStorage(sg="get", name='', val=""){
		if(sg === "get"){
			var id = sessionStorage.getItem(name);
			return id;
		}
		if(sg === "set"){
			sessionStorage.setItem(name,val);
		}
		if(sg === "remove"){
			sessionStorage.removeItem(name);
		}
	}

	ssObjStorage(sg="get", name='', val=""){
		if(sg === "get"){
			var dt = sessionStorage.getObj(name);
			return dt;
		}
		if(sg === "set"){
			sessionStorage.setObj(name,val);
		}
		if(sg === "remove"){
			sessionStorage.removeItem(name);
		}
	}

	pushSsObjStorage(name,data)
	{
	    var new_data = [[]];
	    // Parse the serialized data back into an aray of objects
	    new_data = this.ssObjStorage("get", name);

	    // Push the new data (whether it be an object or anything else) onto the array
	    new_data.push(data);

	    // Re-serialize the array back into a string and store it in localStorage 
	    this.ssObjStorage("set", name, new_data);
	}

	dump(txt=''){
	    console.log(txt);
	}

	urlPlus(plusurl = '') {
	    // var url = window.location.origin + '/' + window.location.pathname.split ('/') [1] + '/';
	    var url = window.location.origin + '/';
	    return url+plusurl;
	}

	clearFieldFrm(ele){
	    $(ele).find("input, textarea, select").val("");
	}

	formatNumber(x,p=',') {
	    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, p);
	}

	mvLoc(loc){
	    window.location.href = loc;
	}

	dateTimeToDate(date){
	    return date.substr(0, date.length-9);
	}

	ucwords(str){ 
	    str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
	        return letter.toUpperCase();
	    });
	    return str;
	}
 
	alertArray(params){
	    alert(JSON.stringify(params, null, '    ')); 
	}

	toUrlBase64(url, callback) {
	    var xhr = new XMLHttpRequest();
	    xhr.onload = function() {
	        var reader = new FileReader();
	        reader.onloadend = function() {
	            callback(reader.result);
	        }
	        reader.readAsDataURL(xhr.response);
	    };
	    xhr.open('GET', url);
	    xhr.responseType = 'blob';
	    xhr.send();
	}

    arrDiff(a1, a2) {
        var a = [], diff = [];
    
        for (var i = 0; i < a1.length; i++) {
            a[a1[i]] = true;
        }
        for (var i = 0; i < a2.length; i++) {
            if (a[a2[i]]) {
                delete a[a2[i]];
            } else {
                a[a2[i]] = true;
            }
        }
        for (var k in a) {
            diff.push(k);
        }
    
        return diff;
    }
    arrayValues(input) {
        var tmp_arr = [], key = '';
    
        if (input && typeof input === 'object' && input.change_key_case) { // Duck-type check for our own array()-created PHPJS_Array
            return input.values();
        }
        for (key in input) {
            tmp_arr[tmp_arr.length] = input[key];
        }
    
        return tmp_arr;
    }
    replaceBulk( str, findArray, replaceArray ){
        var i, regex = [], map = {}; 
        for( i=0; i<findArray.length; i++ ){ 
            regex.push( findArray[i].replace(/([-[\]{}()*+?.\\^$|#,])/g,'\\$1') );
            map[findArray[i]] = replaceArray[i]; 
        }
        regex = regex.join('|');
        str = str.replace( new RegExp( regex, 'g' ), function(matched){
            return map[matched];
        });
        return str;
    }
    
    mvLoc(loc){
	    window.location.href = loc;
	}

 //    addSomeCharToString(string, index, add_string) {
	// 	if (index > 0) {
	// 		return string.substring(0, index) + add_string + string.substr(index);
	// 	}

	// 	return add_string + string;
	// }
	randomStrName(str) {
	   	return this.addRandomCharacters(str + Math.floor(Math.random()*1000001)) + '_funct';
	}

	objectifyForm(formArray) {
	    //serialize data function
	    var returnArray = {};
	    for (var i = 0; i < formArray.length; i++){
	        returnArray[formArray[i]['name']] = formArray[i]['value'];
	    }
	    return returnArray;
	}

	generateRandomString(length = 5) {
	   	var result = '';
	   	var characters = 'abcdefghijklMNOPQRSTUVWXYZ';
	   	var charactersLength = characters.length;
	   	for ( var i = 0; i < length; i++ ) {
	      	result += characters.charAt(Math.floor(Math.random() * charactersLength));
	   	}
	   	return result;
	}

    addRandomCharacters(str,length=2) {
	   	var result = '';
	   	var characters = '!#$%^&*()<>?/{}|][-=~';
	   	var characters_length = characters.length-1;
	   	var ar_str = str.split('');

	   	for (var i = 0; i < ar_str.length; i++) { 
	   		var rand = '';
		   	for ( var ii = 0; ii < length; ii++ ) {
		    	rand += characters.charAt(Math.floor(Math.random() * characters_length));
		   	}
	   		result += ar_str[i]+rand;
	   	}
	   	return result.substr(0, result.length-length);
	}

    xssClean(val,exclude=false)
	{

		let bad_val = ["'", "\"", "/", "^", "!", "|", "{", "}", "[", "]", "(", ")", "<", ">", "?", "#", "~", "`", "," ,"+", "-", "=", "$", "%", "*", "\\", "&", ";"];
		if(exclude !== false){
			bad_val = this.arrDiff(bad_val, exclude);
			bad_val = this.arrayValues(bad_val);
		}

		let replace = [];

		for (let i=0; i<bad_val.length; i++) { 
			replace[i] = "";
		}

		return this.replaceBulk(val, bad_val, replace);
	}

	isFunction(functionToCheck) {
		return functionToCheck && {}.toString.call(functionToCheck) === '[object Function]';
	}

	toFixedEdited(num, digits=2) {
		var re = new RegExp('^-?\\d+(?:\.\\d{0,' + (digits || -1) + '})?');
    	return num.toString().match(re)[0];
	}

	numberFormatAlias(num, digits=2) {
		var si = [
			{ value: 1, symbol: "" },
			{ value: 1E3, symbol: "k" },
			{ value: 1E6, symbol: "M" },
			{ value: 1E9, symbol: "G" },
			{ value: 1E12, symbol: "T" },
			{ value: 1E15, symbol: "P" },
			{ value: 1E18, symbol: "E" }
		];
		var rx = /\.0+$|(\.[0-9]*[1-9])0+$/;
		var i;
		for (i = si.length - 1; i > 0; i--) {
			if (num >= si[i].value) {
			  break;
			}
		}
		
		return this.toFixedEdited((num / si[i].value), digits).replace(rx, "$1") + si[i].symbol;
	}
	
	setInputFilter(textbox, inputFilter, callback=false, off_first_event=false) {
		const array_event = [
			"input", "keydown", "keyup", 
			"mousedown", "mouseup", "select", 
			"contextmenu", "drop"
		];
	
		if(off_first_event == true){
			array_event.forEach(function(event) {
				textbox.off(event);
			});
		}
	
		array_event.forEach(function(event) {
			textbox.on(event, function() {
				if (inputFilter(this.value)) {
					this.oldValue = this.value;
					this.oldSelectionStart = this.selectionStart;
					this.oldSelectionEnd = this.selectionEnd;
				} else if (this.hasOwnProperty("oldValue")) {
					this.value = this.oldValue;
					this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
					// handler when cannot to continue
					if(callback != false){
						callback(textbox);
					}
				} else {
					this.value = "";
				}
			});
		}); 
	}
 
	callAjax(fromdata,
        rel_url='',
        optional = {
	        type: "POST",
			method: "POST",
	        dataType: "JSON",
            tryCount : 0,
            retryLimit : 5,
			processData: true,
			contentType: true,
        },
        callback = {
            sc : function(e){

            },
            er : function(e){

            },   
        }
    ){ 
		var t_f_main = this;
	    $.ajax({
	        url: t_f_main.urlPlus() + rel_url,
	        type: optional.type,
	        method: optional.method,
			dataType: optional.dataType,  
			tryCount : optional.tryCount,
			retryLimit : optional.retryLimit,
			data: fromdata,

			processData: optional.processData,
			contentType: optional.contentType,

	        success:function(res){
	            callback.sc(res);
	        },
	        error:function(xhr, textStatus, errorThrown ){
	            if (textStatus == 'timeout') {
	                this.tryCount++;
	                if (this.tryCount <= this.retryLimit) {
	                    //try again
	                    $.ajax(this);
	                    return;
	                }else{
	                    return false;
	                }            
	                return;
	            }
	            if (xhr.status == 500) {
	                //handle error
					if(t_f_main.isFunction(callback.er)){
						callback.er(xhr);
					}
	                // console.log(xhr);
	            } 
				else if (xhr.status == 404){
					if(t_f_main.isFunction(callback.er)){
						callback.er(xhr);
					}
	                // console.log(xhr);
				}
				else {
	                //handle error
					if(t_f_main.isFunction(callback.er)){
						callback.er(xhr);
					}
	                // console.log(xhr);
	            } 
	        }
	    }); 
	    return true;   
	}

}