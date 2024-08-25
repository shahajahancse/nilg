<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<style>
    .chosen-single {
        height: 30px !important;
        border: 1px solid #00a59a !important;
    }

    #loading {
        display: none;
        position: absolute;
        height: 100%;
        width: 100%;
        background: #0000001f;
        z-index: 999999;
        align-content: center;
        flex-wrap: wrap;
        justify-content: center;
    }
</style>

<div class="page-content">

    <div class="content">
        <ul class="breadcrumb">
            <li><a href="<?= base_url('dashboard') ?>" class="active"> Dashboard </a></li>
            <li><a href="<?= base_url('budget/budget_nilg_create') ?>" class="active"><?= $module_name ?></a></li>
            <li><?= $meta_title; ?></li>
        </ul>

        <div class="row">
            <div class="col-md-12">
                <div class="grid simple horizontal red">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
                        <div class="pull-right">
                            <a href="<?= base_url('budgets/budget_nilg') ?>"
                                class="btn btn-blueviolet btn-xs btn-mini">বাজেট তাকিকা</a>
                        </div>
                    </div>
                    <div class="grid-body">
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success">
                                <?= $this->session->flashdata('success');; ?>
                            </div>
                        <?php endif; ?> <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= $this->session->flashdata('error');; ?>
                            </div>
                        <?php endif; ?>

                        <?php
                        $attributes = array('id' => 'jsvalidate');
                        echo form_open_multipart("budgets/budget_field_create", $attributes);
                        echo validation_errors(); ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div id="loading">
                                    <img src="<?= base_url('img/loading.gif') ?>" width="100" alt="">
                                </div>
                                <fieldset style="background: #fff !important;">
                                    <div class="col-md-12"
                                        style="padding: 20px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                                        <div>
                                            <span
                                                style="font-size: 22px;font-weight: bold;text-decoration: underline;">বাজেট
                                                তৈরি করুন</span>
                                        </div>
                                        <div style="position: absolute;right: 0;font-size: large;font-weight: bold;">
                                            <p>অবশিষ্ট পরিমাণ <span>
                                                    <?php
                                                    $budgets = $this->db->select('SUM(revenue_amt) as amount')->get('budget_nilg')->row();
                                                    $in_amount = $this->Common_model->all_journal_amount('revenue');
                                                    $this->db->select_sum('total_overall_expense');
                                                    $this->db->from('budget_field');
                                                    $this->db->where('status', 1);

                                                    $out_amount = $this->db->get()->row()->total_overall_expense;
                                                    $a = $in_amount - $out_amount;
                                                    if ($a < 0) {
                                                        echo '<span style="color:red;">' . $a . '</span>';
                                                    } else {
                                                        echo $a;
                                                    }
                                                    ?>
                                                </span> </p>
                                        </div>
                                    </div>

                                    <div class="row form-row" style="font-size: 16px; color: black;">
                                        <div class="col-md-12" style="display: flex;gap: 74px; padding-bottom: 7px;">
                                            <div class="col-md-4">
                                                আবেদনকারীর নাম: <strong><?= $info->name_bn ?></strong>
                                            </div>

                                            <div class="col-md-4">
                                                পদবীর নাম: <strong><?= $info->current_desig_name ?></strong>
                                            </div>
                                            <div class="col-md-4">
                                                ডিপার্টমেন্ট নাম: <strong><?= $info->current_dept_name ?></strong>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-md-3">
                                            <label for="title" class="control-label">শিরোনাম : </label>
                                            <input type="text" class="form-control input-sm" name="title"
                                                style="min-height: 33px;" value="" required>
                                        </div>
                                        <div class="col-md-2">
                                            <?php $session_year = $this->db->order_by('id', 'desc')->get('session_year')->result(); ?>
                                            <label for="fcl_year" class="control-label">অর্থবছর</label>
                                            <select name="fcl_year" id="fcl_year" class="form-control input-sm"
                                                required>
                                                <option value="">নির্বাচন করুন</option>
                                                <?php foreach ($session_year as $key => $value) {
                                                    echo '<option value="' . $value->id . '">' . $value->session_name . '</option>';
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <?php $session_year = $this->db->get('office_type')->result(); ?>
                                            <label for="office_type" class="control-label">অফিস ধরণ</label>
                                            <select onchange="getofficeid(this.value)" name="office_type"
                                                id="office_type" class="form-control input-sm" required>
                                                <option value="">নির্বাচন করুন</option>
                                                <?php foreach ($session_year as $key => $value) {
                                                    echo '<option value="' . $value->id . '">' . $value->office_type_name . '</option>';
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="office_id" class="control-label">অফিস</label>
                                            <select name="office_id" id="office_id" class="form-control input-sm"
                                                required>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="payment_for" class="control-label">বিষয়</label>
                                            <select name="payment_for" id="payment_for" class="form-control input-sm"
                                                required>
                                                <option value="">নির্বাচন করুন</option>
                                                <option value=1>ট্রেইনিং</option>
                                                <option value=2>হোস্টেল</option>
                                                <option value=3>প্রকাশনা</option>
                                                <option value=4>অডিটোরিয়াম</option>
                                                <option value=5>Others</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row form-row">
                                        <div class="col-md-12">

                                        </div>
                                        <style type="text/css">
                                            #appRowDiv td {
                                                padding: 5px;
                                                border-color: #ccc;
                                            }

                                            #appRowDiv th {
                                                padding: 5px;
                                                text-align: center;
                                                border-color: #ccc;
                                                color: black;
                                            }
                                        </style>
                                        <div class="col-md-12">
                                            <div class="col-md-12" style="margin:0px;padding:0px">
                                                <div class="col-md-4 margin_top_10 " style="margin:0px;padding:0px">
                                                    <label for="">বাজেট হেড নির্বাচন করুন</label>
                                                    <select name="head" id="head_id" class="form-control"
                                                        onchange="addNewRow(this.value)">
                                                        <option value="">বাজেট হেড নির্বাচন করুন</option>
                                                        <?php foreach ($budget_head_sub as $key => $value) {
                                                            echo '<option value="' . $value->id . '">' . $value->budget_head_name . '>>' . $value->name_bn . ' (' . $value->bd_code . ')' . '</option>';
                                                        } ?>
                                                    </select>
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="">সর্বমোট পরিমান</label>
                                                    <input type="number" class="form-control input-sm"
                                                        name="total_amount" id="total_amount" readonly>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">অংশগ্রহণকারী</label>
                                                    <input type="number" class="form-control input-sm" name="all_per"
                                                        id="all_per" onkeyup="set_all_person(this.value)">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">দিন/বার</label>
                                                    <input type="number" class="form-control input-sm" name="all_day"
                                                        id="all_day" onkeyup="set_all_day(this.value)">
                                                </div>
                                            </div>

                                            <style>
                                                .group-header {
                                                    background-color: #d9edf7;
                                                    color: #31708f;
                                                    font-weight: bold;
                                                    cursor: pointer;
                                                    border: 2px solid #31708f;
                                                    /* Border for group header */
                                                    margin-top: 10px;
                                                    /* Margin to separate groups visually */
                                                }

                                                .group-header:hover {
                                                    background-color: #bce8f1;
                                                }

                                                .group-row {
                                                    border-left: 2px solid #31708f;
                                                    /* Left border for group rows */
                                                    border-right: 2px solid #31708f;
                                                    /* Right border for group rows */
                                                }

                                                .group-end-row {
                                                    border-bottom: 2px solid #31708f;
                                                    /* Bottom border for group rows */
                                                }

                                                .removable-row {
                                                    background-color: #f2dede;
                                                }

                                                .removable-row td {
                                                    color: #a94442;
                                                }

                                                .highlight {
                                                    background-color: #dff0d8 !important;
                                                }
                                            </style>
                                            <div class="col-md-12">
                                                <input type="text" name="group_name" id="group_name"
                                                    placeholder="Enter Group Name">
                                                <a class="btn btn-success btn-sm" id="createGroup"
                                                    href="javascript:void(0)">Create Group</a>
                                            </div>
                                            <div class="col-md-12 table-responsive">
                                                <table class="table table-hover table-condensed" border="1"
                                                    style="border:1px solid #a09e9e;" id="appRowDiv">
                                                    <thead>
                                                        <tr>
                                                            <th>Select</th>
                                                            <th>বাজেট শিরোনাম<span class="required">*</span></th>
                                                            <th>বাজেট কোড<span class="required">*</span></th>
                                                            <th>অংশগ্রহণকারী <span class="required">*</span></th>
                                                            <th>দিন/বার<span class="required">*</span></th>
                                                            <th>পরিমান<span class="required">*</span></th>
                                                            <th>বাজেট পরিমাণ</th>
                                                            <th>অ্যাকশন </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                        <!-- <?php foreach ($budget_head_sub as $key => $data) { ?>
                                                        <tr class="no-group">
                                                            <td><input type="checkbox" class="row-select"></td>
                                                            <td><?= $data->name_bn ?></td>
                                                            <td><?= $data->bd_code ?></td>
                                                            <td>
                                                                <input type="number" value="1" min="1"
                                                                    name="token_participant[]"
                                                                    onkeyup="calculateTotal_tokens(this)"
                                                                    class="form-control input-sm token_participant">
                                                            </td>
                                                            <td>
                                                                <input type="number" value="1" min="1" name="token_day[]"
                                                                    onkeyup="calculateTotal_tokens(this)"
                                                                    class="form-control input-sm token_day">
                                                            </td>
                                                            <td>
                                                                <input type="number" value="1" min="1" name="token_amount[]"
                                                                    onkeyup="calculateTotal_tokens(this)"
                                                                    class="form-control input-sm token_amount">
                                                            </td>
                                                            <td>
                                                                <input type="hidden" name="head_id[]"
                                                                    value="<?= $data->budget_head_id ?>" >
    
                                                                <input type="hidden" class="group_name" name="group_name[]"
                                                                    value="xnone" >
                                                                <input type="hidden" name="head_sub_id[]"
                                                                    value="<?= $data->id ?>">
                                                                <input value="1" min="0" type="number"
                                                                    onkeyup="calculateTotal()" name="amount[]"
                                                                    class="form-control amount input-sm token_amount_<?= $data->id ?>">
                                                            </td>
                                                            <td><a href="javascript:void(0)" onclick="removeRow(this)"
                                                                    class="btn btn-danger btn-sm" style="padding: 3px;"><i
                                                                        class="fa fa-times"></i> Remove</a></td>
                                                        </tr>
                                                        <?php } ?> -->
                                                    </tbody>
                                                </table>
                                            </div>
                                            <script>
                                                $(document).ready(function() {
                                                    $('#createGroup').on('click', function() {
                                                        const groupName = $('#group_name').val().trim().replace(/\s+/g, '_');
                                                        if (groupName === '') {
                                                            alert('Please enter a group name.');
                                                            return;
                                                        }

                                                        const selectedRows = $('#tbody .row-select:checked')
                                                            .closest('tr');
                                                        if (selectedRows.length === 0) {
                                                            alert(
                                                                'Please select at least one row to create a group.');
                                                            return;
                                                        }

                                                        // Create a new group header row with a remove button
                                                        const groupHeader = `
                                                                <tr class="group-header group-header-${groupName}">
                                                                    <td colspan="8">
                                                                        <b>${groupName}</b>
                                                                        <a href="javascript:void(0)" data-group_name="${groupName}" class="btn btn-danger btn-sm remove-group" style="float: right;"><i class="fa fa-times"></i> Remove Group</a>
                                                                    </td>
                                                                </tr>`;
                                                        $('#tbody').prepend(groupHeader);

                                                        // Move each selected row under the new group header
                                                        var i = 0;
                                                        selectedRows.each(function() {
                                                            i++;
                                                            $(this).find('.row-select')
                                                                .remove(); // Uncheck the checkbox
                                                            if (i == 1) {
                                                                $(this).addClass(
                                                                    `group-row group-row-${groupName} group-end-row`
                                                                );
                                                            } else {
                                                                $(this).addClass(
                                                                    `group-row group-row-${groupName}`
                                                                );
                                                            }
                                                            $('.group-header-' + groupName).after($(
                                                                this));

                                                            $('.group-row-' + groupName).find('.group_name').val(groupName);

                                                        });

                                                        $('#group_name').val(
                                                            ''); // Clear the group name input

                                                        // Make group header and rows draggable
                                                        // $(`.group-header-${groupName}, .group-row-${groupName}`)
                                                        //     .draggable({
                                                        //         helper: 'clone',
                                                        //         start: function(event, ui) {
                                                        //             $(this).addClass('highlight');
                                                        //         },
                                                        //         stop: function(event, ui) {
                                                        //             $(this).removeClass(
                                                        //             'highlight');
                                                        //         }
                                                        //     });

                                                        // Droppable area for rows
                                                        // $('#tbody').droppable({
                                                        //     accept: '.group-header, .group-row, .no-group',
                                                        //     drop: function(event, ui) {
                                                        //         if (ui.helper.hasClass(
                                                        //                 'group-header')) {
                                                        //             // Move the group header to the top
                                                        //             $(this).prepend(ui.helper);
                                                        //         } else {
                                                        //             // Move the row to the top
                                                        //             $('.group-header').first()
                                                        //                 .after(ui.helper);
                                                        //         }
                                                        //     }
                                                        // });
                                                    });
                                                    // $(document).ready(function() {
                                                    //     $('#tbody').droppable({
                                                    //         accept: '.group-header, .group-row, .no-group',
                                                    //         drop: function(event, ui) {
                                                    //             if (ui.helper.hasClass(
                                                    //                     'group-header')) {
                                                    //                 // Move the group header to the top
                                                    //                 $(this).prepend(ui.helper);
                                                    //             } else {
                                                    //                 // Move the row to the top
                                                    //                 $('.group-header').first()
                                                    //                     .after(ui.helper);
                                                    //             }
                                                    //         }
                                                    //     });
                                                    // })
                                                    // Remove group functionality
                                                    $(document).on('click', '.remove-group', function() {
                                                        const groupName = $(this).data('group_name');

                                                        const groupRows = $(`.group-row-${groupName}`);
                                                        const groupHeader = $(`.group-header-${groupName}`);

                                                        groupRows.addClass('removable-row').fadeOut(500,
                                                            function() {
                                                                $(this).remove();
                                                            });
                                                        groupHeader.addClass('removable-row').fadeOut(500,
                                                            function() {
                                                                $(this).remove();
                                                            });
                                                    });
                                                });
                                            </script>



                                            <br>
                                            <br>

                                            <div class="col-md-12" style="margin-top: 10px; padding: 0px;">
                                                <div class="form-group margin_top_10">
                                                    <label for=""> বিবরণ:</label>
                                                    <textarea class="form-control" name="description"
                                                        style="height: 300px;" id="description"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="pull-right">
                                                <input type="submit" id="submit_btn" name="submit" value="সংরক্ষণ করুন"
                                                    class="btn btn-primary btn-cons">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
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
    function removeRow(id) {
        $(id).closest("tr").remove();
        calculateTotal()
    }
