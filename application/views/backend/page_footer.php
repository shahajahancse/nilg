</div>
<!-- END CONTAINER -->

<!-- BEGIN CORE JS FRAMEWORK-->

<script src="<?=base_url();?>awedget/assets/plugins/breakpoints.js" type="text/javascript"></script>
<script src="<?=base_url();?>awedget/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>awedget/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
<!-- END CORE JS FRAMEWORK -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="<?=base_url();?>awedget/assets/plugins/jquery-slider/jquery.sidr.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>awedget/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript">
</script>
<script src="<?=base_url();?>awedget/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js"
    type="text/javascript"></script>
<script src="<?=base_url();?>awedget/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>awedget/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"
    type="text/javascript"></script>
<script src="<?=base_url();?>awedget/assets/plugins/jquery-inputmask/jquery.inputmask.min.js" type="text/javascript">
</script>
<script src="<?=base_url();?>awedget/assets/plugins/jquery-autonumeric/autoNumeric.js" type="text/javascript"></script>
<script src="<?=base_url();?>awedget/assets/plugins/ios-switch/ios7-switch.js" type="text/javascript"></script>
<!-- <script src="<?=base_url();?>awedget/assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script> -->
<script src="<?=base_url();?>awedget/assets/plugins/boostrap-form-wizard/js/jquery.bootstrap.wizard.min.js"
    type="text/javascript"></script>
<script src="<?=base_url();?>awedget/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript">
</script>
<script src="<?=base_url();?>awedget/assets/plugins/jquery-validation/js/messages_bn_BD.js" type="text/javascript">
</script>

<?php /*
<!-- BEGIN PAGE DATATABLE -->   
<script src="<?=base_url();?>awedget/assets/plugins/jquery-datatable/js/jquery.dataTables.min.js"
type="text/javascript" ></script>
<script src="<?=base_url();?>awedget/assets/plugins/jquery-datatable/extra/js/TableTools.min.js" type="text/javascript">
</script>
<script src="<?=base_url();?>awedget/assets/plugins/datatables-responsive/js/datatables.responsive.js"
    type="text/javascript"></script>
<script src="<?=base_url();?>awedget/assets/plugins/datatables-responsive/js/lodash.min.js" type="text/javascript">
</script>
*/ ?>
<!-- END PAGE LEVEL PLUGINS -->
<?php /*<script src="<?=base_url();?>awedget/assets/js/datatables.js" type="text/javascript"></script>*/ ?>
<script src="<?=base_url()?>awedget/assets/js/tabs_accordian.js" type="text/javascript"></script>
<script src="<?=base_url()?>awedget/assets/plugins/fullcalendar/fullcalendar.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<?php if($this->router->fetch_class('my_calendar') == 'my_calendar'){ ?>
<!-- PAGE JS -->
<script src="<?=base_url()?>awedget/assets/js/calender.js" type="text/javascript"></script>
<?php } ?>

<?php if($this->router->fetch_class('my_message') == 'my_message'){ ?>
<!-- END PAGE LEVEL PLUGINS -->
<script src="<?=base_url()?>awedget/assets/js/email_comman.js" type="text/javascript"></script>
<?php } ?>
<script src="<?=base_url()?>awedget/assets/js/messages_notifications.js" type="text/javascript"></script>
<!-- BEGIN CORE TEMPLATE JS -->

