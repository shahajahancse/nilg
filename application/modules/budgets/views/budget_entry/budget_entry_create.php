
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<style>
   .chosen-single {
    height: 30px !important;
    border: 1px solid #00a59a !important;
}
</style>

<div class="page-content">
    <div class="content">
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard')?>" class="active" > Dashboard </a></li>
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
                            <a href="<?=base_url('budgets/budget_entry')?>"
                                class="btn btn-blueviolet btn-xs btn-mini">বাজেট তাকিকা</a>
                        </div>
                    </div>
                    <div class="grid-body">
                        <?php if($this->session->flashdata('success')):?>
                        <div class="alert alert-success">
                            <?=$this->session->flashdata('success');;?>
                        </div>
                        <?php endif; ?>  <?php if($this->session->flashdata('error')):?>
                        <div class="alert alert-danger">
                            <?=$this->session->flashdata('error');;?>
                        </div>
                        <?php endif; ?>

                        <?php
                            $attributes = array('id' => 'jsvalidate');
                            echo form_open_multipart("budgets/budget_entry_create",$attributes);
                            echo validation_errors();
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset style="background: #fff !important;">
                                    <legend>বাজেট তথ্য</legend>
                                    <div class="row form-row" style="font-size: 16px; color: black; margin-top: -20px !important;">
                                        <br>
                                        <div class="col-md-3">
                                            <label for="title" class="control-label">শিরোনাম : </label>
                                            <input type="text" class="form-control input-sm" name="title"
                                                style="min-height: 33px;" value="" required>
                                        </div>
                                        <div class="col-md-2">
                                            <?php $session_year=$this->db->get('session_year')->result();?>

                                            <label for="fcl_year" class="control-label">অর্থবছর</label>
                                            <select name="fcl_year" id="fcl_year" class="form-control input-sm">
                                                <option value="">নির্বাচন করুন</option>
                                                <?php foreach ($session_year as $key => $value) {
                                                      echo '<option value="'.$value->id.'">'.$value->session_name.'</option>';
                                                   } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="quarter" class="control-label">কোয়ার্টার</label>
                                            <select name="quarter" id="quarter" class="form-control input-sm" required>
                                            <!-- enum('1st', '2nd', '3rd', '4th', 'others') -->
                                                <option value="">নির্বাচন করুন</option>
                                                <option value="1st">1st</option>
                                                <option value="2nd">2nd</option>
                                                <option value="3rd">3rd</option>
                                                <option value="4th">4th</option>
                                                <option value="others">Others</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="type" class="control-label">বাজেট টাইপ</label>
                                            <select name="type" id="type" class="form-control input-sm" required>
                                                <option value="">নির্বাচন করুন</option>
                                                <option value="1">Revenue</option>
                                                <option value="2">Auditorium</option>
                                                <option value="3">Library</option>
                                                <option value="4">Publication</option>
                                                <option value="5">Others</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="type" class="control-label">বাজেট পরিমাণ</label>
                                            <input type="number" value="0" min="0" class="form-control input-sm" id="budget_amount" name="budget_amount" required>
                                        </div>
                                    </div>

                                    <div class="row form-row">
                                        <div class="col-md-12">
                                            <h4 class="semi-bold margin_left_15">বাজেট তালিকা <em
                                                    style="color: #f73838; font-size: 15px;">Click <strong>Add
                                                        More</strong> button for adding more item. </em></h4>
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
                                            <div class="col-md-12" >
                                                <div class="col-md-12" style="margin:0px;padding:0px">
                                                   <div class="col-md-4 margin_top_10 " style="margin:0px;padding:0px">
                                                      <label for="">বাজেট হেড</label>
                                                      <select name="head" id="head_id" class="form-control" onchange="addNewRow(this.value)">
                                                         <option value="">নির্বাচন করুন</option>
                                                         <?php foreach ($budget_head_sub as $key => $value) {
                                                            echo '<option value="'.$value->id.'">'.$value->budget_head_name.'>>'.$value->name_bn.'</option>';
                                                         }?>
                                                      </select>
                                                   </div>
                                                   <div class="col-md-2" >
                                                      <img id="loading" src="<?=base_url('img/loading.gif') ?>" style="height: 47px;margin-top: 14px;display: none;">
                                                   </div>
                                                   <div class="col-md-3" style="visibility: hidden">
                                                      <label for="">বাকি টাকা</label>
                                                      <input type="number" value="0" min="0" class="form-control input-sm" name="rest_amount" id="rest_amount" readonly>

                                                   </div>
                                                   <div class="col-md-3">
                                                      <label for="">মোট টাকা</label>
                                                      <input type="number" class="form-control input-sm" name="total_amount" id="total_amount" readonly>
                                                   </div>

                                                </div>
                                                <table class="col-md-12" width="100%" border="1" style="border:1px solid #a09e9e; margin-top: 10px;" id="appRowDiv">
                                                    <thead>
                                                       <tr>
                                                           <th width="30%">বাজেট হেড<span class="required">*</span></th>
                                                           <th width="30%">বাজেট কোড<span class="required">*</span></th>
                                                           <th width="30%">পরিমাণ</th>
                                                           <th width="10%">অ্যাকশন</th>
                                                       </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="pull-right">
                                <input type="submit" name="submit" id="submit_btn" value="সংরক্ষণ করুন" class="btn btn-primary btn-cons">
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
    $("#total_amount").trigger('change');

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
           url: "<?=base_url('budgets/add_new_row') ?>",
           data: {
               head_id: head_id
           },
           success: function(data) {
            var data=JSON.parse(data);
            var tr=`<tr>
                        <td style="padding:0px 10px">${data.name_bn}</td>
                        <td style="padding:0px 10px">${data.bd_code}</td>
                        <td style="padding:0px 10px">
                        <input type="hidden" name="head_id[]" value="${data.budget_head_id}" >
                        <input type="hidden" name="head_sub_id[]" value="${data.id}" >
                        <input value="0" min="0" type="number" onkeyup="calculateTotal()" name="amount[]" class="form-control amount input-sm">
                        </td>
                        <td style="padding:0px 10px"><a href="javascript:void(0)" onclick="removeRow(this)" class="btn btn-danger btn-sm" style="padding: 3px;"><i class="fa fa-times"></i> Remove</a></td>
                     </tr>`
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
       $("#total_amount").trigger('change');
   }
</script>
<script>
      $(document).ready(function() {
         calculateTotal()

      })
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<script>
  $(document).ready(function(){
   $('#fcl_year').chosen();
   $('#head_id').chosen();
   $('#quarter').chosen();
   $('#type').chosen();
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
    $("#total_amount").change(function(){
        var total_amount = parseFloat($("#total_amount").val()) || 0;
        var rest_amount = $("#rest_amount");
        var budget_amount = parseFloat($("#budget_amount").val()) || 0;
        rest_amount.val(budget_amount - total_amount);
        if (rest_amount.val()!=0){
            $("#submit_btn").prop('disabled', true);
        } else {
            $("#submit_btn").prop('disabled', false);
        }
    })
    $('#budget_amount').keyup(function(){
        $("#total_amount").trigger('change');
    })
</script>
