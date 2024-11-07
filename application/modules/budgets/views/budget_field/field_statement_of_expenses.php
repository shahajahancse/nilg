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
                                        <div class="col-md-6">
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
                                            ব্যাচ সংখ্যা: <strong><?=$budget_field->batch_number ?></strong>
                                        </div>
                                        <input type="hidden" value='0' name="total_obosistho" id="total_obosistho">
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
                                                <tr>
                                                    <th  >ক্রম</th>
                                                    <th style="text-align: left;">শিরোনাম</th>
                                                    <th >বরাদ্দ</th>
                                                    <th >মোট ব্যয়</th>
                                                    <th colspan="2" >ভ্যাট</th>
                                                    <th colspan="2" >আইটি/উৎস কর</th>
                                                    <th >প্রকৃত ব্যয় (ভ্যাট, আইটি/উৎস কর ব্যতিত)</th>
                                                    <th >অবশিষ্ট বরাদ্দ</th>
                                                    <th >ভাউচার</th>
                                                </tr>
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
                                                        $this->db->select('r.*, b.name_bn, b.vat_head, b.it_kar');
                                                        $this->db->from('budget_field_sub_details as r');
                                                        $this->db->join('budget_head_sub_training as b', 'b.id = r.head_sub_id');
                                                        $this->db->where('r.details_id', $value->id)->where('r.head_id', $value->head_id)->where('r.modify_soft_d', 1);
                                                        $heads = $this->db->get()->result();
                                                    }
                                                    ?>
                                                    <?php foreach ($heads as $r => $head) { ?>
                                                        <tr class="side_css">
                                                            <input type="hidden" name="<?=$value->id?>_sub_de_id[]" value="<?=$head->id?>">
                                                            <td colspan=""><?=eng2bng($key + 1) .'.'. eng2bng($r + 1)?> </td>
                                                            <td width="fit-content"><?=$head->name_bn?></td>

                                                            <td ><input style="text-align: right; padding-right: 10px !important" class="form-control boraddo" readonly value="<?=$head->total_amt * $budget_field->batch_number ?>" ></td>

                                                            <td><input type="number" value="0"  name="<?=$value->id?>_sub_sp_amt[]" class="form-control sub_sp_amt" onkeyup="calculateAll(this)" ></td>

                                                            <td><input type="number" value="<?=$head->vat_head?>" name="<?=$value->id?>_vat[]" class="vat form-control" readonly ></td>
                                                            <td><input type="number" value="0" name="<?=$value->id?>_vat_amt[]" class="vat_amt form-control" readonly></td>

                                                            <td><input type="number" value="<?= $head->it_kar ?>" name="<?=$value->id?>_it_kor[]" class="form-control it_kor" readonly></td>
                                                            <td><input type="number" value="0" name="<?=$value->id?>_it_kor_amt[]" class="form-control it_kor_amt" readonly></td>

                                                            <td><input type="number" value="0" name="<?=$value->id?>_prokrito_bay[]" class="form-control prokrito_bay"  readonly></td>

                                                            <td><input type="number" value="0" name="<?=$value->id?>_balance[]" class="form-control obosistho" data-head_id="<?=$value->head_id?>"  readonly></td>
                                                            <td><input type="file" value="" class="form-control"></td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                                <tr class="side_css">
                                                    <th colspan="3" style="text-align: right;"><?=$budget_field->amount * $budget_field->batch_number ?></th>

                                                    <th> <input type="number" id="sub_sp_amt_total_amt" class="form-control" readonly name="sp_total_amt" value="0" ></th>

                                                    <th></th>

                                                    <th> <input type="number" id="vat_amt_total_amt" class="form-control" readonly name="vat_total_amt" value="0" ></th>

                                                    <th></th>

                                                    <th> <input type="number" id="it_kor_amt_total_amt" class="form-control" readonly name="it_total_amt" value="0" ></th>

                                                    <th> <input type="number" id="prokrito_bay_total_amt" class="form-control" readonly name="prokrito_bay_total" value="0" ></th>

                                                    <th> <input type="number" id="obosistho_total_amt" class="form-control" readonly name="obosistho_total_amt" value="0" ></th>
                                                    <th></th>
                                                </tr>
                                            </table>

                                            <div style="clear:both"></div>
                                            <div class="col-md-12" style="margin-top: 20px; padding: 0px;">
                                                <div class="row form-row">
                                                    <div class="col-md-2">
                                                        <label for=""> ভ্যাট </label>
                                                        <input type="number" class="form-control" readonly id="final_vat" >
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for=""> চালান নং </label>
                                                        <input type="text" class="form-control" name="vat_chalan_no">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for=""> তারিখ </label>
                                                        <input type="text" class="datetime form-control" name="vat_chalan_date">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for=""> ব্যাংক </label>
                                                        <input type="text" class="form-control" name="vat_chalan_bank">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for=""> সংযুক্তি </label>
                                                        <input type="file" class="form-control" name="vat_chalan_attach">
                                                    </div>
                                                </div>
                                                <div class="row form-row" style="margin-top: 10px; margin-bottom: 10px;">
                                                    <div class="col-md-2">
                                                        <label for=""> আইটি </label>
                                                        <input type="number" class="form-control" readonly id="final_it_kar" >
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for=""> চালান নং </label>
                                                        <input type="text" class="form-control" name="it_chalan_no">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for=""> তারিখ </label>
                                                        <input type="text" class="datetime form-control" name="it_chalan_date">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for=""> ব্যাংক </label>
                                                        <input type="text" class="form-control" name="it_chalan_bank">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for=""> সংযুক্তি </label>
                                                        <input type="file" class="form-control" name="it_chalan_attach">
                                                    </div>
                                                </div>
                                                <div class="row form-row">
                                                    <div class="col-md-2">
                                                        <label for=""> অব্যয়িত অর্থ </label>
                                                        <input type="number" class="form-control" readonly id="final_obosisto" >
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for=""> চালান নং </label>
                                                        <input type="text" class="form-control" name="obs_chalan_no">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for=""> তারিখ </label>
                                                        <input type="text" class="datetime form-control" name="obs_chalan_date">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for=""> ব্যাংক </label>
                                                        <input type="text" class="form-control" name="obs_chalan_bank">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for=""> সংযুক্তি </label>
                                                        <input type="file" class="form-control" name="obs_chalan_attach">
                                                    </div>
                                                </div>
                                            </div>
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

        $id_data=['sub_sp_amt','vat_amt','it_kor_amt','prokrito_bay','obosistho'];
        $.each($id_data, function(key, value) {
            var total = 0;
            $("."+value).each(function() {
                total += parseInt($(this).val());
            })
            $("#"+value+"_total_amt").val(total);
        })

        $('#final_vat').val($('#vat_amt_total_amt').val())
        $('#final_it_kar').val($('#it_kor_amt_total_amt').val())
        $('#final_obosisto').val($('#obosistho_total_amt').val())
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
        var sub_sp_amt = $(el).closest("tr").find('.sub_sp_amt');
        var vat = $(el).closest("tr").find('.vat');
        var vat_amt = $(el).closest("tr").find('.vat_amt');
        var itKor = $(el).closest("tr").find('.it_kor');
        var itKor_amt = $(el).closest("tr").find('.it_kor_amt');
        var prokritoBay = $(el).closest("tr").find('.prokrito_bay');
        var obosistho = $(el).closest("tr").find('.obosistho');

        if (sub_sp_amt.val() > 0) {
            var vatTaka = 0;
            if(vat.val() > 0){
                var vatTaka = parseFloat(sub_sp_amt.val()) * (vat.val() / 100);
                vat_amt.val(vatTaka);
            }else{
                vat_amt.val(0);
                var vatTaka = 0;
            }

            var itTaka = 0;
            if(itKor.val() > 0){
                var itTaka = parseFloat(sub_sp_amt.val()) * (itKor.val() / 100);
                itKor_amt.val(itTaka);
            }else{
                itKor_amt.val(0);
                var itTaka = 0;
            }
            const motBayTaka = parseFloat(sub_sp_amt.val());
            if ((boraddo.val() - motBayTaka).toFixed(2) < 0) {
                sub_sp_amt.val('');
                vat_amt.val(0);
                itKor_amt.val(0);
                prokritoBay.val(0);
                alert('আপনি বরাদ্দ টাকার বেশি এন্ট্রি দিতে পারবেন না');
                obosistho.val(boraddo.val());
                return false;
            } else {
                obosistho.val((boraddo.val() - parseFloat(sub_sp_amt.val())).toFixed(2));
                const p_vay = parseFloat(sub_sp_amt.val() - vatTaka - itTaka);
                prokritoBay.val(p_vay.toFixed(2));
            }
        } else {
            sub_sp_amt.val('');
            prokritoBay.val(0);
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
        calculateTotal()
    }
</script>

<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#description')).then(editor => {window.editor = editor;}).catch(error => {console.error(error);});
</script>
