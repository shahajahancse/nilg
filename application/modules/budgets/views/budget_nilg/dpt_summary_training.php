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
                            <?php if ($this->ion_auth->in_group(array('admin', 'ad'))) { ?>
                                <a href="<?= base_url('budgets/dpt_training_budgets') ?>" class="btn btn-blueviolet btn-xs btn-mini">সামারী তৈরি করুণ</a>
                            <?php }  ?>
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
                            .mddd > tbody > tr > td:first-child {
                                width: 7% !important;
                            }
                            .table > thead > tr > th {
                                border-bottom: 0px;
                                padding: 2px !important;
                            }
                            .mddd > thead > tr > th:first-child {
                                width: 10% !important;
                            }
                        </style>

                        <div class="table-responsive">
                            <table class="table table-hover table-condensed data_table mddd" border="0">
                                <thead>
                                    <tr>
                                        <th style="width: 10% !important"> ক্রম </th>
                                        <th>নাম</th>
                                        <th>বিভাগ</th>
                                        <th>তারিখ</th>
                                        <th>অর্থবছর</th>
                                        <th>পরিমাণ</th>
                                        <!-- <th>রাজস্ব পরিমাণ</th> -->
                                        <th>স্ট্যাটাস</th>
                                        <th style="text-align: right;">অ্যাকশন</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($summary as $sl => $row):
                                        if (in_array($row->status,[7,9,10,11,12]) && $this->ion_auth->in_group(array('ad'))) {
                                            $bg = "background: #f1e7e7";
                                        } elseif (in_array($row->status,[2,13,14,15]) && $this->ion_auth->in_group(array('dd'))) {
                                            $bg = "background: #f1e7e7";
                                        } elseif (in_array($row->status,[3,16,17]) && $this->ion_auth->in_group(array('jd'))) {
                                            $bg = "background: #f1e7e7";
                                        } elseif (in_array($row->status,[4,18])&& $this->ion_auth->in_group(array('director'))) {
                                            $bg = "background: #f1e7e7";
                                        } elseif ($row->status == 5 && $this->ion_auth->in_group(array('dg'))) {
                                            $bg = "background: #f1e7e7";
                                        } elseif ($row->status == 6 && $this->ion_auth->in_group(array('acc'))) {
                                            $bg = "background: #f1e7e7";
                                        } else {
                                            $bg = "background: #fff";
                                        } ?>

                                        <tr style="<?= $bg ?>">
                                            <td style=""><?= eng2bng($sl + 1); ?></td>
                                            <td class="v-align-middle"><?= $row->name_bn; ?></td>
                                            <td class="v-align-middle"><?= $row->dept_name; ?></td>
                                            <td class="v-align-middle"><?= date_bangla_calender_format($row->created_at); ?></td>
                                            <td class="v-align-middle"><?= $row->session_name; ?></td>
                                            <td class="v-align-middle"><?= eng2bng($row->amount); ?></td>
                                            <!-- <td class="v-align-middle"><?= eng2bng($row->revenue_amt); ?></td> -->
                                            <td class="v-align-middle">
                                                <?php switch ($row->status) {
                                                    case 1:
                                                        echo '<span class="label label-info">Draft </span>';
                                                        break;
                                                    case 2:
                                                        echo '<span class="label label-info"> On Precess </span>';
                                                        break;
                                                    case 3:
                                                        echo '<span class="label label-primary"> DD Approve </span>';
                                                        break;
                                                    case 4:
                                                        echo '<span class="label label-primary"> JD Approve </span>';
                                                        break;
                                                    case 5:
                                                        echo '<span class="label label-primary"> Director Approve </span>';
                                                        break;
                                                    case 6:
                                                        echo '<span class="label label-primary"> DG Approve </span>';
                                                        break;
                                                    case 7:
                                                        echo '<span class="label label-primary"> AC Approve </span>';
                                                        break;
                                                    case 8:
                                                        echo '<span class="label label-primary"> Complete </span>';
                                                        break;
                                                    case 9:
                                                        echo '<span class="label label-primary"> Back AD from DD </span>';
                                                        break;
                                                    case 10:
                                                        echo '<span class="label label-primary"> Back AD from JD </span>';
                                                        break;
                                                    case 11:
                                                        echo '<span class="label label-primary"> Back AD from Director </span>';
                                                        break;
                                                    case 12:
                                                        echo '<span class="label label-primary"> Back AD from DG </span>';
                                                        break;
                                                    case 13:
                                                        echo '<span class="label label-primary"> Back DD from JD </span>';
                                                        break;
                                                    case 14:
                                                        echo '<span class="label label-primary"> Back DD from Director </span>';
                                                        break;
                                                    case 15:
                                                        echo '<span class="label label-primary"> Back DD from DG </span>';
                                                        break;
                                                    case 16:
                                                        echo '<span class="label label-primary"> Back JD from Director </span>';
                                                        break;
                                                    case 17:
                                                        echo '<span class="label label-primary"> Back JD from DG </span>';
                                                        break;
                                                    case 18:
                                                        echo '<span class="label label-primary"> Back Director from DG </span>';
                                                        break;
                                                    default:
                                                        echo '<span class="label label-primary"> </span>';
                                                        break;
                                                } ?>
                                            </td>

                                            <td align="right">
                                                <div class="btn-group">
                                                    <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                                                    <button class="btn btn-mini btn-primary dropdown-toggle"
                                                        data-toggle="dropdown"> <span class="caret"></span> </button>
                                                    <ul class="dropdown-menu pull-right">
                                                         <?php if (!$this->ion_auth->in_group(array('acc'))) { ?>
                                                        <!-- <li><a href="<?php echo base_url('budgets/dpt_training_summary_edit/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> সংশোধন করুন </a></li> -->
                                                        <?php } ?>

                                                        <!-- ad -->
                                                        <?php if (in_array($row->status,[1,9,10,11,12]) && $this->ion_auth->in_group(array('ad'))) { ?>

                                                            <li><a href="<?php echo base_url('budgets/dpt_training_summary_edit/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> সংশোধন করুন </a></li>

                                                            <li> <a href="<?php echo base_url('budgets/training_summary_forward/2/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ফরওয়ার্ড টু ডি.ডি </a> </li>
                                                            <li> <a href="<?php echo base_url('budgets/training_summary_forward/3/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ফরওয়ার্ড টু জে.ডি </a> </li>
                                                            <li> <a href="<?php echo base_url('budgets/training_summary_forward/4/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ফরওয়ার্ড টু ডিরেক্টর </a> </li>
                                                        <?php } ?>
                                                        <?php if (in_array($row->status,[2]) && $this->ion_auth->in_group(array('ad'))) { ?>
                                                            <li> <a href="<?php echo base_url('budgets/training_summary_forward/1/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক </a> </li>
                                                        <?php } ?>

                                                        <!-- dd -->
                                                        <?php if (in_array($row->status,[2,13,14,15]) && $this->ion_auth->in_group(array('dd'))) {?>

                                                            <li><a href="<?php echo base_url('budgets/dpt_training_summary_edit/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> সংশোধন করুন </a></li>

                                                            <li> <a href="<?php echo base_url('budgets/training_summary_forward/3/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> অনুমোদন এবং ফরওয়ার্ড জে.ডি </a> </li>
                                                            <li> <a href="<?php echo base_url('budgets/training_summary_forward/4/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> অনুমোদন এবং ফরওয়ার্ড ডিরেক্টর </a> </li>
                                                            <li> <a href="<?php echo base_url('budgets/training_summary_forward/5/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> অনুমোদন এবং ফরওয়ার্ড ডি.জি </a> </li>
                                                            <li> <a href="<?php echo base_url('budgets/training_summary_forward/9/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক এ.ডি </a> </li>
                                                        <?php }?>
                                                        <?php if (in_array($row->status,[3]) && $this->ion_auth->in_group(array('dd'))) { ?>
                                                            <li> <a href="<?php echo base_url('budgets/training_summary_forward/2/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক </a> </li>
                                                        <?php } ?>

                                                        <!-- jd -->
                                                        <?php if (in_array($row->status,[3,16,17]) && $this->ion_auth->in_group(array('jd'))) {?>

                                                            <li><a href="<?php echo base_url('budgets/dpt_training_summary_edit/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> সংশোধন করুন </a></li>

                                                            <li> <a href="<?php echo base_url('budgets/training_summary_forward/4/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> অনুমোদন এবং ফরওয়ার্ড ডিরেক্টর </a> </li>
                                                            <li> <a href="<?php echo base_url('budgets/training_summary_forward/5/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> অনুমোদন এবং ফরওয়ার্ড ডি.জি </a> </li>
                                                            <li> <a href="<?php echo base_url('budgets/training_summary_forward/10/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক এ.ডি </a> </li>
                                                            <li> <a href="<?php echo base_url('budgets/training_summary_forward/13/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক ডি.ডি </a> </li>
                                                        <?php }?>
                                                        <?php if (in_array($row->status,[4]) && $this->ion_auth->in_group(array('jd'))) { ?>
                                                            <li> <a href="<?php echo base_url('budgets/training_summary_forward/3/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক </a> </li>
                                                        <?php } ?>

                                                        <!-- director -->
                                                        <?php if (in_array($row->status,[4,18]) && $this->ion_auth->in_group(array('director'))) {?>

                                                            <li><a href="<?php echo base_url('budgets/dpt_training_summary_edit/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> সংশোধন করুন </a></li>

                                                            <li> <a href="<?php echo base_url('budgets/training_summary_forward/5/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> অনুমোদন এবং ফরওয়ার্ড ডি.জি </a> </li>
                                                            <li> <a href="<?php echo base_url('budgets/training_summary_forward/11/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক এ.ডি </a> </li>
                                                            <li> <a href="<?php echo base_url('budgets/training_summary_forward/14/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক ডি.ডি </a> </li>
                                                            <li> <a href="<?php echo base_url('budgets/training_summary_forward/16/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক জে.ডি </a> </li>
                                                        <?php }?>
                                                        <?php if (in_array($row->status,[5]) && $this->ion_auth->in_group(array('director'))) { ?>
                                                            <li> <a href="<?php echo base_url('budgets/training_summary_forward/4/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক </a> </li>
                                                        <?php } ?>

                                                        <!-- dg -->
                                                        <?php if (in_array($row->status,[5]) && $this->ion_auth->in_group(array('dg'))) {?>

                                                            <li><a href="<?php echo base_url('budgets/dpt_training_summary_edit/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> সংশোধন করুন </a></li>
                                                            
                                                            <li> <a href="<?php echo base_url('budgets/training_summary_forward/6/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> অনুমোদন এবং ফরওয়ার্ড </a> </li>

                                                            <li> <a href="<?php echo base_url('budgets/training_summary_forward/12/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক এ.ডি </a> </li>
                                                            <li> <a href="<?php echo base_url('budgets/training_summary_forward/15/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক ডি.ডি </a> </li>
                                                            <li> <a href="<?php echo base_url('budgets/training_summary_forward/17/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক জে.ডি </a> </li>
                                                            <li> <a href="<?php echo base_url('budgets/training_summary_forward/18/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক ডিরেক্টর </a> </li>
                                                        <?php }?>

                                                        <!-- acc -->
                                                        <?php if (in_array($row->status,[6]) && $this->ion_auth->in_group(array('acc'))) {?>
                                                            <li> <a href="<?php echo base_url('budgets/training_summary_forward/7/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> অনুমোদন এবং ফরওয়ার্ড </a> </li>
                                                        <?php }?>

                                                        <?php if (in_array($row->status,[7]) && $this->ion_auth->in_group(array('ad'))) { ?>
                                                            <li> <a href="<?php echo base_url('budgets/training_summary_forward/8/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> পাবলিশ </a> </li>
                                                        <?php } ?>

                                                        <li> <a href="<?php echo base_url('budgets/dpt_training_summary_print/' . encrypt_url($row->id)) ?>"   target="_blank"> <i class="fa fa-pencil-square"></i> প্রিন্ট করুন </a> </li>

                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- END Content -->
</div>



