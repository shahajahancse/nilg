<div class="page-content">

<?php //dd($group) ?>
    <div class="modal fade" id="publication_group_create_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">প্রকাশনা বই অ্যাড  করুন</h4>
                </div>
                <div class="modal-body">
                    <form action="<?=base_url('nilg_setting/publication_book_add') ?>"
                        id="publication_group_setting_create_form" method="post">
                        <div class="form-group">
                            <label for="name_bn">নাম (বাংলা)</label>
                            <input type="text" name="name_bn" id="name_bn" class="form-control"
                                placeholder="নাম (বাংলা)" value="<?=set_value('name_bn')?>" required>
                        </div>
                        <div class="form-group">
                            <label for="name_en">নাম (ইংরেজি)</label>
                            <input type="text" name="name_en" id="name_en" class="form-control"
                                placeholder="নাম (ইংরেজি)" value="<?=set_value('name_en')?>" required>
                        </div>
                        <div class="form-group">
                            <label for="isbn_number">ISBN নাম্বার</label>
                            <input type="text" name="isbn_number" id="isbn_number" class="form-control"
                                placeholder="ISBN নাম্বার" value="<?=set_value('isbn_number')?>" >
                        </div>
                        <div class="form-group">
                            <label for="prokash_kal">প্রকাশনী</label>
                            <input type="text" name="prokash_kal" id="prokash_kal" class="form-control"
                                placeholder="প্রকাশনী" value="<?=set_value('prokash_kal')?>" >
                        </div>
                        <div class="form-group">
                            <label for="group_id">গ্রুপ আইডি</label>
                            <select name="group_id" id="group_id" class="form-control" required>
                                <option value="">গ্রুপ নির্বাচন করুন</option>
                                <?php foreach ($group as $row):

                                    ?>
                                <option value="<?= $row->id ?>"
                                    <?php if (set_value('group_id') == $row->id) echo 'selected'; ?>>
                                    <?= $row->name_bn ?> (<?= $row->name_en ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">মূল্য</label>
                            <input type="text" name="price" id="price" class="form-control" placeholder="মূল্য"
                                value="<?=set_value('price')?>" required>
                        </div>
                        <div class="form-group">
                            <label for="status">স্টাটাস</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="1" <?php if (set_value('status') == '1') echo 'selected'; ?>>
                                    সক্রিয়</option>
                                <option value="2" <?php if (set_value('status') == '2') echo 'selected'; ?>>
                                    অসক্রিয</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">বিবরণ</label>
                            <textarea name="description" id="description" class="form-control"
                                placeholder="বিবরণ"><?=set_value('description')?></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">সেভ করুন</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




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
                        <div class="pull-right"
                            style="display: flex;align-content: center;justify-content: center;flex-wrap: wrap;gap: 8px;">
                            <a data-toggle="modal" href='#publication_group_create_modal'
                                class="btn btn-blueviolet btn-xs btn-mini">প্রকাশনা বই তৈরি করুন</a>
                        </div>
                    </div>

                    <div class="grid-body">
                        <?php if($this->session->flashdata('success')):?>
                        <div class="alert alert-success">
                            <?=$this->session->flashdata('success');?>
                        </div>
                        <?php endif; ?>
                        <?php if($this->session->flashdata('error')):?>
                        <div class="alert alert-success">
                            <?=$this->session->flashdata('error');?>
                        </div>
                        <?php endif; ?>

                        <!-- <form action="<?=base_url('nilg_setting/publication_book_add') ?>"
                            id="publication_group_setting_create_form" method="post">
                            <div class="form-group">
                                <label for="name_bn">নাম (বাংলা)</label>
                                <input type="text" name="name_bn" id="name_bn" class="form-control"
                                    placeholder="নাম (বাংলা)" value="<?=set_value('name_bn')?>" required>
                            </div>
                            <div class="form-group">
                                <label for="name_en">নাম (ইংরেজি)</label>
                                <input type="text" name="name_en" id="name_en" class="form-control"
                                    placeholder="নাম (ইংরেজি)" value="<?=set_value('name_en')?>" required>
                            </div>
                            <div class="form-group">
                                <label for="isbn_number">ISBN নাম্বার</label>
                                <input type="text" name="isbn_number" id="isbn_number" class="form-control"
                                    placeholder="ISBN নাম্বার" value="<?=set_value('isbn_number')?>" required>
                            </div>
                            <div class="form-group">
                                <label for="prokash_kal">প্রকাশনী</label>
                                <input type="text" name="prokash_kal" id="prokash_kal" class="form-control"
                                    placeholder="প্রকাশনী" value="<?=set_value('prokash_kal')?>" required>
                            </div>
                            <div class="form-group">
                                <label for="group_id">গ্রুপ আইডি</label>
                                <select name="group_id" id="group_id" class="form-control" required>
                                    <option value="">গ্রুপ নির্বাচন করুন</option>
                                    <?php foreach ($group as $row): ?>
                                    <option value="<?= $row->id ?>"
                                        <?php if (set_value('group_id') == $row->id) echo 'selected'; ?>>
                                        <?= $row->name_bn ?> (<?= $row->name_en ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="price">মূল্য</label>
                                <input type="text" name="price" id="price" class="form-control" placeholder="মূল্য"
                                    value="<?=set_value('price')?>" required>
                            </div>
                            <div class="form-group">
                                <label for="status">স্টাটাস</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="1" <?php if (set_value('status') == '1') echo 'selected'; ?>>
                                        সক্রিয়াক্টিভ</option>
                                    <option value="2" <?php if (set_value('status') == '2') echo 'selected'; ?>>
                                        অসক্রিয়াক্টিভ</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">বিবরণ</label>
                                <textarea name="description" id="description" class="form-control"
                                    placeholder="বিবরণ"><?=set_value('description')?></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">সেভ করুন</button>
                            </div>
                        </form> -->

                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>নাম (বাংলা)</th>
                                    <th>নাম (ইংরেজি)</th>
                                    <th>ISBN নাম্বার</th>
                                    <th>প্রকাশনী</th>
                                    <th>মূল্য</th>
                                    <th>বিবরণ</th>
                                    <th>অ্যাকশন</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result as $key => $row): ?>
                                <tr>
                                    <td><?=$key+1 ?></td>
                                    <td><?=$row->name_bn ?></td>
                                    <td><?=$row->name_en ?></td>
                                    <td><?=$row->isbn_number ?></td>
                                    <td><?=$row->prokash_kal ?></td>
                                    <td><?=$row->price ?></td>
                                    <td><?=$row->description ?></td>
                                    <td>
                                        <a href="<?=base_url('nilg_setting/publication_book_delete/'.$row->id)?>" class="btn btn-xs btn-mini btn-danger">ডিলিট</a>
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
