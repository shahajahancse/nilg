function confirmSubmit() {
  return confirm('আপনি কি নিশ্চিত? সবগুলো ফিল্ড সঠিকভাবে পূরণ করেছেন?');
}

$(document).ready(function() {
   $(".select2").select2();
   $(".district_val").append('<option value=""> --নির্বাচন করুন-- </option>');
   $(".upazila_val").append('<option value=""> --নির্বাচন করুন-- </option>');
   // $(".office_val").append('<option value=""> --নির্বাচন করুন-- </option>');
   // $(".designation_val").append('<option value=""> --নির্বাচন করুন-- </option>');
   // $(".office_val").append('<option value=""> --নির্বাচন করুন-- </option>');
   // $(".union_val").append('<option value=""> --নির্বাচন করুন-- </option>');  

   ///// JQuery Validataion Link //////
   // https://jqueryvalidation.org/files/demo/
   // https://jqueryvalidation.org/documentation/   
   // https://stackoverflow.com/questions/2901125/jquery-validate-required-select
   // https://stackoverflow.com/questions/14896854/jquery-select-box-validation

   // Jquery custome validate
   $.validator.addMethod("nidlength", function(value, element) { 
      var nid = $('#nid').val().length;
      if(nid == 10 || nid == 13 || nid == 17){
         return true;
      }
      // return nid == 10 || nid == 13 || nid == 17;
      // return value.indexOf(" ") < 0 && value != ""; 
   }, "শুধুমাত্র ১০, ১৩ অথবা ১৭ সংখ্যা প্রযোজ্য");

   // Validate User Registration
   $('#user-registration').validate({
      focusInvalid: false, 
      ignore: "",
      rules: {
         name: { required: true },
         nid: {
            required: true, digits: true, nidlength: true, minlength: 10, maxlength: 17,
            remote: {
               url: hostname +"common/ajax_exists_nid/",
               type: "post",
               data: {
                  national_id: function() {
                     return $( "#nid" ).val();
                  }
               }
            }  
         },
         dob: { required: true },
         mobile_no: { 
            required: true, digits:true, minlength: 11, maxlength: 11,
            remote: {
               url: hostname +"common/ajax_exists_mobile/",
               type: "post",
               data: {
                  mobile_number: function() {
                     return $( "#mobile_no" ).val();
                  }
               }
            }
         },
         email: { 
            email: true
            /*remote: {
               url: hostname +"common/ajax_exists_email/",
               type: "post",
               data: {
                  email_address: function() {
                     return $( "#email" ).val();
                  }
               }
            }*/
         },
         password: { required: true, minlength: 8},
         password_confirm: { required: true, equalTo: "#password"},
         office_type: { required: true },
         division: { 
            required: function(element) {     
               var officeType = $('#office_type').val();          
               // console.log(officeType); 
               if ((officeType != 6 && officeType != 7 && officeType != 9 && officeType != 10)){
                  return true;
               }else{
                  return false;               
               }
            }
         },
         district: { 
            required: function(element) {     
               var officeType = $('#office_type').val();          
               // console.log(officeType); 
               if ((officeType != 4 && officeType != 5 && officeType != 6 && officeType != 7 && officeType != 8 && officeType != 9 && officeType != 10)){
                  return true;
               }else{
                  return false;               
               }
            }
         },
         upazila: {
            required: function(element) {     
               var officeType = $('#office_type').val();          
               // console.log(officeType); 
               if ((officeType != 4 && officeType != 5 && officeType != 6 && officeType != 7 && officeType != 8 && officeType != 9 && officeType != 10)){
                  return true;
               }else{
                  return false;               
               }
            }
         },
         office: { required: true },
         designation: { required: true }
      },

      messages: {
         name: { required: "বাংলায় সম্পর্ণ নাম লিখুন" },
         dob: { required: "জন্ম তালিখ প্রদান করুন" },
         nid: {
            required: "ন্যাশনাল আইডি প্রদান করুন", 
            digits: "নম্বর ইংরেজিতে টাইপ করুন",     
            minlength: jQuery.format("সর্বনিন্ম {0} টি সংখ্যা প্রদান করুন"),      
            remote: jQuery.format("এই ন্যাশনাল আইডি আগে প্রদান করা হয়েছে")
         },
         mobile_no: {
            required: "মোবাইল নম্বর প্রদান করুন", 
            digits: "মোবাইল নম্বর ইংরেজিতে টাইপ করুন",
            minlength: "সর্বনিন্ম ১১ টি সংখ্যা দিন", 
            maxlength: "সর্বোচ্চ  ১১ টি সংখ্যা দিন",
            remote: jQuery.format("এই মোবাইল নম্বর আগে ব্যাবহার করা হয়েছে")
         },         
         email: {
            email: "ইমেইল ঠিকানা সঠিকভাবে লিখুন"
         },
         password: { 
            required: "পাসওয়ার্ড প্রদান করুন",
            minlength: "সর্বনিন্ম ৮ টি অক্ষর লিখুন"
         },
         password_confirm: { 
            required: "পাসওয়ার্ড পূণঃরাই প্রদান করুন", 
            equalTo: "পূণঃরাই সঠিক পাসওয়ার্ড প্রদান করুন"
         },
         office_type: { required: "অফিসের ধরণ নির্বাচন করুন" },
         division: { required: "বিভাগ নির্বাচন করুন" },
         district: { required: "জেলা নির্বাচন করুন" },
         upazila: { required: "উপজেলা নির্বাচন করুন" },
         office: { required: "বর্তমান অফিস নির্বাচন করুন" },
         designation: { required: "বর্তমান পদবি  নির্বাচন করুন" }
      },

      invalidHandler: function (event, validator) {
         //display error alert on form submit    
      },

      errorPlacement: function (label, element) { // render error placement for each input type  
         $('<span class="error" style="position: absolute; top:38px;"></span>').insertAfter(element).append(label)
         // $('<span class="error"></span>').insertAfter(element).append(label)
         var parent = $(element).parent('.input-with-icon');
         parent.removeClass('success-control').addClass('error-control');         
      },

      highlight: function (element) { // hightlight error inputs

      },

      unhighlight: function (element) { // revert the change done by hightlight

      },

      success: function (label, element) {
         var parent = $(element).parent('.input-with-icon');
         parent.removeClass('error-control').addClass('success-control'); 
      },

      submitHandler: function(form) {
         form.submit();
      }
   });   




   // Validate User Registration
   $('#course-applicaiton').validate({
      focusInvalid: false, 
      ignore: "",
      rules: {
         nid: { required: true, digits: true, nidlength: true, minlength: 10, maxlength: 17 },
         dob: { required: true },         
         pin: { required: true }
      },

      messages: {
         nid: {
            required: "ন্যাশনাল আইডি প্রদান করুন",      
            minlength: jQuery.format("সর্বনিন্ম {0} টি সংখ্যা প্রদান করুন"),      
         },
         pin: {
            remote: jQuery.format("এই ইমেইল অ্যাড্রেসটি আগে ব্যাবহার করা হয়েছে")
         }
      },

      invalidHandler: function (event, validator) {
         //display error alert on form submit    
      },

      errorPlacement: function (label, element) { // render error placement for each input type  
         $('<span class="error" style="position: absolute; top:38px;"></span>').insertAfter(element).append(label)
         // $('<span class="error"></span>').insertAfter(element).append(label)
         var parent = $(element).parent('.input-with-icon');
         parent.removeClass('success-control').addClass('error-control');         
      },

      highlight: function (element) { // hightlight error inputs

      },

      unhighlight: function (element) { // revert the change done by hightlight

      },

      success: function (label, element) {
         var parent = $(element).parent('.input-with-icon');
         parent.removeClass('error-control').addClass('success-control'); 
      },

      submitHandler: function(form) {
         form.submit();
      }
   });   


});


