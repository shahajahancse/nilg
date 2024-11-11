<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<style>
    .chosen-single {
        height: 30px !important;
        border: 1px solid #00a59a !important;
    }

    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }

    .page-content .content {
        padding-left: 10px !important;
        padding-right: 10px !important;;
    }
</style>
<div class="page-content">
    <div class="content">
        <ul class="breadcrumb">
            <li><a href="<?= base_url('dashboard') ?>" class="active"> Dashboard </a></li>
            <li><a href="<?= base_url('budgets/revenue_summary_list') ?>" class="active"><?= $module_name ?></a></li>
            <li><?= $meta_title; ?></li>
        </ul>

        <div class="row">
            <div class="col-md-12">
                <div class="grid simple horizontal red">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
                        <div class="pull-right">
                            <a href="<?= base_url('budgets/dpt_summary_rev') ?>" class="btn btn-blueviolet btn-xs btn-mini">সামারী তালিকা</a>
                        </div>
                    </div>
                    <div class="grid-body">
                        <?php if ($this->session->flashdata('success')) : ?>
                            <div class="alert alert-success">
                                <?= $this->session->flashdata('success');; ?>
                            </div>
                        <?php endif; ?> <?php if ($this->session->flashdata('error')) : ?>
                            <div class="alert alert-danger">
                                <?= $this->session->flashdata('error');; ?>
                            </div>
                        <?php endif; ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row"
                                    style="padding: 15px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                                    <div>
                                        <span style="font-size: 22px;font-weight: bold;text-decoration: underline;">বাজেট সামারী </span>
                                    </div>
                                </div>

                                <div class="row form-row">
                                    <style type="text/css">
                                        #appRowDiv td {
                                            padding: 5px !important;
                                            border-color: #ccc;
                                        }
                                        .form-row input, .form-row select, .form-row textarea, .form-row select2 {
                                            margin-bottom: 0px !important;
                                        }

                                        #appRowDiv th {
                                            padding: 5px;
                                            text-align: left;
                                            border-color: #ccc;
                                            color: black;
                                        }
                                    </style>

                                    <!-- head list -->
                                    <div class=" table-responsive">
                                        <table class="table table-hover table-condensed"  border="1"
                                            style="border:1px solid #a09e9e; margin-top: 10px;" id="appRowDiv">
                                            <thead>
                                                <tr>
                                                    <th width="">নং</th>
                                                    <th width="20%">বাজেট শিরোনাম </th>
                                                    <th width="">বাজেট কোড</th>
                                                    <th width="">বাজেট পরিমাণ</th>
                                                    <!-- <th width="">প্রাক্কলন পরিমাণ</th> -->
                                                    <th width="">প্রথম পরিমাণ</th>
                                                    <th width="">দ্বিতীয় পরিমাণ</th>
                                                    <th width="">তৃতীয় পরিমাণ</th>
                                                    <th width="">চার পরিমাণ</th>
                                                    <th width=""> পরিমাণ</th>
                                                </tr>
                                            </thead>

                                            <tbody id="tbody">
                                                <?php  $i=0; foreach ($summary as $value) :  $i++;  ?>
                                                <tr>
                                                    <td><?= eng2bng($i); ?></td>
                                                    <td><?= $value->name_bn; ?></td>
                                                    <td><?= $value->bd_code; ?></td>
                                                    <td><?= eng2bng($value->budget_amt); ?></td>
                                                    <!-- <td><?= eng2bng($value->prak_amt); ?></td> -->
                                                    <td><?= eng2bng($value->first_amt); ?></td>
                                                    <td><?= eng2bng($value->second_amt); ?></td>
                                                    <td><?= eng2bng($value->third_amt); ?></td>
                                                    <td><?= eng2bng($value->fou_amt); ?></td>
                                                    <td><?= eng2bng($value->first_amt +$value->second_amt + $value->third_amt+ $value->fou_amt); ?></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- END GRID BODY -->
                </div> <!-- END GRID -->
            </div>
        </div> <!-- END ROW -->
    </div>
</div>

\
