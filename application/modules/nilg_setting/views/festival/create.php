
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
            <li><a href="<?=base_url('nilg_setting/festival')?>" class="active"><?=$module_name?></a></li>
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
                            <a href="<?=base_url('nilg_setting/festival')?>" class="btn btn-blueviolet btn-xs btn-mini">উৎসব ভাতা তালিকা</a>
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
                            echo form_open_multipart("nilg_setting/festival_create",$attributes);
                            echo validation_errors();
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset style="background: #fff !important;">
                                    <legend>উৎসব ভাতা তথ্য</legend>
                                    <div class="row form-row" style="font-size: 16px; color: black; margin-top: -20px !important;">
                                        <br>
                                        <div class="col-md-4">
                                            <label for="title" class="control-label">নাম (বাংলা): <span class="required">*</span></label>
                                            <input required class="form-control input-sm" name="name_bn" style="min-height: 33px;">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="title" class="control-label">নাম (ইংরেজী): <span class="required">*</span></label>
                                            <input required class="form-control input-sm" name="name_en" style="min-height: 33px;">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="title" class="control-label">পরিমাণ: <span class="required">*</span></label>
                                            <input required type="text" name="amount" class="form-control input-sm">
                                        </div>
                                        <!-- <div class="col-md-2">
                                            <label for="title" class="control-label">টাইপ:</label>
                                            <select name="type" class="form-control input-sm" >
                                                <option value="1">Officer</option>
                                                <option value="2">Staff</option>
                                            </select>
                                        </div> -->
                                    </div>
                                </fieldset>
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
