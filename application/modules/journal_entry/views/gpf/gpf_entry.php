<div class="page-content">
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
                        <div class="pull-right" style="display: flex;align-content: center;justify-content: center;flex-wrap: wrap;gap: 8px;">
                            <a href="<?= base_url('journal_entry/gpf_create') ?>" class="btn btn-blueviolet btn-xs btn-mini">তৈরি করুণ</a>
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
                        <div class="table-responsive">
                            <table class="table table-hover table-condensed data_table" border="0">
                                <thead>
                                    <tr>
                                        <th>ক্রম</th>
                                        <th>কর্মকর্তা/কর্মচারী নাম</th>
                                        <th>পদবী</th>
                                        <th>সামগ্রিক চাঁদা</th>
                                        <th>অগ্রীম আদায়</th>
                                        <th>অগ্রীম উত্তোলন</th>
                                        <th>মাসিক জের</th>
                                        <th>তারিখ</th>
                                        <th style="text-align: right;">অ্যাকশন</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sl = $pagination['current_page'];
                                    foreach ($results as $row): $sl++; ?>
                                        <tr>
                                            <td class="v-align-middle"><?= $sl . '.' ?></td>
                                            <td class="v-align-middle"><?= $row->name_bn; ?></td>
                                            <td class="v-align-middle"><?= $row->desig_name; ?></td>
                                            <td class="v-align-middle"><?= eng2bng($row->curr_amt); ?></td>
                                            <td class="v-align-middle"><?= eng2bng($row->adv_amt); ?></td>
                                            <td class="v-align-middle"><?= eng2bng($row->adv_withdraw); ?></td>
                                            <td class="v-align-middle"><?= eng2bng($row->balance); ?></td>
                                            <td class="v-align-middle"><?= date_bangla_calender_format($row->date); ?></td>
                                            <td align="right">
                                                <div class="btn-group">
                                                    <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                                                    <button class="btn btn-mini btn-primary dropdown-toggle"
                                                        data-toggle="dropdown"> <span class="caret"></span> </button>
                                                    <ul class="dropdown-menu pull-right">
                                                        <!-- <li><a href="<?php echo base_url('journal_entry/gpf_entry_details/' . encrypt_url($row->id)) ?>"><i class="fa fa-pencil-square"></i> বিস্তারিত </a></li> -->

                                                        <li><a href="<?php echo base_url('journal_entry/gpf_edit/' . encrypt_url($row->id)) ?>"><i class="fa fa-pencil-square"></i> সংশোধন করুন </a></li>

                                                        <!-- <li><a href="<?php echo base_url('journal_entry/print_singal/gpf/' . encrypt_url($row->id)) ?>" target="_blank"><i class="fa fa-pencil-square"></i> প্রিন্ট করুন</a></li> -->
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
                                    জিপিএফ </span></div>
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
        // $("#DataTables_Table_0_filter").prepend(html).css('display', 'content');
    });
</script>
