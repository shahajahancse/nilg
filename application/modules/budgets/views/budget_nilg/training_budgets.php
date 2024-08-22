<div class="page-content">
    <div class="content">
        <ul class="breadcrumb" style="margin-bottom: 20px;">
            <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
            <li> <a href="javascript:void()" class="active"> <?=$module_name?> </a></li>
            <li> <?=$meta_title;?> </li>
        </ul>

        <div class="row">
            <div class="col-md-12">
                <div class="grid simple ">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                        <div class="pull-right"
                            style="display: flex;align-content: center;justify-content: center;flex-wrap: wrap;gap: 8px;">

                            <?php if( $this->ion_auth->in_group(array('admin', 'nilg'))){ ?>
                            <a class="btn btn-success btn-xs btn-mini"
                                href="<?php echo base_url('budgets/nilg_revenue_summary') ?>" target="_blank"><i
                                    class="fa fa-book"></i> রিভিনিও সামারী </a>
                            <?php }  ?>
                            <?php if( $this->ion_auth->in_group(array('admin', 'bdh'))){ ?>
                            <a href="<?=base_url('budgets/dpt_summary')?>" class="btn btn-blueviolet btn-xs btn-mini"  > সামারী তালিকা </a>
                            <a class="btn btn-success btn-xs btn-mini" target="_blank" onclick="dpt_summary()" ><i class="fa fa-book"></i> সামারী করুন </a>
                            <?php }  ?>
                            <a href="<?=base_url('budgets/training_budgets_create')?>" class="btn btn-blueviolet btn-xs btn-mini">বাজেট তৈরি করুণ</a>
                        </div>
                    </div>

                    <div class="grid-body ">
                        <?php if($this->session->flashdata('success')):?>
                        <div class="alert alert-success">
                            <?=$this->session->flashdata('success');?>
                        </div>
                        <?php endif; ?>

                        <style type="text/css">
                            .btt-m,
                            .btt-m:focus,
                            .btt-m:active:focus,
                            .btt-m.active:focus {
                                outline: none !important;
                                padding: 5px 25px !important;
                                margin-top: 0px;
                            }

                            .btt-t,
                            .btt-t:focus,
                            .btt-t:active:focus,
                            .btt-t.active:focus,
                            .btt-t:hover {
                                outline: none !important;
                                padding: 5px 25px !important;
                                margin-top: 0px !important;
                                width: 40px !important;
                                background: #ddb90a;
                            }
                        </style>
                        <?php if( $this->ion_auth->in_group(array('admin','nilg'))){ ?>
                        <form target="_blank" action="<?=base_url('budgets/nilg_revenue_summary') ?>" method="post"
                            style="margin-top: -10px">
                            <div class="col-md-3 p5">
                                <div class="form-group">
                                    <?php $dpts = $this->db->get('department')->result(); ?>
                                    <select name="dept_id" id="dept_id"
                                        onchange="$('#summary_dept_id').val($(this).val());"
                                        class="form-control input-sm" required>
                                        <option value=""> <-- select --> </option>
                                        <?php foreach ($dpts as $key => $r) { ?>
                                        <option value="<?= $r->id ?>"><?= $r->dept_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <input class="btn btn-primary btn-xs" type="submit" value="সামারী করুন" target="_blank"
                                style="padding: 6px;margin-top: 6px;">
                        </form>
                        <?php } ?>
                        <table class="table table-hover table-condensed data_table" border="0">
                            <thead>
                                <tr>
                                    <th style="width: 10%"> ক্রম </th>
                                    <th>শিরোনাম</th>
                                    <th>বিভাগ</th>
                                    <th>অর্থবছর</th>
                                    <th>পরিমাণ</th>
                                    <th>ডেস্ক</th>
                                    <!-- <th>ডেস্কিপশন</th> -->
                                    <th>স্ট্যাটাস</th>
                                    <th>আপডেট তারিখ</th>
                                    <th style="text-align: right;">অ্যাকশন</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sl=$pagination['current_page'];
                                foreach ($results as $row): $sl++; ?>
                                    <tr>
                                        <td class="v-align-middle"><?=$sl.'.'?> <input type="checkbox" class="check" name="check[]" value="<?=$row->id; ?>"> </td>
                                        <td class="v-align-middle"><?=$row->title; ?></td>
                                        <td class="v-align-middle"><?=$row->dept_name; ?></td>
                                        <td class="v-align-middle"><?=$row->session_name; ?></td>
                                        <td class="v-align-middle"><?=$row->amount; ?></td>
                                        <td class="v-align-middle">
                                            <!-- // 1=current, 2=forward dpt, 3=forward acc., 4=dg, 5=back acc, 6=complete, -->
                                            <?php
                                                if($row->desk==1){
                                                echo 'Current';
                                                }elseif($row->desk==2){
                                                echo 'Department';
                                                }elseif($row->desk==3){
                                                echo 'Account';
                                                }elseif($row->desk==4){
                                                echo 'DG Sir';
                                                }elseif($row->desk==5){
                                                echo 'back Acc.';
                                                }elseif($row->desk==6){
                                                echo 'Complete';
                                                }
                                            ?>
                                        </td>
                                        <!-- <td class="v-align-middle" style="width: 200px; white-space: normal;overflow: hidden" title="<?=$row->description; ?>"><?=$row->description; ?></td> -->
                                        <td class="v-align-middle">
                                            <!-- 1=pending,2=dpt. app., 3=reject, 4=acc., 5=dg, 6=draft, 7=revenue received -->
                                            <?php if($row->status==1){
                                                echo '<span class="label label-info">Draft </span>';
                                            }elseif($row->status==2){
                                                echo '<span class="label label-warning">On Precess</span>';
                                            }elseif($row->status==3){
                                                echo '<span class="label label-primary">Department Approve </span>';
                                            }elseif($row->status==4){
                                                echo '<span class="label label-info">Account. Approve </span>';
                                            }elseif($row->status==5){
                                                echo '<span class="label label-success">DG. Approve </span>';
                                            }elseif($row->status==6){
                                                echo '<span class="label label-success">Revenue Received </span>';
                                            }elseif($row->status==7){
                                                echo '<span class="label label-important">Rejected </span>';
                                            }
                                            ?>
                                        </td>

                                        <td class="v-align-middle"><?=date_bangla_calender_format($row->update_at); ?>
                                        </td>
                                        <td align="right">
                                            <div class="btn-group">
                                                <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                                                <button class="btn btn-mini btn-primary dropdown-toggle"
                                                    data-toggle="dropdown"> <span class="caret"></span> </button>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a
                                                            href="<?php echo base_url('budgets/budget_nilg_details/'.encrypt_url($row->id))?>"><i
                                                                class="fa fa-pencil-square"></i> বিস্তারিত </a></li>
                                                    <li><a
                                                            href="<?php echo base_url('budgets/budget_nilg_details/'.encrypt_url($row->id))?>"><i
                                                                class="fa fa-pencil-square"></i> সংশোধন করুন </a></li>
                                                    <li><a id="modalId" data-toggle="modal" data-target="#myModal"
                                                            data-id="<?=encrypt_url($row->id) ?>" href=""><i
                                                                class="fa fa-user"></i> রিভিও</a></li>

                                                    <li>
                                                        <a href="<?php echo base_url('budgets/budget_nilg_print/'.encrypt_url($row->id))?>"
                                                            target="_blank"><i class="fa fa-pencil-square"></i> প্রিন্ট করুন
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> সর্বমোট <span
                                    style="color: green; font-weight: bold;"><?php echo eng2bng($total_rows); ?>
                                    বাজেট  </span></div>
                            <div class="col-sm-8 col-md-8 text-right">
                                <?php echo $pagination['links']; ?>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div> <!-- END Content -->
</div>



<!-- The Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header priview-body" style="padding: 15px 15px 0px 15px !important;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <?php $this->load->view('nilg_head'); ?>
                <div class="heading-main">
                    <div class="headding-title" id="heading_title"> </div>
                </div>
            </div>

            <div class="modal-body body-modal">
                <table class="table table-hover table-condensed" border="0" id="addRow">
                    <tr>
                        <th>ক্রম</th>
                        <th>বিষয়</th>
                        <th>পরিমাণ</th>
                        <th>ডিপার্টমেন্ট পরিমাণ</th>
                        <th>আক্কাউন্ট পরিমাণ</th>
                        <th>ডিজি পরিমাণ</th>
                    </tr>
                </table>

                <div class="budget-main">
                    <div class="budget-text" id="budget_text"> </div>
                </div>
            </div>

            <div class="modal-footer">
                <!-- <button type="button" id="smSend" class="btn btn-info">প্রিন্ট করুন</button> -->
                <button type="button" class="btn btn-default" data-dismiss="modal">বন্ধ করুন</button>
                <!-- <button type="submit" id="smSend" class="btn btn-primary">সংরক্ষণ করুন</button> -->
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .priview-body {
        font-size: 16px;
        color: #000;
        border-bottom: 0px !important;
    }

    .priview-header div {
        font-size: 18px;
        text-align: center;
    }

    .priview-demand {
        padding-bottom: 20px;
        margin-top: 10px;
    }

    .heading-main {
        text-align: center;
    }

    .headding-title {
        font-size: 18px;
        padding: 1px 5px !important;
        display: initial;
    }

    .body-modal {
        background: #fff !important;
    }

    #addRow {
        width: 100%;
        border-collapse: collapse;
    }

    #addRow>tbody>tr>th,
    #addRow>tbody>tr>td,
    #addRow>tfoot>tr>td {
        border: 1px solid #448dc7 !important;
    }

    .text-center {
        text-align: center;
    }
