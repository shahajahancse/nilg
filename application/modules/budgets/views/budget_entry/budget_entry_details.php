
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
                                    <div class="row form-row" style="font-size: 16px; color: black;">
                                        <br>
                                        <div class="col-md-3">
                                            <label for="title" class="control-label">টাইটেল : </label>
                                            <strong><?php  echo $budgets->title; ?></strong>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="fcl_year" class="control-label">অর্থবছর</label>
                                            <strong><?php echo $budgets->session_name; ?></strong>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="quarter" class="control-label">কোয়াটার</label>
                                            <strong><?php echo $budgets->quarter; ?></strong>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="type" class="control-label">বাজেট টাইপে</label>
                                            <strong>
                                            <?php
                                    if($budgets->type==1){
                                        echo 'Revenue';
                                    }elseif($budgets->type==2){
                                        echo 'Auditorium';
                                    }elseif($budgets->type==3){
                                        echo 'Library';
                                    }elseif($budgets->type==4){
                                        echo 'Publication';
                                    }elseif($budgets->type==5){
                                        echo 'Others';
                                    }
                                    ?>
                                            </strong>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="type" class="control-label">বাজেট আমাউন্ট</label>
                                            <strong><?php echo $budgets->amount; ?></strong>
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
                                                <table class="col-md-12" width="100%" border="1" style="border:1px solid #a09e9e; margin-top: 10px;" id="appRowDiv">
                                                    <thead>
                                                       <tr>
                                                           <th width="30%">বাজেট হেড<span class="required">*</span></th>
                                                           <th width="30%">বাজেট সাব হেড <span class="required">*</span></th>
                                                           <th width="30%">বাজেট আমাউন্ট</th>
                                                       </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                        <?php
                                                        // dd($details);
                                                            $sl=1;
                                                            foreach ($details as $key => $value) {
                                                                echo '<tr>
                                                                         <td>'.$value->budget_head_name.'</td><td>'.$value->name_bn.'</td><td>'.$value->amount.'</td></tr>';
                                                            }
                                                        ?>

                                                    </tbody>
                                                </table>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div> <!-- END GRID BODY -->
                </div> <!-- END GRID -->
            </div>
        </div> <!-- END ROW -->
    </div>
</div>
