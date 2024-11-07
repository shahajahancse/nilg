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
                        echo form_open_multipart("budgets/dpt_training_summary_create", $attributes);
                        echo validation_errors(); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row"
                                    style="padding: 15px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                                    <div>
                                        <span style="font-size: 22px;font-weight: bold;text-decoration: underline;">সামারী করুন</span>
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
                                                    <th width="">কোর্স নাম</th>
                                                    <th width="">প্রশিক্ষণার্থীর ধরন</th>
                                                    <th width="">মেয়াদ</th>
                                                    <th width="">প্রশিক্ষণার্থী</th>
                                                    <th width="">ব্যাচ সংখ্যা</th>
                                                    <th width="">মোট প্রশিক্ষণার্থী</th>
                                                    <th width="">প্রকল্পিত বায়</th>
                                                    <th width="">স্থান</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                            <input type="hidden" name="fcl_year" value="<?= $summary[0]->fcl_year ?>">
                                            <input type="hidden" name="update_ids" value="<?= implode(',', $ids) ?>">
                                            <?php $total = 0; foreach ($summary as $key => $data) { ?>
                                                <tr>
                                                    <th width=""><?= eng2bng($key + 1) ?></th>
                                                    <th colspan="8" width=""><?= $data->office ?></th>
                                                    <input type="hidden" name="office_type[]" value="<?= $data->office_type ?>">
                                                    <input type="hidden" name="office_amt[]" value="<?= $data->office_amt ?>" class="office_amt_<?= $data->office_type ?>">
                                                </tr>
                                                <?php
                                                    $this->db->select('q.*, SUM(q.amount) as amount, SUM(q.batch_number) as batch_number, course.course_title');
                                                    $this->db->from('budget_field as q');
                                                    $this->db->join('course', 'q.course_id = course.id', 'left');
                                                    $this->db->where_in('q.id', $ids)->where('q.office_type', $data->office_type);
                                                    $this->db->group_by('q.course_id')->group_by('q.course_day');
                                                    $subs = $this->db->get()->result();
                                                    // dd($subs);
                                                ?>
                                                <?php foreach ($subs as $r => $sub) {  ?>
                                                <tr>
                                                    <td style=""><?= eng2bng($key + 1) .'.'. eng2bng($r + 1) ?></td>
                                                    <input type="hidden" name="<?= $data->office_type ?>_course_id[]" value="<?= $sub->course_id ?>">
                                                    <input type="hidden" name="<?= $data->office_type ?>_trainee_type[]" value="<?= $sub->trainee_type ?>">
                                                    <td style="font-size:12px; width:25%"><?= $sub->course_title ?></td>
                                                    <td style="font-size:12px; width:15%"><?= $sub->trainee_type ?></td>
                                                    <td><input type="number" readonly class="form-control input-sm" name="<?= $data->office_type ?>_course_day[]" value="<?= $sub->course_day ?>"></td>
                                                    <td><input type="number" readonly class="form-control input-sm" name="<?= $data->office_type ?>_participants[]" value="<?= $sub->trainee_number ?>"></td>

                                                    <td><input type="number" readonly class="form-control input-sm" name="<?= $data->office_type ?>_batch_number[]" value="<?= $sub->batch_number ?>"></td>

                                                    <td><input type="number" readonly class="form-control input-sm" name="<?= $data->office_type ?>_total_participants[]" value="<?= $sub->batch_number * $sub->trainee_number ?>"></td>

                                                    <td><input onchange="calculateTotal(this, <?= $data->office_type ?>)" type="number" readonly class="form-control input-sm sub_<?= $data->office_type ?> amount" name="<?= $data->office_type ?>_amount[]" value="<?= $sub->amount ?>"></td>

                                                    <td><input readonly class="form-control input-sm" name="<?= $data->office_type ?>_location[]" value="<?= $sub->title ?>"></td>

                                                   <?php $total = $total + $sub->amount; ?>
                                                </tr>
                                                <?php } ?>
                                            <?php } ?>
                                            <tr>
                                                <td colspan="7">
                                                    <p><strong>কথায়:</strong> <span id="total_bangla">0</span> টাকা মাত্র</p>
                                                </td>
                                                <td><input type="number" id="total" class="form-control input-sm" name="total_amount" value="<?= $total ?>" readonly></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="col-md-12" style="padding: 0px;">
                                            <div class="form-group margin_top_10">
                                                <label for=""> নোট:</label>
                                                <textarea class="form-control" name="description"
                                                    style="height: 300px;"
                                                    id="description"><p></p><p></p></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <br><br> -->
                                    <!-- <div style='clear:both'></div> -->
                                    <div style='margin: 20px -6px;'>
                                        <div class="pull-right">
                                            <input type="submit" name="save" value="সংরক্ষণ করুন" class="btn btn-primary btn-cons">
                                            <!-- <input type="submit" name="submit" value="ফরওয়ার্ড করুন" class="btn btn-primary btn-cons"> -->
                                        </div>
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
