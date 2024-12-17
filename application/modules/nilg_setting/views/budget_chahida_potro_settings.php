<div class="page-content">
    <div class="content">
        <ul class="breadcrumb" style="margin-bottom: 20px;">
            <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
            <li> <a href="javascript:void()" class="active"> <?=$module_name?> </a></li>
            <li> <?=$meta_title;?> </li>
        </ul>

        <div class="row">
            <div class="col-md-12">
                <div class="grid simple ">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                    </div>
                    <div class="grid-body">
                    <div class="row">
            <div class="col-md-8 offset-md-2">
                <form action="<?= base_url('nilg_setting/budget_chahida_potro_settings_update') ?>" method="post" style="display: flex;flex-direction: column;justify-content: center;gap: 10px;">
                    <div class="mb-3 row">
                        <label for="acc_app" class="col-sm-4 col-form-label">Account Approval</label>
                        <div class="col-sm-8">
                            <input type="checkbox" class="form-check-input" id="acc_app" name="acc_app" <?= $row->acc_app==1 ? 'checked' : '' ?>>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="join_director_app" class="col-sm-4 col-form-label">Join Director Approval</label>
                        <div class="col-sm-8">
                            <input type="checkbox" class="form-check-input" id="join_director_app" name="join_director_app" <?= $row->join_director_app==1 ? 'checked' : '' ?>>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="director_app" class="col-sm-4 col-form-label">Director Approval</label>
                        <div class="col-sm-8">
                            <input type="checkbox" class="form-check-input" id="director_app" name="director_app" <?= $row->director_app==1 ? 'checked' : '' ?>>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-8 offset-sm-4 text-center">
                            <button type="submit" class="btn btn-primary">সেভ করুন</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- END Content -->
</div>