</script>

<script>
    // $('.token_participant,.token_day,.token_amount').keyup(function() {
    //     calculateTotal_tokens(this)
    // })
    $('.token_participant,.token_day,.token_amount').change(function() {
        calculateTotal_tokens(this)
    })
</script>
<script>
    function remove_token_Row(el, head_sub_id) {
        $(el).closest("tr").remove();
        calculateTotal_tokens(head_sub_id)
        calculateTotal()
    }
</script>

<script>
    function addNewRow(id) {
        var head_id = id;

        if (head_id == "") {
            return false;
        }

        $("#loading").css("display", "flex");
        $.ajax({
            type: "POST",
            url: "<?= base_url('budgets/add_new_row') ?>",
            data: {
                head_id: head_id
            },
            success: function(data) {
                var $data = JSON.parse(data);
                if ($data.id == 2147483647) {
                    var tr = `
                <tr>
                        <td><input type="checkbox" class="row-select"></td>

                        <td>
                            <input type=""  name="custom_m[]" class="form-control input-sm"></td>
                        </td>
                        <td>${$data.bd_code}</td>
                        <td>
                            <input type="number" value="1" min="1" name="token_participant[]" onkeyup="calculateTotal_tokens(this)" class="form-control input-sm token_participant"></td>
                        <td>
                            <input type="number" value="1" min="1" name="token_day[]" onkeyup="calculateTotal_tokens(this)" class="form-control input-sm token_day"></td>
                        <td>
                            <input type="number" value="1" min="1" name="token_amount[]" onkeyup="calculateTotal_tokens(this)" class="form-control input-sm token_amount"></td>
                        <td>
                        <input type="hidden" class="group_name" name="group_name[]"
                                                                value="xnone" >
                        <input type="hidden" name="head_id[]" value="${$data.budget_head_id}">
                        <input type="hidden" name="head_sub_id[]" value="${$data.id}" >
                        <input value="1" min="0" type="number" onkeyup="calculateTotal()" name="amount[]" class="form-control amount input-sm token_amount_${$data.id}">
                        </td>
                        <td><a href="javascript:void(0)" onclick="removeRow(this)" class="btn btn-danger btn-sm" style="padding: 3px;"><i class="fa fa-times"></i> Remove</a></td>
                    </tr>`
                } else {
                    var tr = `
                <tr>
                        <td><input type="checkbox" class="row-select"></td>

                        <td>${$data.name_bn}</td>
                        <td>${$data.bd_code}</td>
                        <td>
                            <input type="number" value="1" min="1" name="token_participant[]" onkeyup="calculateTotal_tokens(this)" class="form-control input-sm token_participant"></td>
                        <td>
                            <input type="number" value="1" min="1" name="token_day[]" onkeyup="calculateTotal_tokens(this)" class="form-control input-sm token_day"></td>
                        <td>
                            <input type="number" value="1" min="1" name="token_amount[]" onkeyup="calculateTotal_tokens(this)" class="form-control input-sm token_amount"></td>
                        <td>
                        <input type="hidden" class="group_name" name="group_name[]"
                                                                value="xnone" >
                        <input type="hidden" name="head_id[]" value="${$data.budget_head_id}" >
                        <input type="hidden" name="head_sub_id[]" value="${$data.id}" >
                        <input value="1" min="0" type="number" onkeyup="calculateTotal()" name="amount[]" class="form-control amount input-sm token_amount_${$data.id}">
                        </td>
                        <td><a href="javascript:void(0)" onclick="removeRow(this)" class="btn btn-danger btn-sm" style="padding: 3px;"><i class="fa fa-times"></i> Remove</a></td>
                    </tr>`
                }
                $("#tbody").append(tr);
                $("#loading").hide();
            }
        })

    }
