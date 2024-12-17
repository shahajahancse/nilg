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
    <div class="content">
        <ul class="breadcrumb" style="margin-bottom: 20px;">
            <li> <a href="<?= base_url('dashboard') ?>" class="active"> ড্যাশবোর্ড </a> </li>
            <li> <?= $meta_title; ?> </li>
        </ul>

        <div class="row">
            <div class="col-md-12">
                <div class="grid simple ">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
                        <div class="pull-right" style="display: flex;align-content: center;justify-content: center;flex-wrap: wrap;gap: 8px;">
                            <?php if ($this->ion_auth->in_group(array('admin','bho'))) { ?>
                            <a href="<?= base_url('journal_entry/hostel_booking_acc_create') ?>" class="btn btn-blueviolet btn-xs btn-mini">এন্ট্রি করুন</a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="grid-body ">
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success">
                                <?= $this->session->flashdata('success'); ?>
                            </div>
                        <?php endif; ?>

                        <style type="text/css">
                            .btt-m,
                            .btt-m:focus,
                            .btt-m:active:focus,
                            .btt-m.active:focus {
                                outline: none !important;
                                padding: 5px 25px !important;
                                margin-top: 0px;
                            }

                            .btt-t,
                            .btt-t:focus,
                            .btt-t:active:focus,
                            .btt-t.active:focus,
                            .btt-t:hover {
                                outline: none !important;
                                padding: 5px 25px !important;
                                margin-top: 0px !important;
                                width: 40px !important;
                                background: #ddb90a;
                            }
                        </style>
                        <div class="table-responsive ">
                            <table class="table table-hover table-condensed data_table" border="0">
                                <thead style="background: #d2dee9;">
                                    <tr>
                                        <th> ক্রম </th>
                                        <th> শুরুর তারিখ </th>
                                        <th> শেষের তারিখ </th>
                                        <th>বিক্রয় ধরণ</th>
                                        <th>প্রদেয় টাকা</th>
                                        <th>ইস্যু তারিখ</th>
                                        <th>অবস্থা</th>
                                        <th style="text-align: right;">অ্যাকশন</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sl = $pagination['current_page'];
                                    foreach ($results as $row): $sl++; ?>
                                        <tr>
                                            <td class="v-align-middle"><?= eng2bng($sl) . '.' ?></td>
                                            <td class="v-align-middle"><?= eng2bng($row->from_date); ?></td>
                                            <td class="v-align-middle"><?= eng2bng($row->from_date); ?></td>
                                            <?php if ($row->pay_type == 1) {
                                                $type = '<span class="label label-success">নগদ</span>';
                                            } else if ($row->pay_type == 2) {
                                                $type = '<span class="label label-success">চেকের মাধ্যমে</span>';
                                            } else {
                                                $type = '<span class="label label-success">অর্থ স্থানান্তর</span>';
                                            } ?>
                                            <td class="v-align-middle"><?= $type; ?></td>
                                            <td class="v-align-middle"><?= eng2bng($row->amount); ?></td>
                                            <td class="v-align-middle"><?= eng2bng($row->issue_date); ?></td>
                                            <?php if ($row->status == 1) {
                                                $status = '<span class="label label-success">ড্রাফ্‌ট</span>';
                                            } else if ($row->status == 2) {
                                                $status = '<span class="label label-warning">প্রোসেসিং</span>';
                                            } else if ($row->status == 3) {
                                                $status = '<span class="label label-success">অনুমোদিত</span>';
                                            } else {
                                                $status = '<span class="label label-danger">বাতিল</span>';
                                            }
                                            ?>
                                            <td class="v-align-middle"><?= $status; ?></td>
                                            <td align="right">
                                                <div class="btn-group">
                                                    <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                                                    <button class="btn btn-mini btn-primary dropdown-toggle"
                                                        data-toggle="dropdown"> <span class="caret"></span> </button>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li><a href="<?php echo base_url('journal_entry/hostel_booking_acc_details/' . encrypt_url($row->id)) ?>"><i class="fa fa-pencil-square"></i> বিস্তারিত </a></li>

                                                        <li><a href="<?php echo base_url('journal_entry/hostel_booking_acc_print/' . encrypt_url($row->id)) ?>" target="_blank"><i class="fa fa-pencil-square" target="_blank"></i> প্রিন্ট করুন</a></li>

                                                        <?php if ($row->status == 1  && $this->ion_auth->in_group(array('bho'))) { ?>
                                                            <li><a href="<?php echo base_url('journal_entry/hostel_booking_forword/2/' . encrypt_url($row->id)) ?>"><i class="fa fa-pencil-square"></i> ফরওয়ার্ড </a> </li>
                                                        <?php } ?>

                                                        <?php if ($row->status == 2 && $this->ion_auth->in_group(array('bho'))) { ?>
                                                            <li><a href="<?php echo base_url('journal_entry/hostel_booking_forword/1/' . encrypt_url($row->id)) ?>"><i class="fa fa-pencil-square"></i> ব্যাক </a> </li>
                                                        <?php } ?>

                                                        <?php if ($row->status == 2 && $this->ion_auth->in_group(array('acc'))) { ?>
                                                        <li><a href="<?php echo base_url('journal_entry/hostel_booking_forword/3/' . encrypt_url($row->id)) ?>"><i class="fa fa-pencil-square"></i> অ্যাপ্রুভ</a></li>
                                                        <li><a href="<?php echo base_url('journal_entry/hostel_booking_forword/4/' . encrypt_url($row->id)) ?>"><i class="fa fa-pencil-square"></i> বাতিল</a></li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> সর্বমোট <span
                                    style="color: green; font-weight: bold;"><?php echo eng2bng($total_rows); ?>
                                    প্রকাশনা </span></div>
                            <div class="col-sm-8 col-md-8 text-right">
                                <?php echo $pagination['links']; ?>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div> <!-- END Content -->
</div>


<script>
    $(document).ready(function() {
        var html = `
        <style>
        .dataTables_filter {
            display: flex;
            align-content: flex-end;
            flex-wrap: wrap;
            flex-direction: row;
            justify-content: flex-end;
            align-items: center;
        }
        </style>
        <div class="col-md-6" style="display: flex;justify-content: space-around; flex-wrap: wrap;">
            <div class="text-center" >
                Date Range
            </div>
            <div>
                <input type="date" id="min"  onchange="filterDate()" class="form-control mt-3 mb-3 m-b-5"style="min-height: 25px;">
            </div>
            <div class="text-center" >
                to
            </div>
            <div >
                <input type="date" id="max"  onchange="filterDate()" class="form-control mt-3 mb-3 m-b-5" style="min-height: 25px;">
            </div>
        </div>
        `
        $("#DataTables_Table_0_filter").prepend(html).css('display', 'content');
    });
</script>
