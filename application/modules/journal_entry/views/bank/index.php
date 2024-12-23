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
                        <div class="pull-right"
                            style="display: flex;align-content: center;justify-content: center;flex-wrap: wrap;gap: 8px;">
                            <a href="<?= base_url('journal_entry/bank_entry_create') ?>"
                                class="btn btn-blueviolet btn-xs btn-mini">ব্যাংক তৈরি করুণ</a>
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

                        <!-- <div class="row" style="margin-bottom: 10px;">

                        </div> -->

                        <div class="table-responsive">
                            <table class="table table-hover table-condensed data_table" border="0">
                                <thead>
                                    <tr>
                                        <th> ক্রম </th>
                                        <th>ব্যাংক নং</th>
                                        <th>পরিমাণ</th>
                                        <th>প্রদানের তারিখ</th>
                                        <th>ধরণ</th>
                                        <th>স্ট্যাটাস</th>
                                        <th>রেফারেন্স</th>
                                        <!-- <th>বর্ণনা</th> -->
                                        <th style="text-align: right;">অ্যাকশন</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sl = $pagination['current_page'];
                                    foreach ($results as $row): $sl++; ?>
                                        <tr>
                                            <td class="v-align-middle"><?= $sl . '.' ?></td>
                                            <td class="v-align-middle">
                                                <?= isset($row->bank_no) ? $row->bank_no : $row->voucher_no; ?></td>
                                            <td class="v-align-middle"><?= $row->amount; ?></td>
                                            <td class="v-align-middle"><?= $row->issue_date; ?></td>
                                            <?php if ($row->type == 1) {
                                                $type = '<span class="label label-success">Cash Deposit</span></span>';
                                            } elseif ($row->type == 2) {
                                                $type = '<span class="label label-success">Payment Voucher</span></span>';
                                            } else {
                                                $type = '<span class="label label-success">Adjuestment Voucher</span></span>';
                                            } ?>
                                            <td class="v-align-middle"><?= $type; ?></td>
                                            <?php if ($row->status == 1) {
                                                $type = '<span class="label label-success">পেন্ডিং</span>';
                                            } else {
                                                $type = '<span class="label label-success">অনুমোদিত</span>';
                                            } ?>
                                            <td class="v-align-middle"><?= $type; ?></td>
                                            <td class="v-align-middle"><?= $row->reference; ?></td>
                                            <td align="right">
                                                <div class="btn-group">
                                                    <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                                                    <button class="btn btn-mini btn-primary dropdown-toggle"
                                                        data-toggle="dropdown"> <span class="caret"></span> </button>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li><a
                                                                href="<?php echo base_url('journal_entry/bank_entry_details/' . encrypt_url($row->id)) ?>"><i
                                                                    class="fa fa-pencil-square"></i> বিস্তারিত </a></li>
                                                        <li><a
                                                                href="<?php echo base_url('journal_entry/bank_entry_edit/' . encrypt_url($row->id)) ?>"><i
                                                                    class="fa fa-pencil-square"></i> সংশোধন করুন </a></li>
                                                        <li><a
                                                                href="<?php echo base_url('journal_entry/bank_entry_delete/' . encrypt_url($row->id)) ?>"><i
                                                                    class="fa fa-pencil-square"></i>ডিলিট করুন</a></li>
                                                        <li><a
                                                                href="<?php echo base_url('journal_entry/print_singal/bank/' . encrypt_url($row->id)) ?>" target="_blank"><i
                                                                    class="fa fa-pencil-square"></i> প্রিন্ট করুন</a></li>

                                                        <?php if ($row->status == 1 && $this->ion_auth->in_group(array('admin', 'nilg', 'acc'))) { ?>
                                                            <li><a
                                                                    href="<?php echo base_url('journal_entry/chenge_status/bank/' . encrypt_url($row->id)) ?>"><i
                                                                        class="fa fa-pencil-square"></i> অ্যাপ্রুভ করুন</a></li>
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
                                    ব্যাংক </span></div>
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
        <div class="col-md-6" style="display: flex;justify-content: space-around;">
            <div class="text-center" >
                Date Range
            </div>
            <div>
                <input type="date" id="min" onchange="filterDate()" class="form-control"style="min-height: 25px;">
            </div>
            <div class="text-center" >
                to
            </div>
            <div >
                <input type="date" id="max" onchange="filterDate()" class="form-control" style="min-height: 25px;">
            </div>
        </div>
        `
        $("#DataTables_Table_0_filter").prepend(html).css('display', 'content');
    });
</script>
