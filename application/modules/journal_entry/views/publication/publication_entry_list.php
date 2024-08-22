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
            <li> <a href="javascript:void()" class="active"> <?= $module_name ?> </a></li>
            <li> <?= $meta_title; ?> </li>
        </ul>

        <div class="row">
            <div class="col-md-12">
                <div class="grid simple ">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
                        <div class="pull-right" style="display: flex;align-content: center;justify-content: center;flex-wrap: wrap;gap: 8px;">
                            <a href="<?= base_url('journal_entry/publication_entry_create') ?>" class="btn btn-blueviolet btn-xs btn-mini">বই এন্ট্রি</a>
                        </div>
                    </div>
                    <div class="grid-body tableresponsive">
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
                        <table class="table table-hover table-condensed data_table" border="0">
                            <thead style="background: #d2dee9;">
                                <tr>
                                    <th> ক্রম </th>
                                    <th style="display: none"></th>
                                    <th>এন্ট্রির তারিখ</th>
                                    <th>পরিমাণ</th>
                                    <th>ধরণ</th>
                                    <th>রেফারেন্স</th>
                                    <th style="text-align: right;">অ্যাকশন</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sl=$pagination['current_page']; foreach ($results as $row): $sl++; ?>
                                <tr>
                                    <td class="v-align-middle"><?=eng2bng($sl).'.'?></td>
                                    <td style="display: none" class="v-align-middle"><?= ($row->issue_date) ; ?></td>
                                    <td class="v-align-middle"><?= date_bangla_calender_format($row->issue_date) ; ?></td>
                                    <td class="v-align-middle"><?= eng2bng($row->amount); ?></td>
                                    <td class="v-align-middle">
                                    <?php
                                        if ($row->type == 1) {
                                        echo "<span>বই এন্ট্রি</span>";
                                        }elseif ($row->type == 2) {
                                        echo "<span>বই বিক্রয়</span>";
                                        }elseif ($row->type == 3) {
                                        echo "<span>কেজিতে বিক্রি</span>";
                                        }
                                    ?>
                                    </td>
                                    <td class="v-align-middle"><?=$row->reference; ?></td>
                                    <td align="right">
                                        <div class="btn-group">
                                            <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                                            <button class="btn btn-mini btn-primary dropdown-toggle"
                                                data-toggle="dropdown"> <span class="caret"></span> </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="<?php echo base_url('journal_entry/publication_entry_details/'.encrypt_url($row->id))?>"><i class="fa fa-pencil-square"></i> বিস্তারিত </a>
                                                </li>
                                                <?php if (date('Y-m-d') <= $row->created_at == date('Y-m-d')) { ?>
                                                    <li><a href="<?php echo base_url('journal_entry/publication_entry_delete/'.encrypt_url($row->id))?>"><i class="fa fa-pencil-square"></i>ডিলিট করুন</a></li>
                                                <?php } ?>

                                                    <!-- <li><a href="<?php echo base_url('journal_entry/publication_print/' . encrypt_url($row->id)) ?>" target="_blank"><i class="fa fa-pencil-square"target="_blank"></i> প্রিন্ট করুন</a>
                                                </li> -->

                                                    <!-- <li><a href="<?php echo base_url('journal_entry/chenge_status/publication/' . encrypt_url($row->id)) ?>"><i class="fa fa-pencil-square"></i> অ্যাপ্রুভ করুন</a></li> -->
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> সর্বমোট <span
                                    style="color: green; font-weight: bold;"><?php echo eng2bng($total_rows); ?>
                                    প্রকাশনা এন্ট্রি </span></div>
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
        <div class="col-md-9" style="display: flex;justify-content: space-around;">
            <div class="text-center" >
                Date Range
            </div>
            <div>
                <input type="date" id="min" onchange="filterDate()" class="form-control col-md-3 m-b-5"style="min-height: 25px;">
            </div>
            <div class="text-center" >
                to
            </div>
            <div >
                <input type="date" id="max" onchange="filterDate()" class="form-control col-md-3 m-b-5" style="min-height: 25px;">
            </div>
        </div>
        `
        $("#DataTables_Table_0_filter").prepend(html).css('display', 'content');
    });
</script>
