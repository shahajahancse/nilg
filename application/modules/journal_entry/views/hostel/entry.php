
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
                            <a href="<?=base_url('journal_entry/hostel_entry')?>"
                                class="btn btn-blueviolet btn-xs btn-mini">হোস্টেল তালিকা</a>
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
                            echo form_open_multipart(current_url(),$attributes);
                            echo validation_errors();
                        ?>

                        <div class="row">
                            <div class="col-md-12">
                                <fieldset style="background: #fff !important;">
                                    <div class="col-md-12"
                                        style="padding: 20px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                                        <div>
                                            <span style="font-size: 22px;font-weight: bold;text-decoration: underline;"> হোস্টেল তথ্য এন্ট্রি ফর্ম </span>
                                        </div>
                                    </div>
                                    <div class="row form-row" style="font-size: 16px; color: black; margin-top: -20px !important;">
                                        <br>
                                        <input type="hidden" value="<?php echo 'JR'.date('Ymdhis'); ?>" name="voucher_no">
                                        <!-- <div class="col-md-2">
                                            <label for="title" class="control-label">ভাউচার নাঃ </label>
                                        </div> -->
                                        <div class="col-md-3">
                                            <label for="title" class="control-label">নামঃ <span class="required">*</span></label>
                                            <input type="text" class="form-control input-sm" name="name" style="min-height: 33px;"  required>
                                        </div>
                                         <div class="col-md-2">
                                            <label for="title" class="control-label">এনআইডি নাঃ <span class="required">*</span></label>
                                            <input type="text" class="form-control input-sm" name="nid" style="min-height: 33px;"  required>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="title" class="control-label">মোবাইল নাঃ <span class="required">*</span></label>
                                            <input type="text" class="form-control input-sm" name="mobile" style="min-height: 33px;"  required>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label">রেফারেন্স </label>
                                            <input type="text" class="form-control input-sm" name="reference" style="min-height: 33px;" >
                                        </div>
                                        <div class="col-md-2">
                                            <label for="title" class="control-label">তারিখ:</label>
                                            <input value="<?= date('Y-m-d') ?>" class="form-control input-sm" name="date" style="min-height: 33px;" required readonly>
                                        </div>
                                    </div>

                                    <div class="row form-row" style="font-size: 16px; color: black; margin-top: -20px !important;">
                                        <br>
                                        <div class="col-md-3">
                                            <label for="title" class="control-label">কক্ষ নির্বাচন করুন <span class="required">*</span></label>
                                            <?php $rooms = $this->db->get('budget_j_hostel_room')->result(); ?>
                                            <select id="room_id" class="form-control input-sm" name="room_id" required>
                                                <option value="">কক্ষ নির্বাচন করুন</option>
                                                <?php foreach ($rooms as $key => $value) { ?>
                                                    <option value="<?=$value->id?>"><?=$value->name?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="title" class="control-label">আসন নির্বাচন করুন <span class="required">*</span></label>
                                            <select onchange="getAmount()" id="seat_id" class="form-control input-sm" name="seat_id" required>
                                                <option>আসন নির্বাচন করুন</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="title" class="control-label">শুরুর তারিখ <span class="required">*</span></label>
                                            <input onchange="getAmount()" class="form-control datetime input-sm" name="start_date" id="start_date" style="min-height: 33px;" required>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="title" class="control-label"> শেরের তারিখ <span class="required">*</span></label>
                                            <input onchange="getAmount()" class="form-control datetime input-sm" name="end_date" id="end_date" style="min-height: 33px;" required>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="title" class="control-label"> পরিমাণ</label>
                                            <input id="total_amount_hostel" class="form-control input-sm" name="amount" style="min-height: 33px;" required readonly>
                                        </div>
                                    </div>

                                    <div class="row form-row" style="font-size: 16px; color: black; margin-top: -20px !important;">
                                        <br>
                                        <div class="col-md-12">
                                            <div class="form-group margin_top_10">
                                                <label for=""> মন্তব্য:</label>
                                            <textarea class="form-control" name="description" style="height: 300px;" id="description"><p></p><p></p></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pull-right">
                                        <input type="submit" name="submit" id="submit_btn" value="সংরক্ষণ করুন" class="btn btn-primary btn-cons">
                                    </div>
                                </fieldset>
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
    $('#room_id').change(function(){
        var val = $(this).val();
        $("#seat_id > option").remove();
        $("#seat_id").append('<option value="">' + 'আসন নির্বাচন করুন' + '</option>');
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>journal_entry/getSeat",
            data: {room_id: val},
            success: function(data) {
                data = JSON.parse(data);
                $.each(data, function(key, value) {
                    $("#seat_id").append('<option value="' + value.id + '">' + value.name +' >> '+value.amount+ '</option>');
                });
            }
        });
    });
</script>

<script>
    function getAmount() {
        if($('#seat_id').val() != '' && $('#start_date').val() != '' && $('#end_date').val() != '') {
           var seat_id = $('#seat_id').val()
           var start_date = $('#start_date').val()
           var end_date = $('#end_date').val()
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>journal_entry/getAmount_hostel",
                data: {
                    seat_id: seat_id,
                    start_date: start_date,
                    end_date: end_date},
                success: function(data) {
                    $('#total_amount_hostel').val(data);
                }
            });
        }else{
            $('#total_amount_hostel').val(0);
        }
    }
</script>