<?php if($this->router->fetch_class('dashboard') == 'dashboard'){ ?>
<script src="<?= base_url('assets/js/raphael-min.js'); ?>"></script>
<!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> -->
<script src="<?=base_url();?>awedget/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>awedget/assets/plugins/jquery-slider/jquery.sidr.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>awedget/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js"
    type="text/javascript"></script>
<script src="<?=base_url();?>awedget/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript">
</script>
<script src="<?=base_url();?>awedget/assets/plugins/jquery-ricksaw-chart/js/d3.v2.js"></script>
<script src="<?=base_url();?>awedget/assets/plugins/jquery-ricksaw-chart/js/rickshaw.min.js"></script>
<script src="<?=base_url();?>awedget/assets/plugins/jquery-morris-chart/js/morris.min.js"></script>
<script src="<?=base_url();?>awedget/assets/plugins/jquery-easy-pie-chart/js/jquery.easypiechart.min.js"></script>
<script src="<?=base_url();?>awedget/assets/plugins/jquery-flot/jquery.flot.js"></script>
<script src="<?=base_url();?>awedget/assets/plugins/jquery-flot/jquery.flot.time.min.js"></script>
<script src="<?=base_url();?>awedget/assets/plugins/jquery-flot/jquery.flot.selection.min.js"></script>
<script src="<?=base_url();?>awedget/assets/plugins/jquery-flot/jquery.flot.animator.min.js"></script>
<!--<script src="<?=base_url();?>awedget/assets/plugins/jquery-flot/jquery.flot.orderBars.js"></script>-->
<script src="<?=base_url();?>awedget/assets/plugins/jquery-sparkline/jquery-sparkline.js"></script>
<script src="<?=base_url();?>awedget/assets/plugins/jquery-easy-pie-chart/js/jquery.easypiechart.min.js"></script>
<!-- /BEGIN CORE TEMPLATE JS -->
<?php /*?><script src="<?=base_url();?>awedget/assets/js/charts.js" type="text/javascript"></script><?php */?>
<?php } ?>

<?php /*
<!-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
*/ ?>
<!-- <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="//cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script> -->
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> -->
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> -->
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> -->
<!-- <script src="//cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script> -->
<!-- <script src="//cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script> -->
<script src="<?= base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/dataTables.buttons.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/jszip.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/pdfmake.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/vfs_fonts.js'); ?>"></script>
<script src="<?= base_url('assets/js/buttons.html5.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/buttons.print.min.js'); ?>"></script>


<!-- END PAGE LEVEL PLUGINS -->
<script src="<?=base_url();?>awedget/assets/js/bangla-input.js" type="text/javascript"></script>
<script type="text/javascript">
var hostname = '<?php echo base_url();?>';
</script>
<script src="<?=base_url();?>awedget/assets/js/core.js" type="text/javascript"></script>
<?php /*?>
<!--<script src="<?=base_url();?>awedget/assets/js/chat.js" type="text/javascript"></script>--><?php */?>

<script src="<?=base_url();?>awedget/assets/js/demo.js" type="text/javascript"></script>
<script src="<?=base_url();?>awedget/assets/js/custom.js" type="text/javascript"></script>
<script src="<?=base_url();?>awedget/assets/js/form_validations.js" type="text/javascript"></script>
<script src="<?=base_url();?>awedget/assets/js/custom_validations.js" type="text/javascript"></script>

<!-- Latest Sortable -->
<!-- <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script> -->
<script src="<?= base_url('assets/js/Sortable.js'); ?>"></script>
<script src="<?=base_url();?>awedget/assets/js/jquery.buttonLoader.js" type="text/javascript"></script>

<!-- END CORE TEMPLATE JS -->
<!-- <script src="<?=base_url();?>awedget/assets/js/dashboard_v2.js" type="text/javascript"></script> -->
<!-- <script type="text/javascript">
  $(document).ready(function () {
      $(".live-tile,.flip-list").liveTile();
  });
</script> -->

<script type="text/javascript">
    
