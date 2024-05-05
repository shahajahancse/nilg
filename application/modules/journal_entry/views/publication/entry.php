
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
                            <a href="<?=base_url('journal_entry/publication_entry')?>"
                                class="btn btn-blueviolet btn-xs btn-mini">পাবলিকেশন তালিকা</a>
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

                        <div class="row">
                            <div style="text-align: center; margin: center; margin-bottom: 20px; margin-top: -7px;">
                                <h3 style="text-decoration: underline;line-height: 32px;">পাবলিকেশন এন্ট্রি ফর্ম</h3>
                            </div>
                        </div>

                        <?php $attributes = array('id' => 'jsvalidate');
                            echo form_open_multipart("journal_entry/publication_entry_create",$attributes);
                            echo validation_errors(); ?>

                            <div class="row form-row" style="font-size: 16px; color: black; margin-top: -20px !important;">
                                <br>
                                <div class="col-md-3">
                                    <label for="title" class="control-label">ভাউচার নং </label>
                                    <input type="text"  value="<?php echo 'JR'.date('Ymdhis'); ?>" class="form-control input-sm" name="voucher_no"
                                        style="min-height: 33px;"  required readonly>
                                </div>

                                <div class="col-md-4">
                                    <label for="title" class="control-label">রেফারেন্স:</label>
                                    <input type="text"  value="" class="form-control input-sm" name="reference"
                                        style="min-height: 33px;">
                                </div>

                                <div class="col-md-2">
                                    <label for="title" class="control-label">তারিখ: <span class="required">*</span></label>
                                    <input type="date"  value="" class="form-control input-sm" name="issue_date"
                                        style="min-height: 33px;" required>
                                </div>

                                <div class="col-md-2">
                                    <label for="title" class="control-label"> ধরণ: <span class="required">*</span></label>
                                    <select name="type" id="" class="form-control input-sm" required>
                                        <option value=""> Select Type</option>
                                        <option value=1>Cash Deposit</option>
                                        <option value=2>Payment Voucher</option>
                                        <option value="3">Adjustment Voucher</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row" style="font-size: 16px; color: black; margin-top: -20px !important;">
                                <br>

                                <table width="100%" border="1" style="border:1px solid #a09e9e; margin-top: 10px;" id="appRowDiv">
                                    <thead>
                                        <tr>
                                            <th style="padding:3px 5px" width="30%"> বই নাম</th>
                                            <th style="padding:3px 5px" width="20%"> এসবিএন নং</th>
                                            <th style="padding:3px 5px" width="13%"> বইয়ের মূল্য</th>
                                            <th style="padding:3px 5px" width="12%"> পরিমান </th>
                                            <th style="padding:3px 5px" width="15%"> মোট মূল্য </th>
                                            <th style="padding:3px 5px" width="10%"> অ্যাকশন </th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                    <tr>
                                        <td style="padding: 3px 3px 0px;">
                                            <input name="book_name[]" class="form-control amount input-sm">
                                        </td>
                                        <td style="padding: 3px 3px 0px;">
                                            <input name="sbn_no[]" class="form-control amount input-sm">
                                        </td>

                                        <td style="padding: 3px 3px 0px;">
                                            <input value="0" min="0" type="number" onkeyup="calculateTotal()" name="price[]" class="form-control price input-sm">
                                        </td>
                                        <td style="padding: 3px 3px 0px;">
                                            <input value="0" min="0" type="number" onkeyup="calculateTotal()" name="quantity[]" class="form-control quantity input-sm">
                                        </td>
                                        <td style="padding: 3px 3px 0px;">
                                            <input value="0" min="0" type="number" onkeyup="calculateTotal()" name="amount[]" class="form-control amount input-sm" readonly>
                                        </td>
                                        <td style="padding: 0px 10px;">
                                            <a href="javascript:void(0)" onclick="removeRow(this)" class="btn btn-danger btn-sm" style="padding: 3px;"><i class="fa fa-times"></i> Remove</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row form-row" style="font-size: 16px; color: black; margin-top: -20px !important;">
                                <br>
                                <div class="col-md-12">
                                    <label for="title" class="control-label">বর্ণনা:</label>
                                    <textarea class="form-control input-sm" name="description" ></textarea>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <div class="pull-right">
                                        <input type="submit" name="submit" id="submit_btn" value="সংরক্ষণ করুন" class="btn btn-primary btn-cons">
                                    </div>
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
        // calculateTotal()
    }
</script>

<script>
   function calculateTotal() {
       var total = 0;
       $(".amount").each(function() {
           total += parseInt($(this).val());
       })
       $("#total_amount").val(total);
   }
</script>
<script>
      $(document).ready(function() {
        calculateTotal()
      })
</script>

<script>
    function cal_book_amt() {
        var price = $('#price').val();
        var quantity = $('#quantity').val();
        var amount = price * quantity;
        $('#amount').val(amount);
    }
</script>
