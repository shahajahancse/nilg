
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<style>
   .chosen-single {
    height: 30px !important;
    border: 1px solid #00a59a !important;
}
</style>

<div class="page-content">
    <div class="content">
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard')?>" class="active" > Dashboard </a></li>
            <li><a href="<?=base_url('budget/budget_nilg_create')?>" class="active"><?=$module_name?></a></li>
            <li><?=$meta_title; ?></li>

        </ul>

        <style type="text/css">
        /*#appointment, #invitation { display: none; }*/
        </style>

        <div class="row">
            <div class="col-md-12">
                <div class="grid simple horizontal red">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                        <div class="pull-right">
                            <a href="<?=base_url('journal_entry/revenue_entry')?>"
                                class="btn btn-blueviolet btn-xs btn-mini">রাজস্ব তালিকা</a>
                        </div>
                    </div>
                    <div class="grid-body">
                        <?php if($this->session->flashdata('success')):?>
                        <div class="alert alert-success">
                            <?=$this->session->flashdata('success');;?>
                        </div>
                        <?php endif; ?>  <?php if($this->session->flashdata('error')):?>
                        <div class="alert alert-danger">
                            <?=$this->session->flashdata('error');;?>
                        </div>
                        <?php endif; ?>

                        <?php
                            $attributes = array('id' => 'jsvalidate');
                            echo form_open_multipart("journal_entry/revenue_entry_create",$attributes);
                            echo validation_errors();
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset style="background: #fff !important;">
                                    <legend>রাজস্ব তথ্য</legend>
                                    <div class="row form-row" style="font-size: 16px; color: black; margin-top: -20px !important;">
                                        <br>
                                        <div class="col-md-3">
                                            <label for="title" class="control-label">ভাউচার নাঃ </label>
                                            <input type="text"  value="<?php echo 'JR'.date('Ymdhis'); ?>" class="form-control input-sm" name="voucher_no"
                                                style="min-height: 33px;"  required readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="title" class="control-label">রেফারেন্স:</label>
                                            <input type="text"  value="" class="form-control input-sm" name="reference"
                                                style="min-height: 33px;">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="title" class="control-label">তারিখ:</label>
                                            <input type="date"  value="" class="form-control input-sm" name="issue_date"
                                                style="min-height: 33px;" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="title" class="control-label"> পরিমান:</label>
                                            <input type="number"  value="" class="form-control input-sm" name="amount"
                                                style="min-height: 33px;" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="title" class="control-label">বর্ণনা:</label>
                                            <textarea name="description" id="" style="width: 100%; height: 85px;"></textarea>
                                        </div>

                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="pull-right">
                                <input type="submit" name="submit" id="submit_btn" value="সংরক্ষণ করুন" class="btn btn-primary btn-cons">
                            </div>
                        </div>
                        <?php echo form_close();?>
                    </div> <!-- END GRID BODY -->
                </div> <!-- END GRID -->
            </div>
        </div> <!-- END ROW -->
    </div>
</div>

<script>

function removeRow(id) {
    $(id).closest("tr").remove();
    calculateTotal()
    $("#total_amount").trigger('change');

}
</script>

<script>
   function addNewRow(id) {
       var head_id = id;

       if (head_id == "") {
         return false;
       }

       $("#loading").show();
       $.ajax({
           type: "POST",
           url: "<?=base_url('budgets/add_new_row') ?>",
           data: {
               head_id: head_id
           },
           success: function(data) {
            var data=JSON.parse(data);
            var tr=`<tr>
                        <td style="padding:0px 10px">${data.name_bn}</td>
                        <td style="padding:0px 10px">${data.bd_code}</td>
                        <td style="padding:0px 10px">
                        <input type="hidden" name="head_id[]" value="${data.budget_head_id}" >
                        <input type="hidden" name="head_sub_id[]" value="${data.id}" >
                        <input value="0" min="0" type="number" onkeyup="calculateTotal()" name="amount[]" class="form-control amount input-sm">
                        </td>
                        <td style="padding:0px 10px"><a href="javascript:void(0)" onclick="removeRow(this)" class="btn btn-danger btn-sm" style="padding: 3px;"><i class="fa fa-times"></i> Remove</a></td>
                     </tr>`
            $("#tbody").append(tr);
            $("#loading").hide();
           }
       })

   }
</script>
<script>

   function calculateTotal() {
       var total = 0;
       $(".amount").each(function() {
           total += parseInt($(this).val());
       })
       $("#total_amount").val(total);
       $("#total_amount").trigger('change');
   }
</script>
<script>
      $(document).ready(function() {
         calculateTotal()

      })
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<script>
  $(document).ready(function(){
   $('#fcl_year').chosen();
   $('#head_id').chosen();
   $('#quarter').chosen();
   $('#type').chosen();
  });
</script>


<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .then(editor => {
            window.editor = editor;
        })
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    $("#total_amount").change(function(){
        var total_amount = parseFloat($("#total_amount").val()) || 0;
        var rest_amount = $("#rest_amount");
        var budget_amount = parseFloat($("#budget_amount").val()) || 0;
        rest_amount.val(budget_amount - total_amount);
        if (rest_amount.val()!=0){
            $("#submit_btn").prop('disabled', true);
        } else {
            $("#submit_btn").prop('disabled', false);
        }
    })
    $('#budget_amount').keyup(function(){
        $("#total_amount").trigger('change');
    })
</script>
