<div class="page-content">

<?php //dd($group) ?>
    <div class="modal fade" id="publication_group_create_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">হোস্টেল সিট অ্যাড  করুন</h4> 
                </div>
                <div class="modal-body">
                    <form action="<?=base_url('nilg_setting/hostel_seat_add') ?>"
                        id="publication_group_setting_create_form" method="post">
                        <div class="form-group">
                            <label for="name_bn">নাম</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="নাম" value="<?=set_value('name')?>" required>
                        </div>
                       
                        <div class="form-group">
                            <label for="room_id">রুম</label>
                            <select name="room_id" id="room_id" class="form-control" required>
                                <option value="">রুম নির্বাচন করুন</option>
                                <?php
                                
                                $room=$this->db->get('budget_j_hostel_room')->result();
                                foreach ($room as $row):
                                    ?>
                                <option value="<?= $row->id ?>"><?= $row->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">মূল্য</label>
                            <input type="text" name="amount" id="amount" class="form-control" placeholder="মূল্য"
                                value="<?=set_value('amount')?>" required>
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
                                class="btn btn-blueviolet btn-xs btn-mini">হোস্টেল সিট তৈরি করুন</a>
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
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>নাম</th>
                                    <th>রুম</th>
                                    <th>মূল্য</th>
                                    <th>স্টাটাস</th>
                                    <th>অ্যাকশন</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result as $key => $row): ?>
                                <tr>
                                    <td><?=$key+1 ?></td>
                                    <td><?=$row->name ?></td>
                                    <td><?=$row->room_name ?></td>
                                    <td><?=$row->amount ?></td>
                                    <td>
                                        <?php if($row->status == 1): ?>
                                        <a class="btn btn-success btn-xs btn-mini" >Active</a>
                                        <?php else: ?>
                                        <a class="btn btn-danger btn-xs btn-mini" >Inactive</a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?=base_url('nilg_setting/hostel_seat_delete/'.$row->id)?>" class="btn btn-xs btn-mini btn-danger">ডিলিট</a>
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
