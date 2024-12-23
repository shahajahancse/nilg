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
                                class="btn btn-blueviolet btn-xs btn-mini">বাজেট তালিকা</a>
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
                        echo form_open_multipart("budgets/budget_nilg_create", $attributes);
                        echo validation_errors();
                        ?>

                        <div class="row">
                            <div class="col-md-12">
                                <fieldset style="">
                                    <div class="col-md-12"
                                        style="padding: 20px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                                        <div>
                                            <span style="font-size: 22px;font-weight: bold;text-decoration: underline;">বাজেট তৈরি করুন</span>
                                        </div>
                                    </div>
                                    <div class="row form-row" style="font-size: 16px; color: black;">
                                        <div class="col-md-6">
                                            আবেদনকারীর নাম: <strong><?= $info->name_bn ?></strong>
                                        </div>
                                        <div class="col-md-6">
                                            পদবীর নাম: <strong><?= $info->current_desig_name ?></strong>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row form-row" style="font-size: 16px; color: black;">
                                        <div class="col-md-6" >
                                            <input type="text" class="form-control input-sm" name="title" style="min-height: 33px;" placeholder="শিরোনাম লিখুন" required>
                                        </div>
                                        <div class="col-md-6">
                                            ডিপার্টমেন্ট নাম: <strong><?= $info->current_dept_name ?></strong>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row form-row">
                                        <div class="col-md-12">
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
                                            <div class="col-md-4" >
                                                <?php $session_year = $this->db->order_by('id', 'desc')->get('session_year')->result(); ?>

                                                <label for="fcl_year" class="control-label">অর্থবছর <span class="required">*</span></label>
                                                <select name="fcl_year" id="fcl_year" class="form-control input-sm" required>
                                                    <option value='' selected>নির্বাচন করুন</option>
                                                    <?php foreach ($session_year as $key => $value) {
                                                        echo '<option value="' . $value->id . '">' . $value->session_name . '</option>';
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="">সর্বমোট পরিমান</label>
                                                <input type="number" class="form-control input-sm"
                                                    name="total_amount" id="total_amount" value="0" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row form-row">
                                        <div class="col-md-12 table-responsive">
                                            <table class="table table-hover table-bordered" border="1"
                                                style="border:1px solid #a09e9e; margin-top: 10px;" id="appRowDiv">
                                                <thead>
                                                <tr>
                                                    <!-- <th width="30%">বাজেট হেড<span class="required">*</span></th> -->
                                                    <th width="20%">বাজেট শিরোনাম<span class="required">*</span>
                                                    </th>
                                                    <th width="10%">বাজেট কোড<span class="required">*</span>
                                                    </th>
                                                    <th width="15%">পূর্ববর্তী বরাদ্দ</th>
                                                    <th width="15%">চলমান বরাদ্দ</th>
                                                    <th width="15%">বাজেট পরিমাণ</th>
                                                    <th width="15%">প্রাক্কলন পরিমাণ</th>
                                                    <th width="10%">অ্যাকশন </th>
                                                </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                <?php foreach ($budget_head_sub as $key => $data) { ?>
                                                    <tr>
                                                        <td style="padding:0px 10px;width: 20%"><?= $data->name_bn ?></td>
                                                        <td style="padding:0px 10px;width: 10%"><?= $data->bd_code ?></td>
                                                        <td style="padding:0px 10px;width: 15%"><input type="number" value="<?=$data->prev_amt ?>" class="form-control prev_amt input-sm" onkeyup="calculateTotal(this)" name="prev_amt[]" ></td>

                                                        <td style="padding:0px 10px;width: 15%"><input type="number" value="<?=$data->budget_amt ?>" class="form-control running_amt input-sm" onkeyup="calculateTotal(this)" name="running_amt[]"></td>

                                                        <td style="padding:0px 10px;width: 15%">
                                                            <input type="hidden" name="head_id[]"
                                                                value="<?= $data->budget_head_id ?>">
                                                            <input type="hidden" name="head_sub_id[]"
                                                                value="<?= $data->id ?>">
                                                            <input value="0" min="0" type="number" onkeyup="calculateTotal(this)" name="amount[]"
                                                                class="form-control amount input-sm">
                                                        </td>

                                                        <td style="padding:0px 10px;width: 15%"><input type="number" value=0 class="prokolpito_amt form-control  input-sm" readonly name="prokolpito_amt[]"></td>
                                                        <td style="padding:0px 10px;width: 10%"><a href="javascript:void(0)"
                                                                onclick="removeRow(this)"
                                                                class="btn btn-danger btn-sm"
                                                                style="padding: 3px;"><i class="fa fa-times"></i>
                                                                Remove</a></td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row form-row">
                                        <div class="col-md-12" style="margin-top: 0px;">
                                            <div class="form-group margin_top_10">
                                                <label for=""> বিবরণ:</label>
                                                <textarea class="form-control" name="description"
                                                    style="height: 300px;"
                                                    id="description"><p></p><p></p></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row form-row">
                                        <div class="pull-right" style="padding-right: 15px;">
                                            <input type="submit" name="submit" value="সংরক্ষণ করুন"
                                                    class="btn btn-primary btn-cons">
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
        calculateTotal_amount()
    }
</script>


<script>
function calculateTotal_amount(){
    var total = 0;
        $(".prokolpito_amt").each(function() {
            total += parseInt($(this).val());
        })
        $("#total_amount").val(total);
}
</script>

<script>
    function calculateTotal(el) {
        var prev_amt=$(el).closest("tr").find(".prev_amt").val()
        var running_amt=$(el).closest("tr").find(".running_amt").val()
        var amount=$(el).closest("tr").find(".amount").val()
        var total = parseInt(prev_amt) + parseInt(running_amt) + parseInt(amount);
        $(el).closest("tr").find(".prokolpito_amt").val(total);
        calculateTotal_amount()
    }
</script>


<script>
    function addNewRow(id) {
        var head_id = id;

        if (head_id == "") {
            return false;
        }

        $("#loading").show();
        $.ajax({
            type: "POST",
            url: "<?= base_url('budgets/add_new_row') ?>",
            data: {
                head_id: head_id
            },
            success: function(data) {
                var data = JSON.parse(data);
                var tr = `<tr>
                        <td style="padding:0px 10px;width: 20%">${data.name_bn}</td>
                        <td style="padding:0px 10px;width: 10%">${data.bd_code}</td>
                        <td style="padding:0px 10px;width: 15%"><input type="number" value="${data.prev_amt}" class="form-control prev_amt input-sm" onkeyup="calculateTotal(this)" name="prev_amt[]" ></td>
                        <td style="padding:0px 10px;width: 15%"><input type="number" value="${data.budget_amt}" class="form-control running_amt input-sm" onkeyup="calculateTotal(this)" name="running_amt[]"></td>
                        <td style="padding:0px 10px;width: 15%">
                        <input type="hidden" name="head_id[]" value="${data.budget_head_id}" >
                        <input type="hidden" name="head_sub_id[]" value="${data.id}" >
                        <input value="0" min="0" type="number" onkeyup="calculateTotal(this)"  name="amount[]" class="form-control amount input-sm">
                        </td>
                        <td style="padding:0px 10px;width: 15%"><input type="number" value=0 class="prokolpito_amt form-control  input-sm" readonly name="prokolpito_amt[]"></td>
                        <td style="padding:0px 10px;width: 10%"><a href="javascript:void(0)" onclick="removeRow(this)" class="btn btn-danger btn-sm" style="padding: 3px;"><i class="fa fa-times"></i> Remove</a></td>
                     </tr>`
                $("#tbody").append(tr);
                $("#loading").hide();
            }
        })

    }
</script>

<script>
    $(document).ready(function() {
        $('input[type="number"]').each(function() {
            $(this).on('keyup', function() {
                calculateTotal(this);
            });
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#fcl_year').chosen();
        $('#head_id').chosen();
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