$(document).ready(function() {
    // select2Organization();    
    select2NationalID();
    select2Coordinator();
    select2Trainee();
    select2Trainer();
    datetime();
    timepicker();
    organization_suggestions();
    designation_suggestions();
    nilg_course_suggestions();
    local_course_suggestions();
    other_course_suggestions();
    foreign_course_suggestions();

    select2Office();
    select2Union();
    select2Course();
    select2Designation();
    select2DesignationPR();
    select2DesignationEmployee();
    select2NIDTrainee();
    select2NIDTrainer();


    // First organization 
    // $(".first_org_sugg").autocomplete("<?php echo site_url('common/suggest_first_organization');?>",{max:100,minChars:0,delay:10});
    // $(".first_org_sugg").result(function(event, data, formatted){});
    // $(".first_org_sugg").search();

    // Current organization 
    // $(".curr_org_sugg").autocomplete("<?php echo site_url('common/suggest_curr_organization');?>",{max:100,minChars:0,delay:10});
    // $(".curr_org_sugg").result(function(event, data, formatted){});
    // $(".curr_org_sugg").search();

    // Post Office
    $("#po_sugg").autocomplete("<?php echo site_url('common/suggest_post_office');?>", {
        max: 100,
        minChars: 0,
        delay: 10
    });
    $("#po_sugg").result(function(event, data, formatted) {});
    $("#po_sugg").search();

    //National ID
    $(".nid_sugg").autocomplete("<?php echo site_url('common/suggest_nid');?>", {
        max: 100,
        minChars: 0,
        delay: 10
    });
    $(".nid_sugg").result(function(event, data, formatted) {});
    $(".nid_sugg").search();


    $('.dateyear').datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        autoclose: true
    });

    // Datatable
    $('#example').DataTable({
        paging: false,
        bFilter: false,
        ordering: false,
        searching: false,
        // dom: 't',         // This shows just the table
        dom: 'Bfrtip',
        buttons: [
            // 'copy', 'csv', 'excel', 'print', 'pdf',      
            'excel',
            /*{ 
              extend: 'print',          
              text: 'Print/PDF',
              customize: function(win) {
                $(win.document.body)
                            .css( 'font-size', '100pt' )
              }
              
            },*/
            /*{
              extend: 'alert',
              text: 'My button 1'
            }*/
            /*{
              extend: 'pdf',
              customize: function(doc) {
                  doc.defaultStyle.font = "nikosh";
              }
            }*/
        ]
    });
    // $('.data_table').DataTable({
    //     paging: false,
    //     bFilter: false,
    //     ordering: false,
    //     searching: true,
    //     dom: 'Bfrtip',
    //     buttons: [
    //          'excel','pdf'
    //     ],
    //     "sDom": 'T<"clear"><"search"f>lfrtip',
    //     initComplete: function () {
    //         var r = this.api().columns().header();
    //         $(r).find('input').addClass('form-control input-sm');
    //     }
    // });




});
        

function confirmSubmit() {
    return confirm('আপনি কি নিশ্চিত? সবগুলো ফিল্ড সঠিকভাবে পূরণ করেছেন?');
}

function confirmAnswerSubmit() {
    return confirm('আপনি কি সবগুলো প্রশ্নের উত্তর প্রদান করেছেন?');
}

// Custome Button Datatable
$.fn.dataTable.ext.buttons.alert = {
    className: 'buttons-alert',

    action: function(e, dt, node, config) {
        alert(this.text());
    }
};

// Bangla Fornt for Datatable PDF
function processDoc(doc) {
    // https://pdfmake.github.io/docs/fonts/custom-fonts-client-side/
    //
    // Update pdfmake's global font list, using the fonts available in
    // the customized vfs_fonts.js file (do NOT remove the Roboto default):
    pdfMake.fonts = {
        Roboto: {
            normal: 'Roboto-Regular.ttf',
            bold: 'Roboto-Medium.ttf',
            italics: 'Roboto-Italic.ttf',
            bolditalics: 'Roboto-MediumItalic.ttf'
        },
        nikosh: {
            normal: "NikoshBAN.ttf",
            bold: "NikoshBAN.ttf",
            italics: "NikoshBAN.ttf",
            bolditalics: "NikoshBAN.ttf"
        }
    };
    // modify the PDF to use a different default font:
    doc.defaultStyle.font = "nikosh";
    var i = 1;
}




//datetime funcitons
function datetime() {
    $('.datetime').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    });
}

function timepicker() {
    $('.timepicker').datetimepicker({
        format: 'LT'
    });
}

// Promotion Organization Suggestions
function promotion_organization_suggestions() {
    $(".promo_org_sugg").autocomplete("<?php echo site_url('common/suggest_promotion_organization');?>", {
        max: 100,
        minChars: 0,
        delay: 10
    });
    $(".promo_org_sugg").result(function(event, data, formatted) {});
    $(".promo_org_sugg").search();
}

// Promotion Designation suggestions
function promotion_designation_suggestions() {
    $(".promo_desig_sugg").autocomplete("<?php echo site_url('common/suggest_promotion_designation');?>", {
        max: 100,
        minChars: 0,
        delay: 10
    });
    $(".promo_desig_sugg").result(function(event, data, formatted) {});
    $(".promo_desig_sugg").search();
}

// Organization suggestions
function organization_suggestions() {
    $(".org_sugg").autocomplete("<?php echo site_url('common/suggest_organization');?>", {
        max: 100,
        minChars: 0,
        delay: 10
    });
    $(".org_sugg").result(function(event, data, formatted) {});
    $(".org_sugg").search();
}

