$(document).ready(function() {
  $(".select2").select2();

  // Jquery Validation with Modal and Ajax Submit
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

  // Jquery custome validate
  $.validator.addMethod("nidlength", function(value, element) {
    var nid = $('#nid').val().length;
    if(nid == 10 || nid == 13 || nid == 17){
     return true;
   }
      // return nid == 10 || nid == 13 || nid == 17;
      // return value.indexOf(" ") < 0 && value != "";
    }, "শুধুমাত্র ১০, ১৩ অথবা ১৭ সংখ্যা প্রযোজ্য");

  // Trainee Public Representative Validations
  var $validator = $("#trainee_validation_wizard").validate({
    rules: {
      name_bn: { required: true },
      name_en: { required: true },
      father_name: { required: true },
      mother_name: { required: true },
      dob: { required: true, date: true },
      // image: { required: true },
      gender: { required: true },
      mobile_no: { required: true, minlength: 11, maxlength: 11 },
      email: { required: false, email: true },
      ms_id: { required: true },
      per_div_id: { required: true },
      per_dis_id: { required: true },
      per_upa_id: { required: true },
      per_road_no: { required: true },
      permanent_add: { required: true },
      per_po: { required: true },
      per_pc: { required: true },
      present_add: { required: true },
      crrnt_office_id: { required: true },
      crrnt_desig_id: { required: true },
      crrnt_elected_year: { required: true },
      crrnt_attend_date: { required: true },
      first_office_id: { required: false },
      first_desig_id: { required: false },
      first_elected_year: { required: false },
      first_attend_date: { required: false },
      elected_times: { required: true },
      curr_attend_date: { required: true },
      nid: {
        required: true,
        digits: true,
        nidlength: true,
        minlength: 10,
        maxlength: 17,
        remote: {
          url: hostname + "common/ajax_exists_nid/",
          type: "post",
          data: {
            national_id: function () {
              return $("#nid").val();
            },
          },
        },
      },
      password: { required: true, minlength: 8 },
    },

    messages: {
      nid: {
        required: "ন্যাশনাল আইডি প্রদান করুন",
        minlength: jQuery.format("সর্বনিন্ম {0} টি সংখ্যা প্রদান করুন"),
        remote: jQuery.format("এই ন্যাশনাল আইডি আগে প্রদান করা হয়েছে"),
      },
    },

    errorPlacement: function (label, element) {
      // render error placement for each input type

      if (element.attr("name") ==  ("crrnt_office_id" || "crrnt_elected_year")) {
        label.insertAfter("#errorplace");
      } else {
        // $('<span class="error"></span>').insertAfter(element).append(label)
        // $('<span class="error"></span>').insertAfter(element).append(label)
        // var parent = $(element).parent('.input-with-icon');
        // parent.removeClass('success-control').addClass('error-control');

        $('<span class="arrow"></span>').insertBefore(element);
        $('<span class="error"></span>').insertAfter(element).append(label);
      }
    },
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

  $('#rootprwizard').bootstrapWizard({
    'tabClass': 'form-wizard',
    'onNext': function(tab, navigation, index) {
      var $valid = $("#trainee_validation_wizard").valid();
      if(!$valid) {
        $validator.focusInvalid();
        return false;
      } else {
        $('#rootprwizard').find('.form-wizard').children('li').eq(index-1).addClass('complete');
        $('#rootprwizard').find('.form-wizard').children('li').eq(index-1).find('.step').html('<i class="fa fa-check"></i>');

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

});



