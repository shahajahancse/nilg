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
            <li><a class="active"><?= $module_name ?></a></li>
            <li><?= $meta_title; ?></li>
        </ul>

        <div class="row">
            <div class="col-md-12">
                <div class="grid simple horizontal red">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
                        <div class="pull-right">
                            <a href="<?= base_url('budgets/dpt_summary_training') ?>" class="btn btn-blueviolet btn-xs btn-mini">সামারী তাকিকা</a>
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

                        <?php $attributes = array('id' => 'jsvalidate');
                        echo form_open_multipart(current_url(), $attributes); echo validation_errors(); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row"
                                    style="padding: 15px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                                    <div>
                                        <span style="font-size: 22px;font-weight: bold;text-decoration: underline;"><?= $meta_title ?></span>
                                    </div>
                                </div>

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

                                <div class=" table-responsive">
                                    <table class="table table-hover table-condensed"  border="1"
                                        style="border:1px solid #a09e9e; margin-top: 10px;" id="appRowDiv">
                                        <tr>
                                            <th width="">নং</th>
                                            <th width="">কোর্স নাম</th>
                                            <th width="">প্রশিক্ষণার্থীর ধরন</th>
                                            <th width="">মেয়াদ</th>
                                            <th width="">প্রশিক্ষণার্থী</th>
                                            <th width="">ব্যাচ সংখ্যা</th>
                                            <th width="">মোট প্রশিক্ষণার্থী</th>
                                            <th width="">প্রকল্পিত বায়</th>
                                            <th width="">স্থান</th>
                                        </tr>
                                        <?php $total = 0; foreach ($summary as $key => $data) { ?>
                                            <tr class="text-shadow">
                                                <th style="text-align:center"><?= eng2bng($key + 1) ?></th>
                                                <th colspan="8"><?= $data->office ?></th>
                                            </tr>
                                            <?php
                                                $this->db->select('q.*, course.course_title');
                                                $this->db->from('budget_nilg_sub_details as q');
                                                $this->db->join('course', 'q.head_sub_id = course.id', 'left');
                                                $this->db->where('q.rev_sum_details', $data->id);
                                                $subs = $this->db->get()->result();
                                            ?>
                                            <?php foreach ($subs as $r => $sub) { ?>
                                            <tr>
                                                <td style="text-align:center"><?= eng2bng($key + 1) .'.'. eng2bng($r + 1) ?></td>
                                                <td style="font-size:12px; text-align:left"><?= $sub->course_title ?></td>
                                                <td style="font-size:12px; text-align:left"><?= $sub->trainee_type ?></td>
                                                <td><?= eng2bng($sub->days) ?></td>
                                                <td><?= eng2bng($sub->participants) ?></td>
                                                <td><?= eng2bng($sub->batch) ?></td>
                                                <td><?= eng2bng($sub->total_participants) ?></td>
                                                <td style="text-align:right; width: 7%;"><?= eng2bng($sub->amount) ?></td>
                                                <td><?= $sub->training_area ? $sub->training_area : '-' ?></td>
                                            </tr>
                                            <?php $total += $sub->amount; } ?>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="7">
                                                <p><strong>কথায়:</strong> <span id="total_bangla">0</span> টাকা মাত্র</p>
                                            </td>
                                            <td><input type="number" id="total" class="form-control input-sm" name="total_amount" value="<?= $total ?>" readonly></td>
                                        </tr>
                                    </table>
                                    <div class="col-md-12" style="padding: 0px;">
                                        <div class="form-group margin_top_10">
                                            <label for=""> নোট:</label>
                                            <textarea class="form-control" name="description" style="height: 300px;" id="description"> <?= $info->description ?> </textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="check" value="1">

                                <div style='margin: 20px -6px;'>
                                    <div class="pull-right">
                                        <input type="submit" name="save" value="সংরক্ষণ করুন" class="btn btn-primary btn-cons">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div> <!-- END GRID BODY -->
                </div> <!-- END GRID -->
            </div>
        </div> <!-- END ROW -->
    </div>
</div>

<script src="<?= base_url('assets/js/bangla_converter.js'); ?>"></script>
<script>
    $(document).ready(function() {
        total = $("#total").val();
        $("#total_bangla").html(generateWords(total));
    });
</script>

<script>
    function calculateTotal(el, id) {
        var office_amt = 0;
        $(".sub_"+id).each(function() {
            var amt = parseInt($(this).val());
            if (isNaN(amt) === false) {
                office_amt = amt + office_amt;
            }
        })
        $(".office_amt_"+id).val(office_amt);

        var total = 0;
        $(".amount").each(function() {
            var amount = parseInt($(this).val());
            if (isNaN(amount) === false) {
                total += amount;
            }
        })
        $("#total").val(total);
        $("#total_bangla").html(generateWords(total));
    }
</script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#description')).then(editor => {window.editor = editor;}).catch(error => {console.error(error);});
</script>
