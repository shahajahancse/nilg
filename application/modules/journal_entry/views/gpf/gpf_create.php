
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
            <li><a href="<?=base_url('dashboard')?>" class="active" > Dashboard </a></li>
            <li><a href="<?=base_url('journal_entry/gpf_entry')?>" class="active"><?=$module_name?></a></li>
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
                            <a href="<?=base_url('journal_entry/gpf_entry')?>"
                                class="btn btn-blueviolet btn-xs btn-mini">তালিকা</a>
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
                            echo form_open_multipart("journal_entry/gpf_create",$attributes);
                            echo validation_errors();
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset style="background: #fff !important;">
                                    <div class="col-md-12"
                                        style="padding: 20px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                                        <div>
                                            <span style="font-size: 22px;font-weight: bold;text-decoration: underline;">জিপিএফ তথ্য</span>
                                        </div>
                                    </div>
                                    <div class="row form-row" style="font-size: 16px; color: black; margin-top: -20px !important;">
                                        <br>
                                        <div class="col-md-4">
                                            <label for="title" class="control-label">কর্মকর্তা/কর্মচারী নাম <span style="color:red">*</span> </label>
                                            <select required name="user_id" class="form-control input-sm" style="width: 100%; height: 28px !important;">
                                                <?php
                                                    $this->db->select('emp.*, users.name_bn');
                                                    $this->db->from('budget_j_gpf_emp emp');
                                                    $this->db->join('users', 'emp.user_id = users.id');
                                                    $users = $this->db->where('emp.status', 1)->get()->result();
                                                ?>
                                                <option value="">নির্বাচন করুন</option>
                                                <?php foreach ($users as $key => $value) { ?>
                                                    <option value="<?= $value->user_id ?>"><?= $value->name_bn ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3" >
                                            <?php $session_year=$this->db->order_by('id','desc')->get('session_year')->result();?>
                                            <label for="fcl_year" class="control-label">অর্থবছর <span class="required">*</span></label>
                                            <select name="fcl_year" id="fcl_year" class="form-control input-sm" style="width: 100%; height: 28px !important;" required>
                                                <option value='' selected>নির্বাচন করুন</option>
                                                <?php foreach ($session_year as $key => $value) {
                                                        echo '<option value="'.$value->id.'">'.$value->session_name.'</option>';
                                                    } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3" >
                                            <label for="fcl_year" class="control-label">আগের বালান্স <span class="required">*</span></label>
                                            <input type="number" min="0"  name="pbalance" class="form-control input-sm">

                                        </div>
                                    </div>
                                    <br>

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
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table width="100%" border="1"
                                                style="border:1px solid #a09e9e; margin-top: 10px;" id="appRowDiv">
                                                <thead>
                                                    <tr>
                                                        <th >মাসের নাম<span class="required"> * </span></th>
                                                        <th width="">সামগ্রিক চাঁদা <span class="required"> * </span></th>
                                                        <th width="">অগ্রীম আদায়<span class="required"> * </span></th>
                                                        <th width="">মোট </th>
                                                        <th width="">অগ্রীম উত্তোলন<span class="required"> * </span></th>
                                                        <th width="">মাসিক জের</th>
                                                        <th width="">মন্তব্য </th>
                                                    </tr>
                                                </thead>
                                                <?php $session_month=$this->db->get('session_month')->result();?>
                                                <tbody id="tbody">
                                                    <?php foreach ($session_month as $key => $value) { ?>
                                                        <tr>
                                                            <td width="10%"><?= $value->month_bn ?>
                                                                <input type="hidden" name="month[]" value="<?= $value->id ?>">
                                                            </td>

                                                            <td><input type="number" min="0" value="0" name="curr_amt[]" class="form-control input-sm curr_amt" style="min-height: 33px;" required onkeyup="getBalance(this)"></td>

                                                            <td><input type="number" min="0"  value="0" name="adv_amt[]" class="form-control input-sm adv_amt" style="min-height: 33px;" required onkeyup="getBalance(this)"></td>

                                                            <td width="8%"><input type="number"  value="0" min="0"  name="mot_amt[]" class="form-control input-sm mot_amt" style="min-height: 33px;" readonly></td>

                                                            <td><input type="number" min="0"  value="0"  name="adv_withdraw[]" class="form-control input-sm adv_withdraw" style="min-height: 33px;" required onkeyup="getBalance(this)"></td>

                                                            <td width="10%"><input type="number"  value="0" min="0" name="balance[]" class="form-control input-sm balance" style="min-height: 33px;" readonly></td>

                                                            <td width="30%" ><input type=""  name="comment[]" class="form-control input-sm comment" style="min-height: 33px;"></td>
                                                        </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <td width="10%">মোট : </td>

                                                        <td><input type="number" min="0" id="total_curr_amt" name="total_curr_amt" class="form-control input-sm" style="min-height: 33px;" readonly></td>

                                                        <td><input type="number" min="0" id="total_adv_amt" name="total_adv_amt" class="form-control input-sm" style="min-height: 33px;" readonly ></td>

                                                        <td width="10%"><input type="number" min="0" id="total_mot_amt" name="total_mot_amt" class="form-control input-sm" style="min-height: 33px;"   readonly ></td>

                                                        <td><input type="number" min="0" id="total_adv_withdraw" name="total_adv_withdraw" class="form-control input-sm" style="min-height: 33px;"  readonly></td>

                                                        <td width="10%"><input type="number" min="0" id="total_balance" name="total_balance" class="form-control input-sm" style="min-height: 33px;" readonly></td>

                                                        <td width="30%" ></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="col-md-12">
                                            <span>নোট</span>
                                            <textarea name="description" id="" class="form-control input-sm"> </textarea>
                                        </div>
                                    </div>

                                    <br>
                                    <div class="pull-right">
                                        <input type="submit" name="submit" id="submit_btn" value="সংরক্ষণ করুন" class="btn btn-primary btn-cons" style="margin-right: 0px !important;">
                                    </div>
                                </fieldset>
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
    function getBalance(el) {
        //get all input
        var curr_amt_el = $(el).closest('tr').find('.curr_amt');
        var adv_amt_el = $(el).closest('tr').find('.adv_amt');
        var mot_amt_el = $(el).closest('tr').find('.mot_amt');
        var adv_withdraw_el = $(el).closest('tr').find('.adv_withdraw');
        var balance_el = $(el).closest('tr').find('.balance');

        // calculate balance
        var mot_amt = parseInt(curr_amt_el.val()) + parseInt(adv_amt_el.val());
        var balance=parseInt(mot_amt) - parseInt(adv_withdraw_el.val());
        // insert only input
        mot_amt_el.val(mot_amt);
        balance_el.val(balance);

        cal_table_footer();
    }
</script>

<script>
    function cal_table_footer(){

        var total_curr_amt = 0;
        $('.curr_amt').each(function() {
           total_curr_amt += parseInt($(this).val());
        })
        $('#total_curr_amt').val(total_curr_amt);

        var total_adv_amt = 0;
        $('.adv_amt').each(function() {
           total_adv_amt += parseInt($(this).val());
        })
        $('#total_adv_amt').val(total_adv_amt);

        var total_mot_amt = 0;
        $('.mot_amt').each(function() {
           total_mot_amt += parseInt($(this).val());
        })
        $('#total_mot_amt').val(total_mot_amt);

        var total_adv_withdraw = 0;
        $('.adv_withdraw').each(function() {
           total_adv_withdraw += parseInt($(this).val());
        })
        $('#total_adv_withdraw').val(total_adv_withdraw);

        var total_balance = 0;
        $('.balance').each(function() {
           total_balance += parseInt($(this).val());
        })
        $('#total_balance').val(total_balance);



    }
</script>
