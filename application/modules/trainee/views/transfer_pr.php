<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple horizontal red">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                        <div class="pull-right">
                            <a href="<?=base_url('trainee/all_pr')?>" class="btn btn-primary btn-xs btn-mini"> জনপ্রতিনিধির তালিকা </a>
                        </div>
                    </div>
                    <div class="grid-body">
                        <div class="row mb-50">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="pull-left">
                                        <h4 style="line-height: .5; font-size: 16px; font-weight: bold;"> বর্তমান অফিসের
                                            তথ্যঃ </h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="row form-row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">নামঃ </label>
                                                <div class="font-big-bold"> <?= $info->name_bn ?> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">বর্তমান কর্মরত অফিসঃ </label>
                                                <div class="font-big-bold"> <?= $info->office_name ?> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">বর্তমান দ্বায়িত্বপ্রাপ্ত পদবিঃ </label>
                                                <div class="font-big-bold"> <?=$info->current_desig_name?> </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">বর্তমান অফিসে যোগদানের তারিখঃ </label>
                                                <div class="font-big-bold">
                                                    <?=date_bangla_calender_format($info->crrnt_attend_date)?> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="pull-left">
                                        <h4 style="line-height: .5; font-size: 16px; font-weight: bold;"> বদলি অফিসের
                                            তথ্যঃ </h4>
                                    </div>
                                </div>
                                <hr>
                                <?php $attributes = array('id' => 'validate');
		                        echo form_open_multipart(uri_string(), $attributes); ?>
                                <?php if ($this->session->flashdata('success')) : ?>
                                <div class="alert alert-success">
                                    <?php echo $this->session->flashdata('success');; ?>
                                </div>
                                <?php endif; ?>

                                <div class="row">
                                    <div class="row form-row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">অফিসের নামঃ</label>
                                                <?php echo form_error('crrnt_office_id'); ?>
                                                <select class="officeSelect2 form-control input-sm"
                                                    name="crrnt_office_id" id="crrnt_office_id">
                                                </select>
                                                <div id="typeerror"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">যোগদানের তারিখঃ <span
                                                        class="required">*</span></label>
                                                <input name="transfer_join_date" type="text"
                                                    value="<?= set_value('transfer_join_date') ?>"
                                                    class="datetime form-control input-sm" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">বদলির অর্ডার ফাইলঃ (Optional) </label>
                                                <input name="transfer_order_file" type="file"
                                                    class="form-control input-sm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="pull-right">
                                            <?php echo form_submit('submit', lang('common_save'), "class='btn btn-primary btn-cons font-big-bold'"); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div> <!-- END GRID BODY -->
                </div> <!-- END GRID -->
            </div>

        </div> <!-- END ROW -->
    </div>
</div>