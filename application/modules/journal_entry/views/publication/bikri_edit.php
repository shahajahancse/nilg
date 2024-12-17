<?php $obj = new BanglaNumberToWord(); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<style>
   .chosen-single {
        height: 30px !important;
        border: 1px solid #00a59a !important;
    }
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
</style>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="preview_pub_modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
      </div>
      <div class="modal-body" id="preview_pub" style="background-color: white;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="save_publication()">Submit</button>
      </div>
    </div>
  </div>
</div>


<div class="page-content">
    <div class="content">
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard')?>" class="active" > Dashboard </a></li>

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
                            <a href="<?=base_url('journal_entry/publication_bikri_list')?>"
                                class="btn btn-blueviolet btn-xs btn-mini">প্রকাশনা তালিকা</a>
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
                                <h3 style="text-decoration: underline;line-height: 32px;"><?=$meta_title?></h3>
                            </div>
                        </div>

                        <?php $attributes = array('id' => 'jsvalidate');
                            echo form_open_multipart(current_url(), $attributes); echo validation_errors(); ?>
                            <input type="hidden" name="type" value="<?php echo $type; ?>">
                            <div class="row form-row" style="font-size: 16px; color: black; margin-top: -10px !important;">
                                <div class="col-md-4">
                                    <label for="title" class="control-label">নাম <span class="required">*</span></label>
                                    <input class="form-control input-sm" name="name" style="min-height: 33px;"  required value="<?= $row->name ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="title" class="control-label">ঠিকানা <span class="required">*</span></label>
                                    <input class="form-control input-sm" name="address" style="min-height: 33px;"  required value="<?= $row->address ?>">
                                </div>
                                <div class="col-md-2">
                                    <label for="title" class="control-label">বিক্রয় ধরণ <span class="required">*</span></label>
                                    <select name="pay_type" class="form-control input-sm" required>
                                        <option value=""> নির্বাচন করুন </option>
                                        <option <?= ($row->pay_type == 1)? 'selected':'' ?> value="1">নগদ</option>
                                        <option <?= ($row->pay_type == 2)? 'selected':'' ?> value="2">চেকের মাধ্যমে</option>
                                        <option <?= ($row->pay_type == 3)? 'selected':'' ?> value="3">অর্থ স্থানান্তর</option>
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="row form-row" style="font-size: 16px; color: black; margin-top: -10px !important;">
                                <div class="col-md-3">
                                    <label for="title" class="control-label">মোবাইল <span class="required">*</span></label>
                                    <input class="form-control input-sm" name="mobile" style="min-height: 33px;"  required value="<?= $row->mobile ?>">
                                </div>

                                <div class="col-md-6">
                                    <label for="title" class="control-label">রেফারেন্স:</label>
                                    <input type="text"  value="<?= $row->reference ?>" class="form-control input-sm" name="reference" style="min-height: 33px;">
                                </div>
                            </div>
                            <br>

                            <div class="form-row" style="font-size: 16px; color: black; margin-top: -20px !important;">
                                <table width="100%" border="1" style="border:1px solid #a09e9e; margin-top: 10px;">
                                    <tr style="text-align: center !important;">
                                        <th style="padding:3px 5px" width="25%"> বই নাম </th>
                                        <th style="padding:3px 5px" width="10%" > ক্যাটাগরি </th>
                                        <th style="padding:3px 5px;" width="10%"> বইয়ের মূল্য </th>
                                        <th style="padding:3px 5px;" width="7%"> পরিমান </th>
                                        <th style="padding:3px 5px;" width="13%"> মোট মূল্য </th>
                                        <th style="padding:3px 5px;" width="10%"> কমিশন (%) </th>
                                        <th style="padding:3px 5px;" width="15%"> প্রদেয় টাকা </th>
                                    </tr>

                                    <?php foreach ($details as $key => $r) { ?>
                                    <tr style="text-align: left !important;">
                                        <input type="hidden" name="deid[]" value="<?= $r->id ?>">
                                        <input type="hidden" name="book_id[]" value="<?= $r->book_id ?>">
                                        <td style="padding:3px 5px"><?= $r->name_bn ?></td>
                                        <td style="padding:3px 3px 0px;">
                                            <select onchange="calculateTotal(this)" name="sell_type[]" class="form-control input-sm sell_type ">
                                                <option <?= $r->type==2? 'selected':'' ?> value="2">বিক্রয়</option>
                                                <option <?= $r->type==3? 'selected':'' ?> value="3">সৌজন্য</option>
                                            </select>
                                        </td>
                                        <td style="padding:3px 3px 0px;">
                                            <input style=";text-align: right;" value="<?= $r->price ?>" min="0" type="number" name="price[]" class="form-control price input-sm" required readonly>
                                        </td>
                                        <td style="padding:3px 3px 0px;">
                                            <input style=";text-align: right;" value="<?= $r->quantity ?>" min="0" type="number" onkeyup="calculateTotal(this)" name="quantity[]" class="form-control quantity input-sm" required >
                                        </td>
                                        <td style="padding:3px 3px 0px;">
                                            <input style=";text-align: right;" value="<?= $r->amount ?>" min="0" type="number" name="amount[]" class="form-control amount input-sm" readonly>
                                        </td>
                                        <td style="padding:3px 3px 0px;">
                                            <input style=";text-align: right;" value="<?= $r->commission ?>" min="0" type="number" onkeyup="calculateTotal(this)" name="commission[]" class="form-control commission input-sm" required >
                                        </td>
                                        <td style="padding:3px 3px 0px;">
                                            <input style=";text-align: right;" value="<?= $r->pay_amount ?>" name="pay_amount[]" class="form-control pay_amount input-sm" readonly>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="4" align="right" style="padding: 0px 3px;"> মোট পরিমাণ  </td>
                                        <td  style="padding: 0px 0px;">
                                            <input style="text-align: right;" value="<?= $row->amount ?>" id='total' name="total" class="form-control input-sm" readonly>
                                        </td>
                                        <td align="right" style="padding: 0px 3px;"> প্রদেয় পরিমাণ  </td>
                                        <td  style="padding: 0px 0px;">
                                            <input style="text-align: right;" value="<?= $row->pay_amount ?>" id='pay_total' name="pay_total" class="form-control input-sm" readonly>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row form-row" style="font-size: 16px; color: black; margin-top: -20px !important;">
                                <br> <br>
                                <div class="col-md-12">
                                    <div class="pull-left"><strong>কথায়:</strong> <span id="total_bangla"><?= $obj->numToWord($row->pay_amount) ?></span> টাকা মাত্র</div>
                                    <style>
                                        .btn-cons {
                                            margin-right: 0px !important;
                                            min-width: 120px;
                                            margin-bottom: 5px !important;;
                                        }
                                    </style>
                                    <div class="pull-right">
                                        <a class="btn btn-primary btn-cons" onclick="get_preview()">View Preview</a>
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

<script src="<?= base_url('assets/js/bangla_converter.js'); ?>"></script>
<!-- <script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script> -->

<script>
   function calculateTotal(el) {
       var total = 0;
       var pay_amount = 0;
       //console.log(el);
        if (el !== undefined) {
            if ($(el).closest("tr").find(".quantity") !== undefined && $(el).closest("tr").find(".price") !== undefined) {
                var quantity = parseInt($(el).closest("tr").find(".quantity").val());
                var price = parseInt($(el).closest("tr").find(".price").val());
                if (isNaN(quantity) === false && isNaN(price) === false) {
                    $(el).closest("tr").find(".amount").val(quantity * price);
                }
            }

            if ($(el).closest("tr").find(".commission") !== undefined && $(el).closest("tr").find(".amount") !== undefined) {

                var sell_type = $(el).closest("tr").find(".sell_type").val();
                if (sell_type == 3) {
                    var commission = 100;
                    $(el).closest("tr").find(".commission").val(commission)
                } else {
                    var commission = parseInt($(el).closest("tr").find(".commission").val());
                    if (commission == 100) {
                        var commission = 0;
                        $(el).closest("tr").find(".commission").val(commission)
                    } else {
                        var commission = parseInt($(el).closest("tr").find(".commission").val());
                    }
                }
                var amount = parseInt($(el).closest("tr").find(".amount").val());
                if (commission != 0 && isNaN(commission) === false && isNaN(amount) === false) {
                   $(el).closest("tr").find(".pay_amount").val(amount - ((commission * amount) / 100));
                } else {
                   $(el).closest("tr").find(".pay_amount").val(amount);
                }
            }
        }

        $(".amount").each(function() {
            var amount = parseInt($(this).val());
            if (isNaN(amount) === false) {
                total += amount;
            }
        })

       $(".pay_amount").each(function() {
           var pay_total = parseInt($(this).val());
           if (isNaN(pay_total) === false) {
               pay_amount += pay_total;
           }
       })
       $("#total").val(total);
       $("#pay_total").val(pay_amount);
       $("#total_bangla").html(generateWords(pay_amount));
   }
</script>

<script>
    function removeRow(id) {
        $(id).closest("tr").remove();
        calculateTotal()
    }
</script>

<script>
    function getBook(el){
        var val=$(el).val();
        var all_book=<?php echo json_encode($book);?>;
        if(val==""){
            return false;
        }
        var book=all_book[val];
        addNewRow(book);
        disableOption(val);
    }
    function disableOption(value) {
        $('#book_id option[value="' + value + '"]').prop('disabled', true);
        $('#book_id').select2();
    }
</script>

<script>
    function addNewRow(book) {
        var tr=`<tr>
                <td style="padding:3px 3px 0px;"><span class="book_title">${book.name_bn}</span> <input type="hidden" name="book_id[]" value="${book.id}"> </td>

                <td style="padding:3px 3px 0px;"><select onchange="calculateTotal(this)" name="sell_type[]" class="form-control input-sm sell_type "><option value="2">বিক্রয়</option><option value="3">সৌজন্য</option></select></td>

                <td style="padding:3px 3px 0px;"><input style=";text-align: right;" value="${book.price}" min="0" type="number" onkeyup="calculateTotal(this)" onchange="calculateTotal(this)"  name="price[]" class="form-control price input-sm" required readonly></td>

                <td style="padding:3px 3px 0px;"><input style=";text-align: right;" value="1" min="0" type="number" onkeyup="calculateTotal(this)" onchange="calculateTotal(this)"  name="quantity[]" class="form-control quantity input-sm" required ></td>

                <td style="padding:3px 3px 0px;"><input style=";text-align: right;" value="${book.price}" min="0" type="number" name="amount[]" class="form-control amount input-sm" readonly></td>

                <td style="padding:3px 3px 0px;"><input style=";text-align: right;" value="0" min="0" type="number" onkeyup="calculateTotal(this)" onchange="calculateTotal(this)"  name="commission[]" class="form-control commission input-sm" required ></td>

                <td style="padding:3px 3px 0px;"><input style=";text-align: right;" value="${book.price}" min="0" type="number" name="pay_amount[]" class="form-control pay_amount input-sm" readonly></td>

                <td style="padding:3px 5px;text-align: center;"><a href="javascript:void(0)" onclick="removeRow(this)" class="btn btn-danger btn-sm" style="padding: 3px;"><i class="fa fa-times"></i> Remove</a></td>
            </tr>`
        $("#tbody").append(tr);
        $('.quantity').trigger('change');
    }
</script>

<script>
    function get_preview(){
        var name = $('#name').val();
        var mobile = $('#mobile').val();
        var address = $('#address').val();

        if(name == "" || mobile == "" || address == ""){
            alert("অবশ্যই নাম, মোবাইল এবং ঠিকানা দিতে হবে");
            return false;
        }

        var form = $('#jsvalidate').serializeArray();
        // var description = CKEDITOR.instances['description'].getData();
        // form.push({name: 'description', value: description});
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>journal_entry/get_preview_pub",
            data: form,
            success: function(data)
            {
                $('#preview_pub_modal').modal('show');
                $('#preview_pub').html(data);
            }
        });
    }
</script>

<script>
    function save_publication(){
        $('#preview_pub_modal').modal('hide');
        $("#submit_btn").click();
    }
</script>



