<style>
    @media only screen and (max-width: 1140px) {
        .tableresponsive {
            width: 100%;
            margin-bottom: 15px;
            overflow-y: hidden;
            overflow-x: scroll;
            -webkit-overflow-scrolling: touch;
            white-space: nowrap;
        }
    }
</style>

<div class="page-content">


    <div class="modal fade" id="publication_group_create_modal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="true">
        <form action="<?= base_url('nilg_setting/publication_group_create') ?>" id="publication_group_setting_create_form" method="post">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">প্রকাশনা গ্রুপ তৈরি করুন</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                <label for="name_bn" class="control-label">Name (BN):</label>
                                <input type="text" class="form-control" id="name_bn" name="name_bn" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name_en" class="control-label">Name (EN):</label>
                                <input type="text" class="form-control" id="name_en" name="name_en" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group col-md-12">
                                <label for="description" class="control-label">Description:</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </form>

    </div>






    <div class="content">
        <ul class="breadcrumb" style="margin-bottom: 20px;">
            <li> <a href="<?= base_url('dashboard') ?>" class="active"> ড্যাশবোর্ড </a> </li>
            <li> <a href="javascript:void()" class="active"> <?= $module_name ?> </a></li>
            <li> <?= $meta_title; ?> </li>
        </ul>

        <div class="row">
            <div class="col-md-12">
                <div class="grid simple ">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
                        <div class="pull-right"
                            style="display: flex;align-content: center;justify-content: center;flex-wrap: wrap;gap: 8px;">
                            <a data-toggle="modal" href='#publication_group_create_modal'
                                class="btn btn-blueviolet btn-xs btn-mini">প্রকাশনা গ্রুপ তৈরি করুন</a>
                        </div>
                    </div>

                    <div class="grid-body tableresponsive">
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success">
                                <?= $this->session->flashdata('success'); ?>
                            </div>
                        <?php endif; ?>

                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ক্রম</th>
                                    <th>নাম (বাংলা)</th>
                                    <th>নাম (ইংরেজি)</th>
                                    <th>বিস্তারিত</th>
                                    <th>তৈরির তারিখ</th>
                                    <th>অ্যাকশন</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result as $key => $row): ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $row['name_bn'] ?></td>
                                        <td><?= $row['name_en'] ?></td>
                                        <td><?= $row['description'] ?></td>
                                        <td><?= $row['created_at'] ?></td>
                                        <td>
                                            <a onclick="update(<?= $row['id'] ?>)" class="btn btn-primary btn-xs btn-mini">আপডেট</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>


                    </div>

                </div>
            </div>
        </div>
    </div> <!-- END Content -->
</div>
<script>
    function update(id) {
        $.blockUI({
            message: '<div class="sk-cube-grid"><div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div><div class="sk-cube sk-cube6"></div><div class="sk-cube sk-cube7"></div><div class="sk-cube sk-cube8"></div><div class="sk-cube sk-cube9"></div></div>'
        });
        $.ajax({
            type: "POST",
            url: "<?= base_url('nilg_setting/publication_group_setting_update') ?>" + '/' + id,
            data: {
                id: id
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#id').val(obj.id);
                $('#name_bn').val(obj.name_bn);
                $('#name_en').val(obj.name_en);
                $('#description').val(obj.description);
                $('#publication_group_create_modal').modal('show');
                $('#publication_group_setting_create_form').attr('action', "<?= base_url('nilg_setting/publication_group_setting_update') ?>" + '/' + obj.id);

            }
        }).always(function() {
            $.unblockUI();
        });
    }
</script>