// Baseed of Office Type Change Office List and Designation List
$('#office_type').change(function(){
   var officeType = $('#office_type').val();   
   var division = $('#division').val();
   var district = $('#district').val();
   var upazila = $('#upazila').val();   
      alert(officeType); return;

   // Reset Select
   // $("#division > option").remove();
   // $("#division").append('<option value=""> --নির্বাচন করুন-- </option>');
   $(".district_val > option").remove();
   $(".district_val").append('<option value=""> --নির্বাচন করুন-- </option>');
   $(".upazila_val > option").remove();
   $(".upazila_val").append('<option value=""> --নির্বাচন করুন-- </option>');
   $(".office_val > option").remove();
   $(".office_val").append('<option value=""> --নির্বাচন করুন-- </option>');
   $(".designation_val > option").remove();
   // $(".union_val > option").remove();
   // $(".union_val").append('<option value=""> --নির্বাচন করুন-- </option>');
   $(".designation_val").append('<option value=""> --নির্বাচন করুন-- </option>');
   
   // Hide Element   
   $(".divDivision").hide(); 
   $(".divDistrict").hide();
   $(".divUpazila").hide();   
   // $(".divUnion").hide();   
   // alert(id);

   // Office Type by Condition
   // Union Parishad
   if(officeType == 1){
      $(".divDivision").show();
      $(".divDistrict").show();
      $(".divUpazila").show();   
      // $(".divUnion").show();       

      // Designation List
      designation_list_dd(officeType);

   }else if(officeType == 3){
      // Upazila Parishad      
      $(".divDivision").show();
      $(".divDistrict").show();
      // $(".divUpazila").show();

      // Designation List
      designation_list_dd(officeType);

   }else if(officeType == 2){
      // Paurasava
      $(".divDivision").show();
      $(".divDistrict").show();
      // $(".divUpazila").show();

      // Designation List
      designation_list_dd(officeType);

   }else if(officeType == 4){
      // Zila Parishad
      $(".divDivision").show();
      // $(".divDistrict").show();

      // Designation List
      designation_list_dd(officeType);

   }else if(officeType == 5){
      // City Corporation
      $(".divDivision").show();

      // Designation List
      designation_list_dd(officeType);

   }else if(officeType == 6){
      // Development Partnar
      $(".divDivision").hide();

      // Office List
      office_list_dd(officeType);  
      // Designation List
      designation_list_dd(officeType);
      
   }else if(officeType == 7){
      // NILG HQ
      $(".divDivision").hide();

      // Office List
      office_list_dd(officeType);  
      // Designation List
      designation_list_dd(officeType);

   }else if(officeType == 8){
      // DDLG Office
      $(".divDivision").show();

      // Office List
      office_list_dd(officeType);  
      // Designation List
      designation_list_dd(officeType);

   }else if(officeType == 9){
      // Ministry & Division
      $(".divDivision").hide();

      // Office List
      office_list_dd(officeType);  
      // Designation List
      designation_list_dd(officeType);

   }else if(officeType == 10){
      // Directorates and Others
      $(".divDivision").hide();

      // Office List
      office_list_dd(officeType);  
      // Designation List
      designation_list_dd(officeType);

   }else if(officeType == 11){
      // Division Commission
      $(".divDivision").hide();
      
      // Office List
      office_list_dd(officeType);  
      // Designation List
      designation_list_dd(officeType);

   }

});

   ////////************ Custom Function   **********/////////

   // District List
   $('#division').change(function(){
      $('.district_val').addClass('');
      $(".district_val > option").remove();
      $(".office_val > option").remove();
      var id = $('#division').val();

      $.ajax({
         type: "POST",
         url: hostname +"common/ajax_district_by_div/" + id,
         success: function(func_data)
         {
            $.each(func_data,function(id,name)
            {
               var opt = $('<option />');
               opt.val(id);
               opt.text(name);
               $('.district_val').append(opt);
            });
         }
      });
      
      // Office List
      var officeType = $('#office_type').val();
      var division = $('#division').val();
      // Reset Select
      $(".office_val > option").remove();
      $(".office_val").append('<option value=""> --নির্বাচন করুন-- </option>');

      // alert(officeType);
      if(officeType != '' && division != ''){
         office_list_dd(officeType, division);   
      }

   });

   // Upazila List
   $('#district').change(function(){
      $('.upazila_val').addClass('');
      $(".upazila_val > option").remove();
      $(".office_val > option").remove();
      var dis_id = $('#district').val();

      $.ajax({
         type: "POST",
         url: hostname +"common/ajax_upazila_by_dis/" + dis_id,
         success: function(upazilaThanas)
         {
            $.each(upazilaThanas,function(id,ut_name)
            {
               var opt = $('<option />');
               opt.val(id);
               opt.text(ut_name);
               $('.upazila_val').append(opt);
            });
         }
      });

      // Office List
      var officeType = $('#office_type').val();
      var division = $('#division').val();
      var district = $('#district').val();
      // alert(officeType);      
      if(officeType != '' && division != '' && district != ''){
         office_list_dd(officeType, division, district);   
      }

   });

   // Union List
   $('#upazila').change(function(){
      $('.union_val').addClass('');
      $(".union_val > option").remove();
      $(".office_val > option").remove();
      var upa_id = $('#upazila').val();
      
      $.ajax({
         type: "POST",
         url: hostname +"common/ajax_union_by_upa/" + upa_id,
         success: function(unions)
         {
            $.each(unions,function(id,name)
            {
               var opt = $('<option />');
               opt.val(id);
               opt.text(name);
               $('.union_val').append(opt);
            });
         }
      });

      // Office List
      var officeType = $('#office_type').val();
      var division = $('#division').val();
      var district = $('#district').val();
      // alert(officeType);
      if(officeType != '' && division != '' && division != '' && upa_id != ''){
         office_list_dd(officeType, division, district, upa_id);   
      }

      // Designation List
      /*
      if(officeType != ''){
         designation_list_dd(officeType);         
      }
      */

   });

   // Office List by Office Type ID
   function office_list_dd(officeType, division='null', district='null', upazila='null'){
      var division = (typeof division !== 'undefined') ?  division : '';
      var district = (typeof district !== 'undefined') ?  district : '';
      var upazila = (typeof upazila !== 'undefined') ?  upazila : '';

      var url_custom = hostname + "common/ajax_office_filter/" + officeType;

      if(officeType == 1){
         url_custom = hostname + "common/ajax_office_filter/" + officeType + '/' + division + '/' + district + '/' + upazila;
      }else if(officeType == 2 || officeType == 3){
         url_custom = hostname + "common/ajax_office_filter/" + officeType + '/' + division + '/' + district;
      }else if(officeType == 4){
         url_custom = hostname + "common/ajax_office_filter/" + officeType + '/' + division;
      }else if(officeType == 5){
         url_custom = hostname + "common/ajax_office_filter/" + officeType + '/' + division;
      }else if(officeType == 8){
         url_custom = hostname + "common/ajax_office_filter/" + officeType + '/' + division;
      }else{
         url_custom = hostname + "common/ajax_office_filter/" + officeType;
      }

      $.ajax({
         type: "POST",
         url: url_custom,
         success: function(func_data)
         {
            $.each(func_data,function(id, name)
            {
               var opt = $('<option />');
               opt.val(id);
               opt.text(name);
               $('.office_val').append(opt);
            });
         }
      });
   }

   // Designation List by Office Type ID
   function designation_list_dd(officeType){
      $.ajax({
         type: "POST",
         url: hostname +"common/ajax_designation_filter/" + officeType,
         success: function(func_data)
         {
            $.each(func_data,function(id, name)
            {
               var opt = $('<option />');
               opt.val(id);
               opt.text(name);
               $('.designation_val').append(opt);
            });
         }
      });
   }   

   // Datepicker
   $('.datepicker').datepicker({
      format: "dd-mm-yyyy",
      autoclose: true
   });

   // Login Validation
   $('#login-form').validate({

      focusInvalid: false, 
      ignore: "",
      rules: {
         identity: { required: true },
         password: { required: true }
      },

      messages: {
         identity: {
            required: "এনআইডি / ইউজারনেম প্রদান করুন"
         },
         password: {
            required: "পাসওয়ার্ড প্রদান করুন"
         }
      },

      invalidHandler: function (event, validator) {
         //display error alert on form submit    
      },

      errorPlacement: function (label, element) { // render error placement for each input type   
         $('<span class="error" style="position: absolute; top:38px;"></span>').insertAfter(element).append(label)
         var parent = $(element).parent('.input-with-icon');
         parent.removeClass('success-control').addClass('error-control');  
      },

      highlight: function (element) { // hightlight error inputs
      },

      unhighlight: function (element) { // revert the change done by hightlight

      },

      success: function (label, element) {
         var parent = $(element).parent('.input-with-icon');
         parent.removeClass('error-control').addClass('success-control'); 
      },
      submitHandler: function(form) {
         form.submit();
      }
   });


