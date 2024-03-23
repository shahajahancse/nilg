
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
                                class="btn btn-blueviolet btn-xs btn-mini">চাহিদাপত্র তাকিকা</a>
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
                        echo form_open_multipart("budgets/chahida_potro_create",$attributes);
                        echo validation_errors();
                        ?>

                        <div class="row">
                            <div class="col-md-12">
                                <fieldset style="background: #fff !important; ">
                                    <legend>চাহিদাপত্র তথ্য</legend>

                                    <div class="row form-row" style="font-size: 16px; color: black;">

                                        <div class="col-md-12" style="display: flex;gap: 74px;padding-bottom: 7px;" >
                                            <div style="width:fit-content;">
                                                আবেদনকারীর নাম: <strong><?=$info->name_bn?></strong>
                                            </div>

                                            <div style="width:fit-content;">
                                                পদবীর নাম: <strong><?=$info->current_desig_name?></strong>
                                            </div>
                                            <div style="width:fit-content;">
                                                ডিপার্টমেন্ট নাম: <strong><?=$info->current_dept_name?></strong>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-md-4">
                                            <label for="title" class="control-label">শিরোনাম : </label>
                                            <input type="text" class="form-control input-sm" name="title"
                                                style="min-height: 33px;" value="" required>
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
                                            <div class="col-md-12" >
                                                <div class="col-md-12" style="margin:0px;padding:0px">
                                                   <div class="col-md-4 margin_top_10 " style="margin:0px;padding:0px">
                                                   <label for=""> হেড নির্বাচন করুন</label>
                                                        <select name="head" id="head_id" class="form-control"
                                                            onchange="addNewRow(this.value)">
                                                            <option value=""> হেড নির্বাচন করুন</option>               
                                                            <?php foreach ($budget_head_sub as $key => $value) {
                                                              echo '<option value="'.$value->id.'">'.$value->budget_head_name.'>>'.$value->name_bn.' ('.$value->bd_code.')'.'</option>';

                                                         }?>
                                                        </select>
                                                   </div>
                                                   <div class="col-md-4" >
                                                      <img id="loading" src="<?=base_url('img/loading.gif') ?>" style="height: 47px;margin-top: 14px;display: none;">
                                                   </div>
                                                   <div class="col-md-4">
                                                      <label for="">সর্বমোট পরিমান</label>
                                                      <input type="number" class="form-control input-sm" name="total_amount" id="total_amount" readonly>
                                                   </div>
                                                </div>
                                                <table class="col-md-12" width="100%" border="1" style="border:1px solid #a09e9e; margin-top: 10px;" id="appRowDiv">
                                                    <thead>
                                                       <tr>
                                                           <!-- <th width="30%">বাজেট হেড<span class="required">*</span></th> -->
                                                           <th width="30%">শিরোনাম<span class="required">*</span></th>
                                                           <th width="30%">কোড<span class="required">*</span></th>
                                                           <th width="30%">পরিমাণ</th>
                                                           <th width="10%">অ্যাকশন </th>
                                                       </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                   
                                                    </tbody>
                                                </table>

                                                <div class="col-md-12" style="margin-top: 20px; padding: 0px;">
                                                    <div class="form-group margin_top_10">
                                                      <label for=""> বিবরণ:</label>
                                                    <textarea class="form-control" name="description" style="height: 300px;" id="description"><p></p><p></p></textarea>
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
                                <input type="submit" name="submit" value="সংরক্ষণ করুন" class="btn btn-primary btn-cons">
                            </div>
                        </div>
                        <?php echo form_close();?>
                    </div> <!-- END GRID BODY -->
                </div> <!-- END GRID -->
            </div>
        </div> <!-- END ROW -->
    </div>
</div>

