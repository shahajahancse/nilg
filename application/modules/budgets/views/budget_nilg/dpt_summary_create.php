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
                            <a href="<?= base_url('budgets/dpt_summary') ?>" class="btn btn-blueviolet btn-xs btn-mini">সামারী তাকিকা</a>
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
                        echo form_open_multipart("budgets/dpt_summary_create", $attributes);
                        echo validation_errors(); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row"
                                    style="padding: 15px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                                    <div>
                                        <span style="font-size: 22px;font-weight: bold;text-decoration: underline;">বাজেট সামারী করুন</span>
                                    </div>
                                </div>

                                <div class="row form-row">
                                    <style type="text/css">
                                        #appRowDiv td {
                                            padding: 5px !important;
                                            border-color: #ccc;
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
                                                    <!-- <th width="">স্থান</th> -->
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                            <?php foreach ($summary as $key => $data) { ?>
                                                <tr>
                                                    <th width=""><?= eng2bng($key + 1) ?></th>
                                                    <th colspan="8" width=""><?= $data->office ?></th>
                                                    <input type="hidden" name="office_type[]" value="<?= $data->office_type ?>">
                                                </tr>
                                                <?php
                                                    $this->db->select('q.*,ct.ct_name,course.course_title');
                                                    $this->db->from('budget_revenue_summary as q');
                                                    $this->db->join('course', 'q.course_id = course.id', 'left');
                                                    $this->db->join('course_type ct','ct.id=q.trainee_type','left');
                                                    $this->db->where_in('q.id', $ids)->where('q.office_type', $data->office_type);
                                                    $subs = $this->db->get()->result();
                                                ?>
                                                <?php foreach ($subs as $r => $sub) { ?>
                                                <tr>
                                                    <td style=""><?= eng2bng($key + 1) .'.'. eng2bng($r + 1) ?></td>
                                                    <input type="hidden" name="course_id[]" value="<?= $sub->course_id ?>">
                                                    <td style="font-size:12px; width:25%"><?= $sub->course_title ?></td>
                                                    <td style="font-size:12px; width:15%"><?= $sub->ct_name ?></td>
                                                    <td><input class="form-control input-sm" name="course_day[]" value="<?= $sub->course_day ?>"></td>
                                                    <td><input class="form-control input-sm" name="trainee_number[]" value="<?= $sub->trainee_number ?>"></td>
                                                    <td><input class="form-control input-sm" name="batch_number[]" value="<?= $sub->batch_number ?>"></td>
                                                    <td><input class="form-control input-sm" name="total_trainee[]" value="<?= $sub->total_trainee ?>"></td>
                                                    <td><input class="form-control input-sm" name="amount[]" value="<?= $sub->amount ?>"></td>
                                                    <!-- <td><?= $sub->title ?></td> -->
                                                </tr>
                                                <?php } ?>
                                            <?php } ?>
                                            </tbody>
                                        </table>
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

<script>
    function getHead(val) {
        var all_heads = <?php echo json_encode($heads); ?>;
        if (val == "") {
            return false;
        }
        var head = all_heads[val];
        addNewRow(head);
        disableOption(val);
    }

    function disableOption(value) {
        $('#head_id option[value="' + value + '"]').prop('disabled', true);
        $('#head_id').select2();
    }
</script>

<script>
    function addNewRow(data) {
        var tr = `<tr>
                <td>${data.name_bn}</td>
                <td style="text-align:center">${data.bd_code}</td>
                <td>
                <input type="hidden" name="head_sub_id[]" value="${data.id}" >
                <input value="0" min="0" type="number"  class="form-control input-sm" style="text-align:right" readonly>
                </td>
                <td><input type="number" name="dpt_amt[]" value="0" min="0" onkeyup="calculateTotal()"  class="form-control dpt_amt input-sm" style=" text-align:right"> </td>
                <td><a href="javascript:void(0)" onclick="removeRow(this)" class="btn btn-danger btn-sm" style="padding: 3px;"><i class="fa fa-times"></i> Remove</a></td>
                </tr>`
        $("#tbody").append(tr);
        $("#loading").hide();

    }
</script>
<script>
    function calculateTotal() {
        var total = 0;
        $(".dpt_amt").each(function() {
            total += parseInt($(this).val());
        })
        $("#total_amount").val(total);
    }
</script>
<script>
    function removeRow(row, id) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('budgets/budgets_nilg_remove_row') ?>",
            data: {
                id: id
            },
            success: function(data) {
                if (data == 1) {
                    $(row).closest("tr").remove();
                    calculateTotal()
                } else {
                    alert('Something went wrong. Please try again!');
                }
            },
        })
    }
</script>
<script>
    $(document).ready(function() {
        calculateTotal()
    })
</script>



<!-- <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .then(editor => {
            window.editor = editor;
        })
        .catch(error => {
            console.error(error);
        });
</script> -->
