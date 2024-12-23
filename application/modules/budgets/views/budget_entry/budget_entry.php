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
            <li> <a href="javascript:void()" class="active"> <?= $module_name ?> </a> </li>
            <li> <?= $meta_title; ?> </li>
        </ul>
        <?php
        // dd($module_name,$meta_title,$results);
        ?>


        <div class="row">
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
                        <div class="pull-right">
                            <a href="<?= base_url('budgets/budget_entry_create') ?>"
                                class="btn btn-blueviolet btn-xs btn-mini">বাজেট তৈরি করুণ</a>
                        </div>
                    </div>
                    <div class="grid-body tableresponsive">
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success">
                                <?= $this->session->flashdata('success'); ?>
                            </div>
                        <?php endif; ?>
                        <table class="table table-hover table-condensed data_table" border="0">
                            <thead>
                                <tr>
                                    <th> ক্রম </th>
                                    <th>নাম</th>
                                    <th>পরিমাণ</th>
                                    <th>অর্থবছর</th>
                                    <th>টাইপ</th>
                                    <th>তারিখ</th>
                                    <th style="text-align: right;">অ্যাকশন</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sl = $pagination['current_page'];
                                foreach ($results as $row):
                                    $sl++;
                                ?>
                                    <tr>
                                        <td class="v-align-middle"><?= $sl . '.' ?></td>
                                        <td class="v-align-middle"><?= $row->title; ?></td>
                                        <td class="v-align-middle"><?= $row->amount; ?></td>
                                        <td class="v-align-middle"><?= $row->session_name; ?></td>
                                        <td class="v-align-middle">
                                            <!-- 1=revenue, 2=auditorium, 3=library, 4=publication, 5=others	 -->
                                            <?php
                                            if ($row->type == 1) {
                                                echo 'Revenue';
                                            } elseif ($row->type == 2) {
                                                echo 'Auditorium';
                                            } elseif ($row->type == 3) {
                                                echo 'Library';
                                            } elseif ($row->type == 4) {
                                                echo 'Publication';
                                            } elseif ($row->type == 5) {
                                                echo 'Others';
                                            }
                                            ?>
                                        </td>
                                        <td class="v-align-middle"><?= date_bangla_calender_format($row->created_at); ?>
                                        </td>
                                        <td align="right">
                                            <div class="btn-group">
                                                <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                                                <button class="btn btn-mini btn-primary dropdown-toggle"
                                                    data-toggle="dropdown"> <span class="caret"></span> </button>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a
                                                            href="<?php echo base_url('budgets/budget_entry_details/' . encrypt_url($row->id)) ?>"><i
                                                                class="fa fa-pencil-square"></i> বিস্তারিত </a></li>
                                                    <li><a href="<?php echo base_url('budgets/budget_entry_print/' . encrypt_url($row->id)) ?>"
                                                            target="_blank"><i class="fa fa-pencil-square"></i> প্রিন্ট </a>
                                                    </li>
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
                                    ডাটা </span></div>
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