</script>

<script>
    function calculateTotal() {
        var total = 0;
        var rest_amount_b = parseInt(<?php echo $a; ?>);
        if (typeof rest_amount_b === "number" && !isNaN(rest_amount_b)) {
            try {
                $(".amount").each(function() {
                    var parsed_val = parseInt($(this).val());
                    if (typeof parsed_val === "number" && !isNaN(parsed_val)) {
                        total += parsed_val;
                    }
                });

                if (total > rest_amount_b) {
                    $('#submit_btn').prop('disabled', true);
                    $('#submit_btn').parent().find('.error_balance').remove();
                    $('#submit_btn').parent().prepend(
                        '<span class="error_balance" style="color: red;padding: 4px;border: 1px solid red;">অ্যাকাউন্টে পর্যাপ্ত পরিমাণ ব্যালেন্স নেই</span>'
                    );
                } else {
                    $('#submit_btn').prop('disabled', false);
                    $('#submit_btn').parent().find('.error_balance').remove();
                }
                $("#total_amount").val(total);
            } catch (e) {
                console.error(e);
                $('#submit_btn').prop('disabled', true);
                $('#submit_btn').parent().find('.error_balance').remove();
                $('#submit_btn').parent().prepend(
                    '<span class="error_balance" style="color: red;padding: 4px;border: 1px solid red;">অনুগ্রহ করে আবার চেষ্টা করুন</span>'
                );
            }
        } else {
            $('#submit_btn').prop('disabled', true);
            $('#submit_btn').parent().find('.error_balance').remove();
            $('#submit_btn').parent().prepend(
                '<span class="error_balance" style="color: red;padding: 4px;border: 1px solid red;">অনুগ্রহ করে আবার চেষ্টা করুন</span>'
            );
        }
    }

    function calculateTotal_tokens(el) {
        var total = 1;
        var token_participant = $(el).closest("tr").find(".token_participant").val()
        var token_day = $(el).closest("tr").find(".token_day").val()
        var token_amount = $(el).closest("tr").find(".token_amount").val()
        total = token_participant * token_day * token_amount
        $(el).closest("tr").find(".amount").val(total)
        calculateTotal();
    }