// Designation suggestions
function designation_suggestions() {
    $(".desig_sugg").autocomplete("<?php echo site_url('common/suggest_designation');?>", {
        max: 100,
        minChars: 0,
        delay: 10
    });
    $(".desig_sugg").result(function(event, data, formatted) {});
    $(".desig_sugg").search();
}

// NILG Training
function nilg_course_suggestions() {
    $(".nilg_course_sugg").autocomplete("<?php echo site_url('common/suggest_nilg_course');?>", {
        max: 100,
        minChars: 0,
        delay: 10
    });
    $(".nilg_course_sugg").result(function(event, data, formatted) {});
    $(".nilg_course_sugg").search();
}

// Local Training
function local_course_suggestions() {
    $(".local_course_sugg").autocomplete("<?php echo site_url('common/suggest_local_course');?>", {
        max: 100,
        minChars: 0,
        delay: 10
    });
    $(".local_course_sugg").result(function(event, data, formatted) {});
    $(".local_course_sugg").search();
}

// Other Course suggestion from `local_course_name` field of `per_local_org_training` table
function other_course_suggestions() {
    $(".other_course_sugg").autocomplete("<?php echo site_url('common/suggest_other_course');?>", {
        max: 100,
        minChars: 0,
        delay: 10
    });
    $(".other_course_sugg").result(function(event, data, formatted) {});
    $(".other_course_sugg").search();
}

// Foreign Course suggestion from `foreign_course_name` field of `per_foreign_org_training` table
function foreign_course_suggestions() {
    $(".foreign_course_sugg").autocomplete("<?php echo site_url('common/suggest_foreign_course');?>", {
        max: 100,
        minChars: 0,
        delay: 10
    });
    $(".foreign_course_sugg").result(function(event, data, formatted) {});
    $(".foreign_course_sugg").search();
}


