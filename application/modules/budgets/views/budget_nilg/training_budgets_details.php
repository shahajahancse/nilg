<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<style>
    .chosen-single {
        height: 30px !important;
        border: 1px solid #00a59a !important;
    }
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
</style>

<div class="page-content">
    <div class="content">
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a></li>
            <li><a href="<?=base_url('budget/training_budgets_create')?>" class="active"><?=$module_name?></a></li>
            <li><?=$meta_title; ?></li>
        </ul>

        <div class="row">
            <div class="col-md-12">
                <div class="grid simple horizontal red">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                        <div class="pull-right">
                            <a href="<?=base_url('budgets/training_budgets')?>"
                                class="btn btn-blueviolet btn-xs btn-mini">বাজেট তাকিকা</a>
                        </div>
                    </div>
                    <div class="grid-body">
                        <?php if($this->session->flashdata('success')):?>
                            <div class="alert alert-success">
                                <?=$this->session->flashdata('success');;?>
                            </div>
                        <?php endif; ?> <?php if($this->session->flashdata('error')):?>
                            <div class="alert alert-danger">
                                <?=$this->session->flashdata('error');;?>
                            </div>
                        <?php endif; ?>

                        <?php $att = array('id' => 'jsvalidate');
                            echo form_open_multipart("budgets/training_budgets_edit/".encrypt_url($budget_nilg->id), $att); echo validation_errors();
                        ?>
                            <div class="row">
                                <div class="col-md-12"
                                    style="padding: 20px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                                    <div>
                                        <span
                                            style="font-size: 22px;font-weight: bold;text-decoration: underline;">বাজেট
                                            তৈরি করুন</span>
                                    </div>
                                </div>
                                <div class="row form-row" style="font-size: 16px; color: black;">
                                    <div class="col-md-12" style='margin-bottom:10px'>
                                        <div class="col-md-4">
                                            আবেদনকারীর নাম: <strong><?=$info->name_bn?></strong>
                                        </div>
                                        <div class="col-md-4">
                                            পদবী: <strong><?=$info->current_desig_name?></strong>
                                        </div>
                                        <div class="col-md-4">
                                            ডিপার্টমেন্ট নাম: <strong><?=$info->current_dept_name?></strong>
                                        </div>
                                    </div>

                                    <div class="col-md-12" style='margin-bottom:10px'>
                                        <div class="col-md-4">
                                            <?php $types=$this->db->get('office_type')->result();?>
                                            <label class="control-label">অফিস ধরণ <span class="required">*</span></label>
                                            <select name="office_type" id="office_type" class="form-control input-sm" required>
                                                <option value='' selected>নির্বাচন করুন</option>
                                                <?php foreach ($types as $key => $value) { ?>
                                                    <option <?= $budget_nilg->office_type == $value->id ? 'selected' : '' ?> value="<?=$value->id?>"><?=$value->office_type_name?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <?php $cources=$this->db->where('status', 1)->get('course')->result();; ?>
                                            <label class="control-label">কোর্স নাম <span class="required">*</span></label>
                                            <select name="course_id" id="course_id" class="form-control input-sm" required>
                                                <option value='' selected>নির্বাচন করুন</option>
                                                <?php foreach ($cources as $key => $value) { ?>
                                                    <option <?= $budget_nilg->course_id == $value->id ? 'selected' : '' ?> value="<?=$value->id?>"><?=$value->course_title?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <?php $cources=$this->db->where('status', 1)->get('budget_trainee_type')->result();; ?>
                                            <label class="control-label">প্রশিক্ষণার্থীর ধরন <span class="required">*</span></label>
                                            <select name="trainee_type" id="trainee_type" class="form-control input-sm" required>
                                                <option value='' selected>নির্বাচন করুন</option>
                                                <?php foreach ($cources as $key => $value) { ?>
                                                    <option <?= $budget_nilg->trainee_type == $value->id ? 'selected' : '' ?> value="<?=$value->id?>"><?=$value->name?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12" style='margin-bottom:10px'>
                                        <div class="col-md-7">
                                            <label for="">বাজেট শিরোনাম <span class="required">*</span></label>
                                            <input value='<?=$budget_nilg->title?>' class="form-control input-sm" name="title" id="title">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="">মেয়াদ (দিন) <span class="required">*</span></label>
                                            <input value='<?=$budget_nilg->course_day?>' type="number" class="form-control input-sm" name="course_day" id="course_day">
                                        </div>
                                        <div class="col-md-3" >
                                            <?php $session_year=$this->db->order_by('id','desc')->get('session_year')->result();?>
                                            <label for="fcl_year" class="control-label">অর্থবছর <span class="required">*</span></label>
                                            <select name="fcl_year" id="fcl_year" class="form-control input-sm" required>
                                                <option value='' selected>নির্বাচন করুন</option>
                                                <?php foreach ($session_year as $key => $value) { ?>
                                                    <option <?= $budget_nilg->fcl_year == $value->id ? 'selected' : '' ?> value="<?=$value->id?>"><?=$value->session_name?></option>
                                                <?php  } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12" style='margin-bottom:10px'>
                                        <div class="col-md-4">
                                            <?php $types=$this->db->get('office_type')->result();?>
                                            <label for="">বাজেট হেড নির্বাচন করুন</label>
                                            <select id="head_id" class="form-control"
                                                onchange="addNewRow(this.value)">
                                                <option value="">বাজেট হেড নির্বাচন করুন</option>
                                                <?php foreach ($budget_head_sub as $key => $value) {
                                                    echo '<option value="'.$value->id.'">'.$value->name_bn.'</option>';

                                                }?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="">প্রশিক্ষণার্থীর সংখ্যা <span class="required">*</span></label>
                                            <input value='<?=$budget_nilg->trainee_number?>' type="number" onkeyup="calParticipantTotal()" class="form-control input-sm" name="trainee_number" id="trainee_number">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="">ব্যাচ সংখ্যা <span class="required">*</span></label>
                                            <input value='<?=$budget_nilg->batch_number?>' type="number" onkeyup="calParticipantTotal()" class="form-control input-sm" name="batch_number" id="batch_number">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="">সর্বমোট প্রশিক্ষণার্থী</label>
                                            <input value='<?=$budget_nilg->total_trainee?>' class="form-control input-sm" name="total_trainee" id="total_trainee" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="">সর্বমোট পরিমান</label>
                                            <input value='<?=$budget_nilg->amount?>' class="form-control input-sm" name="total_amount" id="total_amount" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-row">
                                    <div class="col-md-12">
                                        <!-- <h4 class="semi-bold margin_left_15" style="margin-left: 2px;">বাজেট তালিকা </h4> -->
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
                                            <table class="col-md-12" width="100%" border="1"
                                                style="border:1px solid #a09e9e; margin-top: 10px;" id="appRowDiv">
                                                <thead>
                                                    <tr>
                                                        <!-- <th width="30%">বাজেট হেড<span class="required">*</span></th> -->
                                                        <th width="30%">বাজেট শিরোনাম<span class="required"> * </span></th>
                                                        <th width="10%">অংশগ্রহণকারী<span class="required"> * </span></th>
                                                        <th width="10%">বার<span class="required"> * </span></th>
                                                        <th width="10%">পরিমাণ<span class="required"> * </span></th>
                                                        <th width="10%">মোট পরিমাণ</th>
                                                        <th width="10%">অ্যাকশন </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                    <?php foreach ($results as $key => $value) { ?>
                                                        <tr class="head_<?=$value->id?> classThis" data-id="<?=$value->id?>">
                                                            <input type="hidden" name="sum_details_id[]" value="<?=$value->id?>" >
                                                            <input type="hidden" name="head_id[]" value="<?=$value->head_id?>" >
                                                            <input class="head_amt_<?=$value->id?>" type="hidden" name="head_amt[]" value="0" >
                                                            <td colspan="5">
                                                                <div style="display: flex; gap: 15px; align-items: center;">
                                                                <?=$value->name_bn?>
                                                                <select id="add_sub_row" style="margin-bottom: 0px;min-height: 20px;height: 25px !important;" >
                                                                    <option value="">add sub row</option>
                                                                </select>
                                                                <a onclick="pass_id(<?= $value->id?>)" data-target="#modalNewSubHead" data-toggle="modal" style="padding: 2px 5px !important;font-size: 10px;font-weight: bolder;" class="btn btn-primary btn-sm" id="add_new_sub">Add New +</a>
                                                                </div>
                                                            </td>
                                                            <td><a href="javascript:void(0)" onclick="removeRow(this, <?=$value->id?>)" class="btn btn-danger btn-sm" style="padding: 3px;"><i class="fa fa-times"></i> Remove</a></td>
                                                        </tr>
                                                        <?php
                                                        $heads = [];
                                                        if (isset($value->id) && isset($value->head_id)) {
                                                            $this->db->select('r.*, b.name_bn');
                                                            $this->db->from('budget_revenue_sub_details as r');
                                                            $this->db->join('budget_head_sub_training as b', 'b.id = r.head_sub_id');
                                                            $this->db->where('r.rev_sum_details', $value->id)->where('r.head_id', $value->head_id);
                                                            $heads = $this->db->get()->result();
                                                        }
                                                        ?>
                                                        <?php foreach ($heads as $key => $head) { ?>
                                                            <tr class="head_<?=$head->head_id?> side_css">
                                                                <input type="hidden" name="<?=$value->id?>_sub_de_id[]" value="<?=$head->id?>">
                                                                <input type="hidden" name="<?=$value->id?>_sub_id[]" value="<?=$head->head_id?>">
                                                                <td colspan=""><?=$head->name_bn?></td>

                                                                <td><input type="number" value="1" min="1" name="<?=$value->id?>_participants[]" onkeyup="calculateSubTotal(this, <?=$head->head_id?>)" class="pts form-control input-sm subParticipant_<?=$head->head_id?>"></td>
                                                                <td><input type="number" value="1" min="1" name="<?=$value->id?>_days[]" onkeyup="calculateSubTotal(this, <?=$head->head_id?>)" class="form-control input-sm subDay_<?=$head->head_id?>"></td>
                                                                <td><input type="number" value="1" min="1" name="<?=$value->id?>_amount[]" onkeyup="calculateSubTotal(this, <?=$head->head_id?>)" class="form-control input-sm subAmount_<?=$head->head_id?>"></td>

                                                                <td><input type="number" value="1" min="1" name="<?=$value->id?>_subTotal[]" readonly class="form-control amount input-sm subTotal_<?=$head->head_id?>"></td>

                                                                <td><a href="javascript:void(0)" onclick="removeSubRow(this, <?=$head->id?>)" class="btn btn-danger btn-sm" style="padding: 3px;"><i class="fa fa-times"></i> Remove</a></td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </tbody>
                                            </table>

                                            <div class="col-md-12" style="margin-top: 20px; padding: 0px;">
                                                <div class="form-group margin_top_10">
                                                    <label for=""> বিবরণ:</label>
                                                    <textarea class="form-control" name="description" style="height: 300px;" id="description">
                                                    <?php echo $budget_nilg->description; ?>
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="pull-right">
                                                    <input type="submit" name="submit" value="সংরক্ষণ করুন" class="btn btn-primary btn-cons">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php echo form_close();?>
                    </div> <!-- END GRID BODY -->
                </div> <!-- END GRID -->
            </div>
        </div> <!-- END ROW -->
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalNewSubHead" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel" class="semi-bold">নতুন শিরোনাম যুক্ত করুন </h3>
      </div>
      <form method="POST" id="addSubNewHead">
        <div class="modal-body">
          <div class="form-group">
            <label for="">বাংলা:</label>
            <input type="text" class="form-control input-sm" name="add_name_bn" id="add_name_bn" required >
          </div>
          <div class="form-group">
            <label for="">ইংলিশ:</label>
            <input type="text" class="form-control input-sm" name="add_name_en" id="add_name_en" required >
          </div>
          <input type="hidden" name="prosnoid" id="prosnoid">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang('common_close')?></button>
          <button type="submit" class="btn btn-primary"><?=lang('common_save')?></button>
        </div>
      </form>
      <?php //echo form_close(); ?>
    </div> <!-- /.modal-content -->
  </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->

<script>
    function pass_id(id) {
        $('#prosnoid').val(id);
    }

    $("#addSubNewHead").submit(function(e){
        e.preventDefault();
        $('#modalNewSubHead').modal('hide');
        var id = $('#prosnoid').val();
        $.ajax({
            type: "POST",
            url: hostname+"nilg_setting/budget_sub_head/ajax_add_sub_head/" + id,
            data: $(this).serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.status == 1) {
                    $('.alert').addClass('alert-success').html(response.msg).show();
                } else {
                    $('.alert').addClass('alert-red').html(response.msg).show();
                }
            }
        });
        return false;
    });
</script>

<style>
    .addBtn {
        padding: 2px 10px;
        border: 1px solid;
        color: #fff;
        background: #469ae5;
        font-size: 10px;
        float: right;
        cursor: pointer;
    }
    .form-row input {
        margin-bottom: 0px !important;
    }
    .classThis {
        border: 2px solid #11a8df;
        background: #f1f1f1;
    }
    .bottom_css {
        border-bottom: 2px solid #11a8df;
        border-left: 2px solid #11a8df;
        border-right: 2px solid #11a8df;
    }
    .side_css {
        border-left: 2px solid #11a8df;
        border-right: 2px solid #11a8df;
    }
</style>
<script>
    function removeSubRow(e, id) {
        $(e).closest("tr").remove();
        calculateSubTotal(e, id);
    }
</script>

<script>
    function addSubRow(e, id) {
        var tr = `
        <tr class="head_${id}" data-id="${id}">
            <td colspan="2" ><input class="form-control input-sm" name="${id}_subHead[]""></td>
            <td> <input class="form-control subParticipant_${id} input-sm" onkeyup="calculateSubTotal(this, ${id})" min='1' value="1" name="${id}_participants[]" ></td>
            <td> <input class="form-control subDay_${id} input-sm" onkeyup="calculateSubTotal(this, ${id})" min='1' value="1" name="${id}_days[]" ></td>
            <td> <input class="form-control subAmount_${id} input-sm" onkeyup="calculateSubTotal(this, ${id})" min='1' value="1" name="${id}_amount[]" ></td>
            <td> <input value="1" type="number" name="${id}_subTotal[]" class="form-control subTotal_${id} input-sm" readonly> </td>
            <td><a href="javascript:void(0)" onclick="removeSubRow(this, ${id})" class="btn btn-danger btn-sm" style="padding: 3px;"><i class="fa fa-times"></i> Remove</a></td>
        </tr>`

        $('.head_'+id).eq(-1).after(tr).end();
        $('.head_'+id).removeClass('classThis');
        $('.head_'+id).removeClass('side_css');
        $('.head_'+id).removeClass('bottom_css');
        $('.head_'+id).eq(0).addClass('classThis');
        $('.head_'+id).eq(-1).addClass('bottom_css');
        $('.head_'+id).not(':first').not(':last').addClass('side_css');

        var row = $(e).closest('tr');
        row.find('.participants').prop('readonly', true);
        row.find('.days').prop('readonly', true);
        row.find('.token_amount').prop('readonly', true);
        row.find('.participants').val(0);
        row.find('.days').val(0);
        row.find('.token_amount').val(0);
    }
</script>

<script>
    function removeRow(el, id) {
        $(".head_"+id).each(function() {
            $(this).closest("tr").remove();
        });
        calculateTotal()
    }
</script>

<script>
    function addNewRow(id) {
        var head_id = id;
        var pat = $('#trainee_number').val();
        var btd = $('#course_day').val();

        if (head_id == "") {
            return false;
        }

        $("#loading").show();
        $.ajax({
            type: "POST",
            url: "<?=base_url('budgets/add_new_row') ?>",
            data: {
                head_id: head_id
            },
            success: function(data) {
                var $data = JSON.parse(data);
                if ($data.id == 2147483647) {
                    var tr = `
                    <tr class="head_${id}" data-id="${id}">
                        <td colspan="2" >${$data.name_bn}</td>
                        <td colspan="3">
                            <input type="hidden" value="1" name="participants[]" ></td>
                            <input type="hidden" value="1" name="days[]" ></td>
                            <input type="hidden" value="1" name="amount[]" ></td>
                        <td>
                        <input type="hidden" name="head_sub_id[]" value="${$data.id}" >
                        <input value="1" min="0" type="number" onkeyup="calculateTotal()" name="total_amt[]" class="form-control amount input-sm token_amount_${$data.id}">
                        </td>
                        <td><a href="javascript:void(0)" onclick="removeRow(this, ${id})" class="btn btn-danger btn-sm" style="padding: 3px;"><i class="fa fa-times"></i> Remove</a></td>
                    </tr>`
                } else {
                    var tr = `
                    <tr class="head_${id}" data-id="${id}">
                        <td class="ssl">${$data.name_bn}  <span class="addBtn" data-id=0 onclick="addSubRow(this, ${id})"> অ্যাড সাব + </span>  </td>
                        <td>${$data.bd_code}</td>
                        <input type="hidden" name="head_sub_id[]" value="${$data.id}" >
                        <td>
                            <input type="number" value="${pat}" min="1" name="participants[]" onkeyup="calculateTotal_tokens(this)" class="form-control input-sm participants"></td>
                        <td>
                            <input type="number" value="${btd}" min="1" name="days[]" onkeyup="calculateTotal_tokens(this)" class="form-control input-sm days"></td>
                        <td>
                            <input type="number" value="1" min="1" name="amount[]" onkeyup="calculateTotal_tokens(this)" class="form-control input-sm token_amount"></td>
                        <td>
                        <input value="1" min="0" type="number" name="total_amt[]" class="form-control amount input-sm token_amount_${$data.id}" readonly >
                        </td>
                        <td><a href="javascript:void(0)" onclick="removeRow(this, ${id})" class="btn btn-danger btn-sm" style="padding: 3px;"><i class="fa fa-times"></i> Remove</a></td>
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
        $(".amount").each(function() {
            total += parseInt($(this).val());
        })
        $("#total_amount").val(total);
    }
</script>
<script>
    function calculateTotal_tokens(el) {
        var total = 0;
        var participants = $(el).closest("tr").find(".participants").val()
        var days = $(el).closest("tr").find(".days").val()
        var token_amount = $(el).closest("tr").find(".token_amount").val()
        total = participants * days * token_amount
        $(el).closest("tr").find(".amount").val(total)
        calculateTotal();
    }
</script>

<script>
    function calculateSubTotal(el, id) {
        var st = 0;
        var participants = $(el).closest("tr").find(".subParticipant_"+id).val()
        var days = $(el).closest("tr").find(".subDay_"+id).val()
        var token_amount = $(el).closest("tr").find(".subAmount_"+id).val()
        st = participants * days * token_amount
        $(el).closest("tr").find(".subTotal_"+id).val(st)

        var subTotal = 0;
        $(".subTotal_"+id).each(function() {
            subTotal += parseInt($(this).val());
        })
        $(".head_amt_"+id).val(subTotal);
        $(".token_amount_"+id).val(subTotal);
        calculateTotal();
    }
</script>

<script>
    function calParticipantTotal() {
        var st = 0;
        var trainee_number = $("#trainee_number").val()
        var batch_number = $("#batch_number").val()
        var st = trainee_number * batch_number
        $("#total_trainee").val(st);
        $(".pts").val(trainee_number);
    }
</script>
<script>
    $(document).ready(function() {
        calculateTotal()
        calParticipantTotal()
    })
</script>

<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#description')).then(editor => {window.editor = editor;}).catch(error => {console.error(error);});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#fcl_year').chosen();
        $('#head_id').chosen();
        $('#add_sub_row').chosen();
    });
</script>