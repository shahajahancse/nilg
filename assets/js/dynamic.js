/*!
 * Ext JS Library 3.3.1
 * Copyright(c) 2006-2010 Sencha Inc.
 * licensing@sencha.com
 * http://www.sencha.com/license
 */

// Sample desktop configuration


//Browser Support Code

var eempid=null;
var personalinfo = new Array();
// hostname = window.location.href; 
// base_url = hostname.substring(0, (hostname.indexOf("index.php") == -1)?hostname.length:hostname.indexOf("index.php"));



function all_request_list(){
var ajaxRequest;  // The variable that makes Ajax possible!
	
 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
hostname = window.location.hostname;
url =  "http://www.nilglibrary.com/index.php/setup_con/all_request_list/";

search_report = window.open(url,'all_request_list',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
search_report.moveTo(0,0);
}

function req_issued(i){
	var ajaxRequest;  // The variable that makes Ajax possible!
	
 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
 var mem_id = "mem_id"+i;
 var call_no = "call_no"+i;
 var acc_no = "acc_no"+i;
 
var mem_id 	= document.getElementById(mem_id).value;
 var call_no 	= document.getElementById(call_no).value;
 var acc_no 	= document.getElementById(acc_no).value;
// alert(acc_no);
 //alert(call_no);
 //alert(mem_id);
// return;

  var queryString="mem_id="+mem_id+"&call_no="+call_no+"&acc_no="+acc_no;

  hostname = window.location.hostname;
 url =  "http://www.nilglibrary.com/index.php/setup_con/req_issued/";
 
 ajaxRequest.open("POST",url, true);
 ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 ajaxRequest.send(queryString);
 
 
ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
		var resp = ajaxRequest.responseText;
		alert(resp);
		
			
	}
}
	
	
}

function req_issued1(i){
	var ajaxRequest;  // The variable that makes Ajax possible!
	
 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
 //var mem_id = "mem_id"+i;
 var group_no = "group_no"+i;
 var acc_no = "acc_no"+i;
 
 var mem_id 	= document.getElementById('mem_id').value;
 var group_no 	= document.getElementById(group_no).value;
 var acc_no 	= document.getElementById(acc_no).value;
//alert(mem_id);

  var queryString="mem_id="+mem_id+"&group_no="+group_no+"&acc_no="+acc_no;

  hostname = window.location.hostname;
 url =  "http://www.nilglibrary.com/index.php/setup_con/req_issued/";
 
 ajaxRequest.open("POST",url, true);
 ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 ajaxRequest.send(queryString);
 
 
ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
		var resp = ajaxRequest.responseText;
		alert(resp);
		
			
	}
}
	
	
}

function req_cancel(i){
	var ajaxRequest;  // The variable that makes Ajax possible!
	
 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
 var mem_id = "mem_id"+i;
 var group_no = "group_no"+i;
 var acc_no = "acc_no"+i;
 
 var mem_id 	= document.getElementById(mem_id).value;
 var group_no 	= document.getElementById(group_no).value;
 var acc_no 	= document.getElementById(acc_no).value;
//alert(mem_id);

  var queryString="mem_id="+mem_id+"&group_no="+group_no+"&acc_no="+acc_no;

  hostname = window.location.hostname;
 url =  "http://www.nilglibrary.com/index.php/setup_con/req_cancel/";
 
 ajaxRequest.open("POST",url, true);
 ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 ajaxRequest.send(queryString);
 
 
ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
		var resp = ajaxRequest.responseText;
		alert(resp);
		
			
	}
}
	
	
}
function req_cancel1(i){
	var ajaxRequest;  // The variable that makes Ajax possible!
	
 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
 //var mem_id = "mem_id"+i;
 var group_no = "group_no"+i;
 var acc_no = "acc_no"+i;
 
 var mem_id 	= document.getElementById('mem_id').value;
 var group_no 	= document.getElementById(group_no).value;
 var acc_no 	= document.getElementById(acc_no).value;
//alert(mem_id);

  var queryString="mem_id="+mem_id+"&group_no="+group_no+"&acc_no="+acc_no;

  hostname = window.location.hostname;
 url =  "http://www.nilglibrary.com/index.php/setup_con/req_cancel/";
 
 ajaxRequest.open("POST",url, true);
 ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 ajaxRequest.send(queryString);
 
 
ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
		var resp = ajaxRequest.responseText;
		alert(resp);
		
			
	}
}
	
	
}