// Select2 AJAX autocomplete for National ID and Name
function select2NationalID() {
    $('.nationalIDselect2').select2({
        placeholder: '-- ন্যাশনাল আইডি নির্বাচন করুন --',
        ajax: {
            url: '<?php echo base_url()?>common/select2_natioanl_id_name',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
}

// Select2 AJAX autocomplete for Organization
function select2Coordinator() {
    $('.coordinatorSelect2').select2({
        placeholder: '-- অনুসন্ধান করুন --',
        ajax: {
            url: '<?php echo base_url()?>common/select2_coordinator',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
}

// Select2 AJAX autocomplete for Organization
function select2Organization() {
    $('.organizationSelect2').select2({
        placeholder: '-- প্রতিষ্ঠানের নাম অনুসন্ধান করুন --',
        ajax: {
            url: '<?php echo base_url()?>common/select2_organization_name',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
}

// Select2 AJAX autocomplete for Organization
function select2Trainee() {
    $('.traineeSelect2').select2({
        placeholder: '-- প্রশিক্ষক নির্বাচন করুন --',
        ajax: {
            url: '<?php echo base_url()?>common/select2_trainee',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
}



// Select2 AJAX autocomplete for Office
function select2Office() {
    $('.officeSelect2').select2({
        placeholder: '-- অফিস অনুসন্ধান করুন --',
        ajax: {
            url: '<?php echo base_url()?>common/select2_office',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
}

// Select2 AJAX autocomplete for Union
function select2Union() {
    $('.unionSelect2').select2({
        placeholder: '-- ইউনিয়ন অনুসন্ধান করুন --',
        ajax: {
            url: '<?php echo base_url()?>common/select2_union',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
}

// Select2 AJAX autocomplete for Course
function select2Course() {
    $('.courseSelect2').select2({
        placeholder: '-- কোর্স অনুসন্ধান করুন --',
        ajax: {
            url: '<?php echo base_url()?>common/select2_course',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
}

// Select2 AJAX autocomplete for Designation
function select2Designation() {
    $('.designationSelect2').select2({
        placeholder: '-- পদবি অনুসন্ধান করুন --',
        ajax: {
            url: '<?php echo base_url()?>common/select2_designation',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
}

// Select2 AJAX autocomplete for Course
function select2DesignationPR() {
    $('.prDesignationSelect2').select2({
        placeholder: '-- জনপ্রতিনিধির পদবি অনুসন্ধান করুন --',
        ajax: {
            url: '<?php echo base_url()?>common/select2_designation_pr',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
}

// Select2 AJAX autocomplete for Course
function select2DesignationEmployee() {
    $('.empDesignationSelect2').select2({
        placeholder: '-- কর্মচারী পদবি অনুসন্ধান করুন --',
        ajax: {
            url: '<?php echo base_url()?>common/select2_designation_employee',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
}

// Select2 AJAX autocomplete for National ID, Name BN, Mobile No from Users table
function select2NIDTrainee() {
    $('.NIDTraineeselect2').select2({
        placeholder: '-- ন্যাশনাল আইডি নির্বাচন করুন --',
        ajax: {
            url: '<?php echo base_url()?>common/select2_nid_trainee_verified',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
}

function select2Trainer() {
    $('.trainerSelect2').select2({
        placeholder: '-- প্রশিক্ষক নির্বাচন করুন --',
        ajax: {
            url: '<?php echo base_url()?>common/select2_trainer',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
}

// NIDTrainerselect2
function select2NIDTrainer() {
    $('.trainerSelect2').select2({
        placeholder: '-- প্রশিক্ষক নির্বাচন করুন --',
        ajax: {
            url: '<?php echo base_url()?>common/select2_nid_trainer_verified',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
}





function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}
</script>

<?php if($this->router->fetch_class('evaluation') == 'evaluation'){ ?>
<script type="text/javascript">
// Evaluation Module (Create Question)
Sortable.create(list, {
    group: 'shared',
    animation: 100
});

Sortable.create(list2, {
    group: 'shared',
    animation: 100,
    emptyInsertThreshold: 0 // emptyInsertThreshold disabled
});
</script>
<?php } ?>

<script>
// Date range filter
minDateFilter = "";
maxDateFilter = "";

$.fn.dataTableExt.afnFiltering.push(
  function(oSettings, aData, iDataIndex) {
    console.log(oSettings, aData, iDataIndex);

    if (typeof aData._date == 'undefined') {
      aData._date = new Date(aData[3]).getTime();
    }
    if (isNaN(minDateFilter)) {
        minDateFilter = 0;
    }

    if (isNaN(maxDateFilter)) {
        maxDateFilter = new Date().getTime();
    }

    if (minDateFilter && !isNaN(minDateFilter)) {
      if (aData._date < minDateFilter) {
        return false;
      }
    }

    if (maxDateFilter && !isNaN(maxDateFilter)) {
      if (aData._date > maxDateFilter) {
        return false;
      }
    }
    console.log(minDateFilter, maxDateFilter);

    return true;
  }
);
var table = $('.data_table').DataTable({
    paging: false,
    info: false,
});

// Event listener to the two range filtering inputs to redraw on input
function filterDate() {
    console.log('enter');
    minDateFilter = new Date($('#min').val()).getTime();
    maxDateFilter =  new Date($('#max').val()).getTime();
    table.draw();
};

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php if(isset($dashboard_sorcart) && $dashboard_sorcart==1){ ?>
<script>

$(document).ready(function() {
    Swal.fire({
    title: "<strong>Shortcut</strong>",
    html: `
    <div style="display: flex;justify-content: center;align-items: center;gap: 7px;flex-wrap: wrap;">
    <a class="btn btn-primary" style="font-size: large;font-family: fantasy;" href="<?=base_url('my_profile') ?>">মাই প্রোফাইল</a>
    <?php if ($this->ion_auth->in_group(array('admin', 'bdg', 'acc'))) { ?>
    <a class="btn btn-primary" style="font-size: large;font-family: fantasy;" href="<?=base_url('budgets/budget_nilg') ?>">বাজেট তৈরি করুন</a>
    <?php } ?>
    <?php if ($this->ion_auth->in_group(array('admin', 'nilg', 'uz', 'ddlg'))) { ?>
    <a class="btn btn-primary" style="font-size: large;font-family: fantasy;" href="<?=base_url('training/create')?>">কোর্স তৈরি করুন</a>
    <?php } ?>
    </div>
    `,
    showCloseButton: true,
    focusConfirm: false,
    showConfirmButton: false,
    showCancelButton: true,
    });
});

</script>
<?php } ?>
</body>

</html>