</style>



<script type="text/javascript">
    function dpt_summary() {
        var form = document.createElement('form');
        form.action = "<?=base_url('budgets/dpt_summary_create') ?>";
        form.method = "POST";
        var checkboxes = $('.check:checked');
        var vals = "";
        for (var i=0, n=checkboxes.length;i<n;i++)
        {
            var field = document.createElement('input');
            field.type = "hidden";
            field.name = "id[]";
            field.value = checkboxes[i].value;
            form.appendChild(field);

            if (checkboxes[i].checked)
            {
                vals += ","+checkboxes[i].value;
            }
        }

        if (vals) vals = vals.substring(1);
        if (vals == "") {
            alert('অনুগ্রহ করে অন্তত একটি আইটেম নির্বাচন করুন');
            return false;
        }

        document.body.appendChild(form);
        form.submit();
    }
</script>


<script type="text/javascript">
$(document).ready(function() {
    // requisition item delete
    $(document).on("click", "#smSend", function() {
        var id = $(this).attr('data-id');
        var url = "<?php echo base_url('budgets/nilg_change_status'); ?>";
        $.ajax({
            type: "POST",
            url: url,
            data: {
                type: 1,
                id: id
            },
            dataType: 'json',
            success: function(response) {
                if (response.status == 1) {
                    $('#myModal').modal('hide');
                }
            }
        });
    });

    $(document).on("click", "#modalId", function() {
        var data_id = $(this).attr('data-id');

        var sendData = {
            type: 2,
            id: data_id
        };
        var url = "<?php echo base_url('budgets/ajax_get_budget_details_nilg'); ?>";
        $.ajax({
            url: url,
            data: sendData,
            type: "POST",
            success: function(response) {
                var sl = 0;
                $('.adds').remove();
                $('#heading_title').empty().text('শিরোনাম : ' + response.budget_info.title);

                $.each(response.budget_dtails, function(id, res) {
                    sl = sl + 1;
                    var items = '';
                    items += '<tr class="adds">';
                    items += '<td>' + sl + '</td>';
                    items += '<td>' + res.name_bn + '</td>';
                    items += '<td>' + res.amount + '</td>';
                    items += '<td>' + res.dpt_amt + '</td>';
                    items += '<td>' + res.acc_amt + '</td>';
                    items += '<td>' + res.dg_amt + '</td>';
                    items += '</tr>';
                    $('#addRow tr:last').after(items);
                });
                var item = '';
                item += '<tr class="adds">';
                item += '<td colspan="2">Total</td>';
                item += '<td>' + response.budget_info.amount + '</td>';
                item += '<td>' + response.budget_info.dpt_amt + '</td>';
                item += '<td>' + response.budget_info.acc_amt + '</td>';
                item += '<td>' + response.budget_info.dg_amt + '</td>';
                item += '</tr>';

                $('#addRow tr:last').after(item);
                $('#budget_text').empty().html(response.budget_info.description);

                $('#smSend').attr('data-id', data_id);
            }
        });
    });
});
</script>
