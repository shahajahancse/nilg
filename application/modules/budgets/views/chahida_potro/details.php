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
                        <?php endif; ?> <?php if($this->session->flashdata('error')):?>
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
                                <div class="col-md-12"
                                        style="padding: 20px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                                        <div>
                                            <span
                                                style="font-size: 22px;font-weight: bold;text-decoration: underline;">চাহিদাপত্র  তৈরি করুন</span>
                                        </div>
                                    </div>                                    <div class="row form-row" style="font-size: 16px; color: black;">
                                        <div class="col-md-12" style="display: flex;gap: 74px;padding-bottom: 7px;">
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
                                            <label for="title" class="control-label">শিরোনাম :
                                                <span><?=$chahida_potro->title?></span> </label>

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
                                                    border-top: 2px solid #31708f;
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
                                                <table class="col-md-12" width="100%" border="1"
                                                    style="border:1px solid #a09e9e; margin-top: 10px;" id="appRowDiv">
                                                    <thead>
                                                        <tr>
                                                            <!-- <th width="30%">বাজেট হেড<span class="required">*</span></th> -->
                                                            <th width="30%">শিরোনাম<span class="required">*</span></th>
                                                            <th width="30%">কোড<span class="required">*</span></th>
                                                            <th width="30%">পরিমাণ</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                        <?php 
                                                          $group_name=''; 
                                                          $end=false;
                                                          $end1=false;
                                                        
                                                        foreach($details as $details){
                                                            if($group_name!=$details->group_name && $details->group_name!='xnone'){
                                                                echo '<tr class="group-header group-header-'.$details->group_name.'">
                                                                <td colspan="5">
                                                                    <b>'.$details->group_name.'</b>
                                                                </td>
                                                            </tr>';
                                                                $group_name=$details->group_name;
                                                            }elseif($details->group_name=='xnone'){
                                                                $end=true;
                                                                $group_name=$details->group_name;
                                                            }
    


                                                            ?>
                                                        <?php if($end==false){?>
                                                    <tr class="group-row group-row-<?=$details->group_name?>">
                                                        <?php }elseif($end==true && $end1==false){ $end1=true;?>
                                                    <tr class="group-end-row">
                                                        <?php }else{?>
                                                            <tr>
                                                            <?php }?>
                                                            <td><?=$details->budget_head_name?> <?=$details->name_bn?>
                                                            </td>
                                                            <td><?=$details->bd_code?></td>
                                                            <td><?=$details->amount?></td>
                                                        </tr>
                                                        <?php }?>

                                                    </tbody>
                                                </table>

                                                <div class="col-md-12" style="margin-top: 20px; padding: 0px;">
                                                    <div class="form-group margin_top_10">
                                                        <label for=""> বিবরণ:</label>
                                                        <?=$chahida_potro->description?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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