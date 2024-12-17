$(document).ready(function() {				
	$(".select2").select2();

  $('#validate_orgnization').validate({
    rules: {
      name_org: {
        required: true,  
        minlength: 5, 
        remote: {
          url: hostname +"common/ajax_check_exists_organization/",
          type: "post",
          data: {
            orgname: function() {
              return $( "#org_name_id").val();
            }
          }
        }         
      }
    },

    messages: {
      name_org: {
        required: "প্রতিষ্ঠানের নাম প্রদান করুন",      
        minlength: jQuery.format("সর্বনিন্ম {0} টি অক্ষর প্রদান করুন"),      
        remote: jQuery.format("এই প্রতিষ্ঠানের নাম আগে প্রদান করা হয়েছে")
      }
    },

    highlight: function(element) {
      $(element).closest('.form-group').addClass('has-error');
    },

    unhighlight: function(element) {
      $(element).closest('.form-group').removeClass('has-error');
    },

    errorPlacement: function(error, element) {
      if (element.parent('.input-group').length) {
        error.insertAfter(element.parent());
      } else {
        error.insertAfter(element);
      }
    },

    success: function (label, element) {
      var parent = $(element).parent('.input-with-icon');
      parent.removeClass('error-control').addClass('success-control'); 
    },

    submitHandler: function (form) {
      // form.submit(); 
      // alert("Submitted!");
      // form validates so do the ajax
      $.ajax({
        type: 'POST',
        url: hostname + "common/organization",
        data: $(form).serialize(),
        success: function (data, status) {
          // ajax done
          // do whatever & close the modal
          // alert(data);
          // html(data);
          $('#response').append(data);
          $(this).modal('hide');
        }
      });
      return false; // ajax used, block the normal submit
    }
  });


  //Form Data Sheet Update
  $('#form_data_sheet_update_validate').validate({
    // focusInvalid: false, 
    ignore: "",
    rules: {
      name_bangla: {required: true},
      name_english: {required: true},
      father_name: { required: true },
      mother_name: { required: true },
      date_of_birth: { required: true, date: true },
      gender: { required: true },
      telephone_mobile: { required: true, minlength: 11, maxlength: 11 },
      email: {email: true },
      marital_status_id: { required: true },
      permanent_add: { required: true },
      per_div_id: { required: true },
      per_dis_id: { required: true },
      per_upa_id: { required: true },
      per_po: { required: true },
      data_sheet_type: { required: true },
      office_type_id: { required: true },
      division_id: { required: false },
      district_id: { required: false },
      upa_tha_id: { required: false },
      first_org_name: { required: true },
      first_org_id: { required: false },
      first_desig_name: { required: true },
      first_attend_date: { required: true },
      curr_org_id: { required: false },
      curr_org_name: { required: true },
      curr_desig_name: { required: true },
      curr_attend_date: { required: true }
    },

    invalidHandler: function (event, validator) {
      //display error alert on form submit    
    },

    errorPlacement: function (label, element) { // render error placement for each input type   
      $('<span class="error"></span>').insertAfter(element).append(label)
      var parent = $(element).parent('.input-with-icon');
      parent.removeClass('success-control').addClass('error-control');  
    },

    highlight: function (element) { // hightlight error inputs
      var parent = $(element).parent();
      parent.removeClass('success-control').addClass('error-control'); 
    },

    unhighlight: function (element) { // revert the change done by hightlight

    },

    success: function (label, element) {
      var parent = $(element).parent('.input-with-icon');
      parent.removeClass('error-control').addClass('success-control'); 
    },

    submitHandler: function (form) {
      form.submit(); 
    }
  });

  // Data Sheet Form Wizard Validations
  var $validator = $("#dataSheetForm").validate({
    rules: {        
      name_bangla: {required: true},
      name_english: {required: true},
      father_name: { required: true },
      mother_name: { required: true },
      date_of_birth: { required: true, date: true },
      gender: { required: true },
      telephone_mobile: { required: true, minlength: 11, maxlength: 11 },
      email: {email: true },
      marital_status_id: { required: true },
      permanent_add: { required: true },
      per_div_id: { required: true },
      per_dis_id: { required: true },
      per_upa_id: { required: true },
      per_po: { required: true },
      data_sheet_type: { required: true },
      office_type_id: { required: true },
      division_id: { required: false  },
      district_id: { required: false },
      upa_tha_id: { required: false },
      first_org_name: { required: true },
      first_org_id: { required: false },
      first_desig_name: { required: true },
      first_attend_date: { required: true },
      curr_org_name: { required: true },
      curr_org_id: { required: false },
      curr_desig_name: { required: true },
      curr_attend_date: { required: true },
      national_id: {
        required: true,  
        minlength: 10, 
        remote: {
          url: hostname +"personal_datas/ajax_get_nid/",
          type: "post",
          data: {
            nid: function() {
              return $( "#national_id" ).val();
            }
          }
        }         
      }
    },

    messages: {
      national_id: {
        required: "ন্যাশনাল আইডি প্রদান করুন",      
        minlength: jQuery.format("সর্বনিন্ম {0} টি সংখ্যা প্রদান করুন"),      
        remote: jQuery.format("এই ন্যাশনাল আইডি আগে প্রদান করা হয়েছে")
      }
    },

    errorPlacement: function(label, element) {
      $('<span class="arrow"></span>').insertBefore(element);
      $('<span class="error"></span>').insertAfter(element).append(label)
    }
  });

	//Traditional form validation sample
	$('#form_traditional_validation').validate({
    focusInvalid: false, 
    ignore: "",
    rules: {
      form1Amount: {
        minlength: 2,
        required: true
      },
      form1CardHolderName: {
        minlength: 2,
        required: true,
      },
      form1CardNumber: {
        required: true,
        creditcard: true
      }
    },

    invalidHandler: function (event, validator) {
		  //display error alert on form submit    
    },

    errorPlacement: function (label, element) { // render error placement for each input type   
      $('<span class="error"></span>').insertAfter(element).append(label)
      var parent = $(element).parent('.input-with-icon');
      parent.removeClass('success-control').addClass('error-control');  
    },

    highlight: function (element) { // hightlight error inputs
      var parent = $(element).parent();
      parent.removeClass('success-control').addClass('error-control'); 
    },

    unhighlight: function (element) { // revert the change done by hightlight

    },

    success: function (label, element) {
      var parent = $(element).parent('.input-with-icon');
      parent.removeClass('error-control').addClass('success-control'); 
    },

    submitHandler: function (form) {

    }
  });	
	
	//Iconic form validation sample	
  $('#form_iconic_validation').validate({
    errorElement: 'span', 
    errorClass: 'error', 
    focusInvalid: false, 
    ignore: "",
    rules: {
      form1Name: {
        minlength: 2,
        required: true
      },
      form1Email: {
        required: true,
        email: true
      },
      form1Url: {
        required: true,
        url: true
      }
    },

    invalidHandler: function (event, validator) {
		  //display error alert on form submit    
    },

    errorPlacement: function (error, element) { // render error placement for each input type
      var icon = $(element).parent('.input-with-icon').children('i');
      var parent = $(element).parent('.input-with-icon');
      icon.removeClass('fa fa-check').addClass('fa fa-exclamation');  
      parent.removeClass('success-control').addClass('error-control');  
    },

    highlight: function (element) { // hightlight error inputs
      var parent = $(element).parent();
      parent.removeClass('success-control').addClass('error-control'); 
    },

    unhighlight: function (element) { // revert the change done by hightlight

    },

    success: function (label, element) {
      var icon = $(element).parent('.input-with-icon').children('i');
      var parent = $(element).parent('.input-with-icon');
      icon.removeClass("fa fa-exclamation").addClass('fa fa-check');
      parent.removeClass('error-control').addClass('success-control'); 
    },

    submitHandler: function (form) {

    }
  });
	//Form Condensed Validation
	$('#form-condensed').validate({
    errorElement: 'span', 
    errorClass: 'error', 
    focusInvalid: false, 
    ignore: "",
    rules: {
      form3FirstName: {
        minlength: 3,
        required: true
      },
      form3LastName: {
        minlength: 3,
        required: true
      },
      form3Gender: {
        required: true,
      },
      form3DateOfBirth: {
        required: true,
      },
      form3Occupation: {
        minlength: 3,
        required: true,
      },
      form3Email: {
        required: true,
        email: true
      },
      form3Address: {
        minlength: 10,
        required: true,
      },
      form3City: {
        minlength: 5,
        required: true,
      },
      form3State: {
        minlength: 3,
        required: true,
      },
      form3Country: {
        minlength: 3,
        required: true,
      },
      form3PostalCode: {
        number: true,
        maxlength: 4,
        required: true,
      },
      form3TeleCode: {
        minlength: 3,
        maxlength: 4,
        required: true,
      },
      form3TeleNo: {
        maxlength: 10,
        required: true,
      },
    },

    invalidHandler: function (event, validator) {
		  //display error alert on form submit    
    },

    errorPlacement: function (label, element) { // render error placement for each input type   
      $('<span class="error"></span>').insertAfter(element).append(label)
    },

    highlight: function (element) { // hightlight error inputs

    },

    unhighlight: function (element) { // revert the change done by hightlight

    },

    success: function (label, element) {

    },

    submitHandler: function (form) {

    }
  });	

  //wizard form
  $( "#previous_button" ).click(function() {
    $('#save_button').hide();
    $('#next_button').show();
  });

  $( ".step" ).click(function() {
    $('#save_button').hide();
    $('#next_button').show();
  });

  $('#rootwizard').bootstrapWizard({
    'tabClass': 'form-wizard',
    'onNext': function(tab, navigation, index) {
      var $valid = $("#dataSheetForm").valid();
      if(!$valid) {
        $validator.focusInvalid();
        return false;
      } else{
        $('#rootwizard').find('.form-wizard').children('li').eq(index-1).addClass('complete');
        $('#rootwizard').find('.form-wizard').children('li').eq(index-1).find('.step').html('<i class="fa fa-check"></i>'); 

        if(index==2){
          $('#save_button').show();
          $('#next_button').hide(); 
        } else {
          $('#save_button').hide();
          $('#next_button').show(); 
        }
      }
    }
  });


  $('#validate_personal').validate({
    rules: {
      name_bn: { required: true, minlength: 5 },
      name_en: { required: true, minlength: 5 },
      father_name: { required: true, minlength: 5 }
    },
    

    // messages: {
    //   name_bn: {
    //     required: "প্রতিষ্ঠানের নাম প্রদান করুন",      
    //     minlength: jQuery.format("সর্বনিন্ম {0} টি অক্ষর প্রদান করুন")
    //   }
    // },

    highlight: function(element) {
      $(element).closest('.form-group').addClass('has-error');
    },

    unhighlight: function(element) {
      $(element).closest('.form-group').removeClass('has-error');
    },

    errorPlacement: function(error, element) {
      if (element.parent('.input-group').length) {
        error.insertAfter(element.parent());
      } else {
        error.insertAfter(element);
      }
    },

    success: function (label, element) {
      var parent = $(element).parent('.input-with-icon');
      parent.removeClass('error-control').addClass('success-control'); 
    },

    submitHandler: function (form) {
      // form.submit(); 
      // alert("Submitted!");
      // form validates so do the ajax
      /*$.ajax({
        type: 'POST',
        url: hostname + "common/organization",
        data: $(form).serialize(),
        success: function (data, status) {
          // ajax done
          // do whatever & close the modal
          // alert(data);
          // html(data);
          $('#response').append(data);
          $(this).modal('hide');
        }
      });*/
      // return false; // ajax used, block the normal submit
    }
  });


});	
