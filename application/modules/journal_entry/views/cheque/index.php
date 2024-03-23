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
                        <div class="pull-right" style="display: flex;align-content: center;justify-content: center;flex-wrap: wrap;gap: 8px;">
                            <a href="<?=base_url('journal_entry/cheque_entry_create')?>" class="btn btn-blueviolet btn-xs btn-mini">চেক তৈরি করুণ</a>
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
                        <table class="table table-hover table-condensed" border="0">
                            <thead>
                                <tr>
                                    <th> ক্রম </th>
                                    <th>চেক নং</th>
                                    <th>পরিমাণ</th>
                                    <th>প্রদানের তারিখ</th>
                                    <th>স্ট্যাটাস</th>
                                    <th>রেফারেন্স</th>
                                    <!-- <th>বর্ণনা</th> -->
                                    <th style="text-align: right;">অ্যাকশন</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sl=$pagination['current_page']; foreach ($results as $row): $sl++; ?>
                                <tr>
                                    <td class="v-align-middle"><?=$sl.'.'?></td>
                                    <td class="v-align-middle"><?=$row->cheque_no; ?></td>
                                    <td class="v-align-middle"><?=$row->amount; ?></td>
                                    <td class="v-align-middle"><?=$row->issue_date; ?></td>
                                    <?php if ($row->type == 1) {
                                        $type = 'গৃহীত পরিমাণ';
                                    } else {
                                        $type = 'ছাড়কৃত পরিমাণ';
                                    } ?>
                                    <td class="v-align-middle"><?=$type; ?></td>
                                    <td class="v-align-middle"><?=$row->reference; ?></td>
                                    <td align="right">
                                        <div class="btn-group">
                                            <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                                            <button class="btn btn-mini btn-primary dropdown-toggle"
                                                data-toggle="dropdown"> <span class="caret"></span> </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a
                                                        href="<?php echo base_url('journal_entry/cheque_entry_details/'.encrypt_url($row->id))?>"><i
                                                            class="fa fa-pencil-square"></i> বিস্তারিত </a></li>
                                                <li><a
                                                        href="<?php echo base_url('journal_entry/cheque_entry_edit/'.encrypt_url($row->id))?>"><i
                                                            class="fa fa-pencil-square"></i> সংশোধন করুন </a></li>
                                                <li><a href="<?php echo base_url('journal_entry/cheque_entry_delete/'.encrypt_url($row->id))?>"><i
                                                            class="fa fa-pencil-square"></i>ডিলিট করুন</a></li>
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
                                    চেক  </span></div>
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
