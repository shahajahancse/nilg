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
            <li><a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a></li>
            <li><a href="<?=base_url('budget/budget_nilg_create')?>" class="active"><?=$module_name?></a></li>
            <li><?=$meta_title; ?></li>
        </ul>

        <style type="text/css">
        /*#appointment, #invitation { display: none; }*/
        </style>

        <div class="row">
            <div class="col-md-12">
                <div class="grid simple horizontal red">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                        <div class="pull-right">
                            <a href="<?=base_url('budgets/budget_nilg')?>"
                                class="btn btn-blueviolet btn-xs btn-mini">বাজেট তাকিকা</a>
                        </div>
                    </div>
                    <div class="grid-body">
                        <?php if($this->session->flashdata('success')):?>
                        <div class="alert alert-success">
                            <?=$this->session->flashdata('success');;?>
                        </div>
                        <?php endif; ?>

                        <?php 
                  $attributes = array('id' => 'jsvalidate');
                  echo form_open_multipart("budgets/budget_field_create",$attributes);
                  echo validation_errors();
                  ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div id="loading">
                                    <img src="<?=base_url('img/loading.gif') ?>" width="100" alt="">
                                </div>
                                <fieldset>
                                    <legend>বাজেট তথ্য</legend>


                                    <div class="row form-row" style="font-size: 16px; color: black;">
                                        <div class="col-md-4">
                                            আবেদনকারীর নাম: <strong><?=$info->name_bn?></strong>
                                        </div>
                                        <div class="col-md-4">
                                            পদবীর নাম: <strong><?=$info->current_desig_name?></strong>
                                        </div>
                                        <div class="col-md-4">
                                            ডিপার্টমেন্ট নাম: <strong><?=$info->current_dept_name?></strong>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="col-md-3">
                                            <label for="title" class="control-label">টাইটেল : </label>
                                            <input type="text" class="form-control input-sm" name="title"
                                                style="min-height: 33px;" value="" required>
                                        </div>
                                        <div class="col-md-3">
                                            <?php $session_year=$this->db->get('session_year')->result();?>

                                            <label for="fcl_year" class="control-label">অর্থবছর</label>
                                            <select name="fcl_year" id="fcl_year" class="form-control input-sm"
                                                required>
                                                <option value="">নির্বাচন করুন</option>
                                                <?php foreach ($session_year as $key => $value) {
                                                      echo '<option value="'.$value->id.'">'.$value->session_name.'</option>';
                                                   } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <?php $session_year=$this->db->get('office_type')->result();?>

                                            <label for="office_type" class="control-label">অফিস ধরণ</label>
                                            <select onchange="getofficeid(this.value)" name="office_type"
                                                id="office_type" class="form-control input-sm" required>
                                                <option value="">নির্বাচন করুন</option>
                                                <?php foreach ($session_year as $key => $value) {
                                                      echo '<option value="'.$value->id.'">'.$value->office_type_name.'</option>';
                                                   } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="office_id" class="control-label">অফিস</label>
                                            <select name="office_id" id="office_id" class="form-control input-sm"
                                                required>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="row form-row">
                                        <div class="col-md-12">
                                            <h4 class="semi-bold margin_left_15">বাজেট তালিকা</h4>
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
                                                        <label for="">Select Head</label>
                                                        <select name="head" id="head_id" class="form-control"
                                                            onchange="addNewRow(this.value)">
                                                            <option value="">Select Head</option>
                                                            <?php foreach ($budget_head_sub as $key => $value) {
                                                            echo '<option value="'.$value->id.'">'.$value->budget_head_name.'>>'.$value->name_bn.'</option>';
                                                         }?>
                                                        </select>
                                                    </div>
                                                    <!-- <div class="col-md-4">
                                                        <img id="loading" src="<?=base_url('img/loading.gif') ?>"
                                                            style="height: 47px;margin-top: 14px;display: none;">
                                                    </div> -->
                                                    <div class="col-md-4">
                                                        <label for="">Total Amount</label>
                                                        <input type="number" class="form-control input-sm"
                                                            name="total_amount" id="total_amount" readonly>

                                                    </div>

                                                </div>

                                                <table class="col-md-12" width="100%" border="1"
                                                    style="border:1px solid #a09e9e;" id="appRowDiv">
                                                    <thead>
                                                        <tr>
                                                            <th width="30%">বাজেট হেড<span class="required">*</span>
                                                            </th>
                                                            <th width="30%">বাজেট সাব হেড <span class="required">*</span></th>
                                                            <th width="30%">বাজেট টোকেন <span class="required">*</span></th>
                                                            <th width="30%">বাজেট আমাউন্ট</th>
                                                            <th width="10%">অ্যাকশন </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                    </tbody>
                                                </table>
                                                <br>
                                                <br>

                                                <div class="col-md-12" style="margin-top: 10px; padding: 0px;">
                                                    <div class="form-group margin_top_10">
                                                        <label for=""> Description :</label>
                                                        <textarea class="form-control" name="description"
                                                            style="height: 300px;" id="description"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="pull-right">
                                <input type="submit" name="submit" value="সংরক্ষণ করুন"
                                    class="btn btn-primary btn-cons">
                            </div>
                        </div>
                        <?php echo form_close();?>
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
function remove_token_Row(el,head_sub_id) {
    $(el).closest("tr").remove();
    calculateTotal_token(head_sub_id) 
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
        url: "<?=base_url('budgets/add_new_row') ?>",
        data: {
            head_id: head_id
        },
        success: function(data) {
            var data = JSON.parse(data);
            var tr = `<tr>
                        <td>${data.budget_head_name}</td>
                        <td>${data.name_bn}</td>
                        <td>
                            <table class="col-md-12" width="100%" border="1" style="border:1px solid #a09e9e;">
                               <thead>
                                    <tr>
                                        <td>Token</td>
                                        <td>Number</td>
                                        <td><a href="javascript:void(0)" onclick="add_token_Row(${data.id})" class="btn btn-primary btn-sm" style="padding: 3px;"><i class="fa fa-plus"></i></a></td>
                                    </tr>
                               </thead>
                               <tbody id="token-row-${data.id}">
                                    <tr>
                                        <td><input type="text" name="token-${data.id}[]" value="Amount" class="form-control input-sm" readonly></td>
                                        <td><input type="text" value="1" min="1" name="token_amount-${data.id}[]" onkeyup="calculateTotal_token(${data.id})" class="form-control input-sm"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="token-${data.id}[]" value="Day" class="form-control input-sm" readonly></td>
                                        <td><input type="text" value="1" min="1" name="token_amount-${data.id}[]" onkeyup="calculateTotal_token(${data.id})" class="form-control input-sm"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="token-${data.id}[]" value="Participants" class="form-control input-sm" readonly></td>
                                        <td><input type="text" value="1" min="1" name="token_amount-${data.id}[]" onkeyup="calculateTotal_token(${data.id})" class="form-control input-sm"></td>
                                    </tr>
                               </tbody>
                            </table>
                        </td>
                        <td>
                        <input type="hidden" name="head_id[]" value="${data.budget_head_id}" >
                        <input type="hidden" name="head_sub_id[]" value="${data.id}" >
                        <input value="0" min="0" type="number" onkeyup="calculateTotal()" name="amount[]" class="form-control amount input-sm token_amount_${data.id}">
                        </td>
                        <td><a href="javascript:void(0)" onclick="removeRow(this)" class="btn btn-danger btn-sm" style="padding: 3px;"><i class="fa fa-times"></i> Remove</a></td>
                     </tr>`
            $("#tbody").append(tr);
            $("#loading").hide();
        }
    })

}
</script>
<script>
    function add_token_Row(id){
        var head_sub_id = id;
        var row =` <tr>
                        <td><input type="text" name="token-${head_sub_id}[]" class="form-control input-sm"></td>
                        <td><input type="text" name="token_amount-${head_sub_id}[]" value="1" min="1" onkeyup="calculateTotal_token(${head_sub_id})" class="form-control input-sm"></td>
                        <td><a href="javascript:void(0)" onclick="remove_token_Row(this,${head_sub_id})" class="btn btn-danger btn-sm" style="padding: 3px;"><i class="fa fa-times"></i></a></td>
                    </tr>`
        $("#token-row-"+head_sub_id).append(row);
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
function calculateTotal_token(id) {
    var total = 1; // Initialize total to 1 for multiplication
    $("input[name='token_amount-"+id+"[]']").each(function() {
        total *= parseInt($(this).val());
    });
    $(".token_amount_"+id).val(total);
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