</script>
<script>
    $(document).ready(function() {
        calculateTotal()

    })
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#fcl_year').chosen();
        $('#head_id').chosen();
        $('#office_type').chosen();
        $('#office_id').chosen();

    });
</script>


<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .then(editor => {
            window.editor = editor;
        })
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    function getofficeid(id) {
        $("#office_id").empty();
        var office_id = id;
        if (office_id == "") {
            return false;
        }
        $("#loading").css("display", "flex");
        $.ajax({
            type: "POST",
            url: "<?= base_url('budgets/get_office_id_by_type') ?>",
            data: {
                office_type: office_id
            },
            success: function(data) {
                $("#loading").css("display", "none");
                data = JSON.parse(data);
                $("#office_id").append('<option value="">-- নির্বাচন করুন --</option>');
                $.each(data, function(key, value) {
                    $("#office_id").append('<option value="' + value.id + '">' + value.name +
                        '</option>');
                })
                $("#office_id").trigger("chosen:updated");

            }
        })

    }
</script>

<script>
    function set_all_person(vall) {
        $('.token_participant').each(function() {
            if ($(this).val() !== undefined) {
                $(this).val(vall);
                calculateTotal_tokens(this)
            }
        });

    }

    function set_all_day(vall) {
        $('.token_day').each(function() {
            if ($(this).val() !== undefined) {
                $(this).val(vall);
                calculateTotal_tokens(this)
            }
        });
    }
</script>