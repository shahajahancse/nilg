
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
            <li><a href="<?=base_url('nilg_setting/bank_account')?>" class="active"><?=$module_name?></a></li>
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
                            <a href="<?=base_url('nilg_setting/bank_account')?>" class="btn btn-blueviolet btn-xs btn-mini">অ্যাকাউন্ট তালিকা</a>
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
                                    <legend>ব্যাংক অ্যাকাউন্ট তথ্য</legend>
                                    <div class="row form-row" style="font-size: 16px; color: black; margin-top: -20px !important;">
                                        <br>
                                        <div class="col-md-5">
                                            <label for="title" class="control-label">ব্যাংক নাম (বাংলা): <span class="required">*</span></label>
                                            <input value="<?=$row->name_bn?>" required class="form-control input-sm" name="name_bn" style="min-height: 33px;">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="title" class="control-label">ব্যাংক নাম (ইংরেজী): <span class="required">*</span></label>
                                            <input value="<?=$row->name_en?>" required class="form-control input-sm" name="name_en" style="min-height: 33px;">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="title" class="control-label">অ্যাকাউন্ট নং: <span class="required">*</span></label>
                                            <input value="<?=$row->account_no?>" required type="text" name="account_no" class="form-control input-sm">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="title" class="control-label">ঠিকানা (বাংলা): <span class="required">*</span></label>
                                            <textarea required name="address_bn" class="form-control input-sm"><?= $row->address_bn ?></textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="title" class="control-label">ঠিকানা (ইংরেজী): <span class="required">*</span></label>
                                            <textarea required name="address_en" class="form-control input-sm"><?= $row->address_en ?></textarea>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="title" class="control-label">টাইপ:</label>
                                            <select name="type" class="form-control input-sm" >
                                                <option <?= $row->type==1? 'selected':'' ?> value="1">Nilg</option>
                                                <option <?= $row->type==2? 'selected':'' ?> value="2">Officer</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="title" class="control-label">স্ট্যাটাস:</label>
                                            <select name="status" class="form-control input-sm" >
                                                <option <?= $row->status==1? 'selected':'' ?> value="1">এনাবল</option>
                                                <option <?= $row->status==2? 'selected':'' ?> value="2">ডিজেবল</option>
                                            </select>
                                        </div>
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
