<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<style>
    .chosen-single {
        height: 30px !important;
        border: 1px solid #00a59a !important;
    }
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
    .form-control {
        height: 10px !important;
        padding: 0px !important;
        min-height: 30px !important;
    }
    #appRowDiv td {
        padding: 3px !important;
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
                            <a href="<?=base_url('budgets/budget_field')?>"
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
                            echo form_open_multipart(current_url(), $att); echo validation_errors();
                        ?>
                            <div class="row">
                                <div class="col-md-12"
                                    style="padding:10px; display: flex;flex-direction: row;justify-content: center;align-items: center;">
                                    <div>
                                        <span style="font-size: 22px;font-weight: bold;text-decoration: underline;"><?=$meta_title?></span>
                                    </div>
                                </div>
                                <div class="row form-row" style="font-size: 16px; color: black;">
                                    <div class="col-md-12" style='margin-bottom:10px'>
                                        <div class="col-md-6">
                                            অফিস নাম: <strong><?=$budget_field->office_name?></strong>
                                        </div>
                                        <div class="col-md-4">
                                            কোর্স নাম: <strong><?=$budget_field->course_title?></strong>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style='margin-bottom:10px'>
                                        <div class="col-md-3">
                                            অর্থবছর: <strong><?=$budget_field->session_name?></strong>
                                        </div>
                                        <div class="col-md-3">
                                            প্রশিক্ষণার্থীর সংখ্যা: <strong><?=$budget_field->trainee_number?></strong>
                                        </div>
                                        <div class="col-md-2">
                                            দিন: <strong><?=$budget_field->course_day?></strong>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="hidden" value='<?=$budget_field->amount?>' name="amount">
                                            সর্বমোট পরিমান: <strong><?=$budget_field->amount?></strong>
                                        </div>
                                        <input type="hidden" value='<?=$budget_field->amount?>' name="total_obosistho" id="total_obosistho">
                                    </div>
                                </div>


                                <div class="row form-row">
                                    <div class="col-md-12">
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
                                                        <th width="3%" >ক্রম</th>
                                                        <th style="text-align: left;" width="25%">শিরোনাম</th>
                                                        <th width="10%">বরাদ্দ</th>
                                                        <th width="12%">প্রকৃত ব্যয় (ভ্যাট, আইটি/উৎস কর ব্যতিত)</th>
                                                        <th width="10%">*ভ্যাট</th>
                                                        <th width="10%">*আইটি/উৎস কর</th>
                                                        <th width="10%">মোট ব্যয়</th>
                                                        <th width="10%">অবশিষ্ট বরাদ্দ</th>
                                                        <th width="10%">ভাউচার</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                    <?php foreach ($results as $key => $value) { ?>
                                                        <tr class="classThis">
                                                            <input type="hidden" name="details_id[]" value="<?=$value->id?>" >
                                                            <input type="hidden" name="head_id[]" value="<?=$value->head_id?>" >
                                                            <input type="hidden" name="head_obosistho[]" class ="all_obosistho oboshistho_<?=$value->head_id?>" value="0">
                                                            <input class="head_amt_<?=$value->head_id?>" type="hidden" name="head_amt[]" value="<?=$value->amount?>" >
                                                            <td colspan=""><?=eng2bng($key + 1)?> </td>
                                                            <td colspan="8"><?=$value->name_bn?> </td>
                                                        </tr>
                                                        <?php
                                                        $heads = [];
                                                        if (isset($value->id) && isset($value->head_id)) {
                                                            $this->db->select('r.*, b.name_bn, b.vat_head');
                                                            $this->db->from('budget_field_sub_details as r');
                                                            $this->db->join('budget_head_sub_training as b', 'b.id = r.head_sub_id');
                                                            $this->db->where('r.details_id', $value->id)->where('r.head_id', $value->head_id)->where('r.modify_soft_d', 1);
                                                            $heads = $this->db->get()->result();
                                                        }
                                                        ?>
                                                        <?php foreach ($heads as $r => $head) {
                                                            ?>
                                                            <tr class="side_css">
                                                                <input type="hidden" name="<?=$value->id?>_sub_de_id[]" value="<?=$head->id?>">
                                                                <input type="hidden" name="<?=$value->id?>_head_sub_amt[]" value="<?=$head->amount?>">
                                                                <td colspan=""><?=eng2bng($key + 1) .'.'. eng2bng($r + 1)?> </td>
                                                                <td width="fit-content"><?=$head->name_bn?></td>

                                                                <td><input class="form-control boraddo" readonly value="<?=$head->amount?>" ></td>

                                                                <td><input type="number" name="<?=$value->id?>_sub_sp_amt[]" class="form-control prokrito_bay" max="<?=$head->amount?>" onkeyup=calculateAll(this) ></td>

                                                                <td><input type="number" value="<?=$head->vat_head?>" name="<?=$value->id?>_vat[]" class="vat_p form-control" onkeyup=calculateAll(this)></td>

                                                                <td><input type="number" value="0" name="<?=$value->id?>_it_kor[]" class="form-control it_kor" onkeyup=calculateAll(this)></td>

                                                                <td><input type="number" value="0" name="<?=$value->id?>_subTotal[]" class="form-control mot_bay"  readonly></td>
                                                                <td><input type="number" value="0" name="<?=$value->id?>_balance[]" class="form-control obosistho" data-head_id="<?=$value->head_id?>"  readonly></td>
                                                                <td><input type="file" value="" class="form-control"></td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </tbody>
                                            </table>

                                            <div class="col-md-12" style="margin-top: 20px; padding: 0px;">
                                                <div class="form-group margin_top_10">
                                                    <label for=""> বিবরণ:</label>
                                                    <textarea class="form-control" name="description" id="description">
                                                    <?php echo $budget_field->description; ?>
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
    .side_css {
        border-left: 2px solid #11a8df;
        border-right: 2px solid #11a8df;
        border-bottom: 2px solid #11a8df;
    }
</style>

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
    $(document).ready(function() {
        calculateTotal()

    })
</script>

<script>
    function calculateAll(el) {
        var boraddo =$(el).closest("tr").find('.boraddo');
        var prokritoBay = $(el).closest("tr").find('.prokrito_bay');
        var vat = $(el).closest("tr").find('.vat_p');
        var itKor = $(el).closest("tr").find('.it_kor');
        var motBay = $(el).closest("tr").find('.mot_bay');
        var obosistho = $(el).closest("tr").find('.obosistho');

        if (prokritoBay.val() > 0) {

            var vatTaka = 0;
            if(vat.val() > 0){
                var vatTaka = parseFloat(prokritoBay.val()) * (vat.val() / 100);
            }else{
                var vatTaka = 0;
            }

            const itTaka = itKor.val() > 0 ? parseFloat(prokritoBay.val()) * (itKor.val() / 100) : 0;
            const motBayTaka = parseFloat(prokritoBay.val()) + vatTaka + itTaka;
            if ((boraddo.val() - motBayTaka).toFixed(2) < 0) {
                prokritoBay.val(0);
                alert('আপনি বরাদ্দ টাকার বেশি এন্ট্রি দিতে পারবেন না');
                 motBay.val(0);
                obosistho.val(boraddo.val());
                return false;
            }
            motBay.val(motBayTaka.toFixed(2));
            obosistho.val((boraddo.val() - motBayTaka).toFixed(2));

        } else {
            motBay.val(0);
            obosistho.val(boraddo.val());
        }
        var total_obosistho=0;
        $('.all_obosistho').each(function() {
            $(this).val(0);
        })
        $('.obosistho').each(function() {
            var head_id=''
            var ager_taka=0
            var notun_taka=0

            var el=$(this);
            total_obosistho += parseFloat(el.val());
            head_id=el.data('head_id')
            ager_taka=$('.oboshistho_'+head_id).val()
            if (ager_taka > 0) {
                ager_taka=parseFloat(ager_taka)
            }else{
                ager_taka=0
            }
            notun_taka=parseFloat(el.val())+parseFloat(ager_taka)
            $('.oboshistho_'+head_id).val(notun_taka)
        })
        $('#total_obosistho').val(total_obosistho);

    }
</script>

<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#description')).then(editor => {window.editor = editor;}).catch(error => {console.error(error);});
</script>