function for_booking(){
	var ajaxRequest;  // The variable that makes Ajax possible!
		
	try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
	}catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
	}
	
	var answer = confirm("Are You Sure To Booking?")
	if (answer == false){
		return false;
	}
		
	var table 	= document.getElementById('table').value;
	var group_no 	= document.getElementById('group_no').value;
	var queryString="group_no="+group_no+"&table="+table;
	var url = hostname + "library/search_con/for_booking/";
 
 	ajaxRequest.open("POST",url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);
 
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var resp = ajaxRequest.responseText;
			alert('suceessfully Booking');
		}
	}
}


function book_insert_view(){
var ajaxRequest;  // The variable that makes Ajax possible!
	
 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
 


//alert('hello');
 
 var queryString="book_id="+book_id;
  hostname = window.location.hostname;
 //url =  "http://"+hostname+"/ad_library/index.php/search_con/for_booking/";
 
 ajaxRequest.open("POST",url, true);
 ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 ajaxRequest.send(queryString);
 
 
ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
		var resp = ajaxRequest.responseText;
		alert(resp);
		
			
	}
}
}


function barcode_generator()
{
	hostname = window.location.href; 
	base_url = hostname.substring(0, (hostname.indexOf("index.php") == -1)?hostname.length:hostname.indexOf("index.php"));

var ajaxRequest;  // The variable that makes Ajax possible!
	
 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
	  //var radioValue 	= document.getElementById('radioValue').value;
	  var acc_first = document.getElementById('acc_first').value;
	  var acc_last 		= document.getElementById('acc_last').value;
		
		for (index=0; index < document.barcode_form.radioValue.length; index++) {
			if (document.barcode_form.radioValue[index].checked) {
			var radioValue = document.barcode_form.radioValue[index].value;
			break;
			}
		}
		//alert(radioValue);
	
	
		if(radioValue == null)
		{
			alert("Choose One Radio Button");
			return
		// alert("radioValue null");
		}
		if(acc_first == "")
		{
		  alert("Enter Acc. No. First..");
		  return;
		}
		
		if(acc_last == "")
		{
		  alert("Enter Acc. No. Last..");
		  return;
		}
		
		if (isNaN(acc_first))
		{
		  alert("Accession First is always number");
		  return;
		}
		
		if (isNaN(acc_last))
		{
		  alert("Accession Last is always number");
		  return;
		}
	
		var queryString="acc_first="+acc_first+"&acc_last="+acc_last+"&radioValue="+radioValue;
		url =  base_url+"index.php/setup_con/barcode_generator/";
	
	ajaxRequest.open("POST",url, true);
	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxRequest.send(queryString);
	ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
		var resp = ajaxRequest.responseText;
			//alert(resp);
		if(resp == "not exist")	
		{
		 	alert('Invalid Accession No');
			return;
		}
		
		alldata = resp.split("***");
		acc_no = alldata[0];
		//alert(acc_no);
		rows = alldata[1];
		//alert(resp);
	url =  base_url+"barcode/html/code39.php?id="+acc_no+"&rows="+rows;
	barcode_gen = window.open(url,'barcode_gen',"menubar=1,resizable=1,scrollbars=1,width=1500,height=800");
	barcode_gen.moveTo(0,0);
		
			
		}}
	
}



function searchs()
{
 var ajaxRequest;  // The variable that makes Ajax possible!
	
 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
      }
   }
 }
	var search_key 	= document.getElementById('search_key').value;
	var radioButtons = document.getElementsByName("radioValue");
	  for (var x = 0; x < radioButtons.length; x ++) 
	  {
		if (radioButtons[x].checked) 
		{
			 radio = radioButtons[x].id;
		}
	  }
	  //alert(search_key);
	   hostname = window.location.hostname;
	url =  "http://"+hostname+"/ad_library/index.php/search_con_all/search_book_all/";
	var queryString="search_key="+search_key+"&radio="+radio;  
	ajaxRequest.open("POST",url, true);
	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxRequest.send(queryString);
	
	
	ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4)
	{
		if(ajaxRequest.readyState == 4)
			{
				var resp=ajaxRequest.responseText ;
				//alert(resp);
				document.getElementById('searchresult').innerHTML = resp;
			}
	}
}
	
	
	
	
}
