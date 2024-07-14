
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
                                <?php 
                                if ($type == 1) {
                                   echo "<span>বই এন্ট্রি ফর্ম</span>";
                                }elseif ($type == 2) {
                                   echo "<span>বই বিক্রয় ফর্ম</span>";
                                }elseif ($type == 3) {
                                   echo "<span>কেজিতে বিক্রি ফর্ম</span>";
                                }
                                
                                ?>
                            </div>
                        </div>

                        <?php $attributes = array('id' => 'jsvalidate');
                            echo form_open_multipart(current_url(), $attributes);
                            echo validation_errors(); ?>
                            <input type="hidden" name="type" value="<?php echo $type; ?>">
                            <div class="row form-row" style="font-size: 16px; color: black; margin-top: -10px !important;">
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

                               <!-- type 1=book entry, 2=book out, 3=sell by kg -->
                               
                            </div>

                            <div class="form-row" style="font-size: 16px; color: black; margin-top: -20px !important;">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <?php $book = $this->db->get('budget_j_publication_book')->result(); ?>
                                        <select id="book_id" class="form-control input-sm" onchange="getBook(this.value)">
                                            <option value="">বই নির্বাচন করুন</option>
                                            <?php
                                            foreach ($book as $key => $value) {
                                                ?>
                                                <option value="<?=$key?>"><?=$value->name_bn?></option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <table width="100%" border="1" style="border:1px solid #a09e9e; margin-top: 10px;">
                                    <thead>
                                        <tr>
                                            <th style="padding:3px 5px" width="25%"> বই নাম </th>
                                            <th style="padding:3px 5px" width="10%"> এসবিএন নং </th>
                                            <?php if($type == 2){?>
                                                <th style="padding:3px 5px" width="15%" > ক্যাটাগরি </th>
                                            <?php } ?>
                                            <th style="padding:3px 5px" width="13%"> বইয়ের মূল্য </th>
                                            <th style="padding:3px 5px" width="12%"> পরিমান </th>
                                            <th style="padding:3px 5px" width="15%"> মোট মূল্য </th>
                                            <th style="padding:3px 5px;text-align: center;" width="10%"> অ্যাকশন </th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                    </tbody>
                                </table>
                                <table width="100%" border="1" border-top='0' >
                                    <tr style="border-top: none !important;">
                                        <th width="25%"></th>
                                        <th width="10%"></th>
                                        <?php if($type == 2){?>
                                            <th width="15%"></th>
                                        <?php } ?>
                                        <th width="13%"></th>
                                        <th width="12%"></th>
                                        <th width="15%"></th>
                                        <th width="10%"></th>
                                    </tr>
                                    <tr>
                                        <td colspan="4" align="right" style="padding: 0px 3px;"> সর্বমোট পরিমাণ  </td>
                                        <td  style="padding: 0px 0px;">
                                            <input type="number" id='total' name="total" class="form-control input-sm" readonly>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row form-row" style="font-size: 16px; color: black; margin-top: -20px !important;">
                                <br> <br>
                                <div class="col-md-12">
                                    <div class="form-group margin_top_10">
                                        <label for=""> বিবরণ:</label>
                                    <textarea class="form-control" name="description" style="height: 300px;" id="description"><p></p><p></p></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
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
    function removeRow(id) {
        $(id).closest("tr").remove();
        calculateTotal()
    }
</script>
<script>
   function calculateTotal(el) {
       var total = 0;
       //console.log(el);
       if (el !== undefined) {
           if ($(el).closest("tr").find(".quantity") !== undefined && $(el).closest("tr").find(".price") !== undefined) {
               var quantity = parseInt($(el).closest("tr").find(".quantity").val());
               var price = parseInt($(el).closest("tr").find(".price").val());
               if (isNaN(quantity) === false && isNaN(price) === false) {
                   $(el).closest("tr").find(".amount").val(quantity * price);
               }
           }
       }
       $(".amount").each(function() {
           var amount = parseInt($(this).val());
           if (isNaN(amount) === false) {
               total += amount;
           }
       })
       $("#total").val(total);
   }
</script>
<script>
    function getBook(val){
        var all_book=<?php echo json_encode($book);?>;
        if(val==""){
            return false;
        }
        var book=all_book[val];
        addNewRow(book);

    }
</script>
<script>
    function addNewRow(book) {
        var tr=`<tr>
                    <td style="padding:3px 3px 0px;"><span class="book_title">${book.name_bn}</span> <input type="hidden" name="book_id[]" value="${book.id}"> </td>
                    <td style="padding:3px 3px 0px;"><span class="sbn_no">${book.isbn_number}</span> <input type="hidden" name="sbn_no[]" value="${book.isbn_number}"></td>
                <?php if($type == 2){?>
                    <td style="padding:3px 3px 0px;">
                        <select name="sell_type[]" class="form-control input-sm">
                            <option value="2">বিক্রয়</option>
                            <option value="3">উপহার</option>
                        </select>
                    </td>
                <?php } ?>
                    <td style="padding:3px 3px 0px;"><input value="${book.price}" min="0" type="number" onkeyup="calculateTotal(this)" onchange="calculateTotal(this)"  name="price[]" class="form-control price input-sm " required readonly></td>
                    <td style="padding:3px 3px 0px;"><input value="1" min="0" type="number" onkeyup="calculateTotal(this)"onchange="calculateTotal(this)"  name="quantity[]" class="form-control quantity input-sm" required ></td>
                    <td style="padding:3px 3px 0px;"><input value="${book.price}" min="0" type="number" name="amount[]" class="form-control amount input-sm" readonly></td>
                    <td style="padding:3px 5px;text-align: center;"><a href="javascript:void(0)" onclick="removeRow(this)" class="btn btn-danger btn-sm" style="padding: 3px;"><i class="fa fa-times"></i> Remove</a></td>
                </tr>`
        $("#tbody").append(tr);
       $('.quantity').trigger('change');
    }
</script>




