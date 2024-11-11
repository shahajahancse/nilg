
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
            <li><a class="active"><?=$module_name?></a></li>
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
                            <a href="<?=base_url('journal_entry/hostel_booking_acc_list')?>"
                                class="btn btn-blueviolet btn-xs btn-mini">তালিকা</a>
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
                            <div class="row form-row" style="font-size: 16px; color: black; margin-top: -10px !important;">
                                <div class="col-md-3">
                                    <label>শুরুর তারিখ: <span class="required">*</span></label>
                                    <input class="form-control input-sm datetime" name="from_date" style="min-height: 33px;" required>
                                </div>
                                <div class="col-md-3">
                                    <label>শেরের তারিখ: <span class="required">*</span></label>
                                    <input class="form-control input-sm datetime" name="to_date" style="min-height: 33px;" required>
                                </div>
                                <div class="col-md-3">
                                    <label>বিক্রয় ধরণ <span class="required">*</span></label>
                                    <select name="pay_type" class="form-control input-sm" required>
                                        <option value=""> নির্বাচন করুন </option>
                                        <option value="1">নগদ</option>
                                        <option value="2">চেকের মাধ্যমে</option>
                                        <option value="3">অর্থ স্থানান্তর</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>প্রদেয় পরিমাণ <span class="required">*</span></label>
                                    <input class="form-control input-sm" name="amount" style="min-height: 33px;"  required>
                                </div>
                            </div>
                            <br>

                            <input type="hidden" value="<?php echo 'JR'.date('Ymdhis'); ?>" name="voucher_no">
                            <div class="row form-row" >
                                <div class="col-md-12">
                                    <label>চিঠি <span class="required">*</span></label>
                                    <textarea class="form-control input-sm" name="description" id="description"></textarea>
                                </div>
                                <style>
                                    .btn-cons {
                                        margin-top: 10px;
                                        margin-right: 0px !important;
                                    }
}
                                </style>
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        <!-- <a class="btn btn-primary btn-cons" onclick="get_preview()">View Preview</a> -->
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
    ClassicEditor.create(document.querySelector('#description')).then(editor => {window.editor = editor;}).catch(error => {console.error(error)});
</script>



