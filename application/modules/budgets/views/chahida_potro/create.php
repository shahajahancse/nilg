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
                            <a href="<?=base_url('budgets/chahida_potro')?>"
                                class="btn btn-blueviolet btn-xs btn-mini">চাহিদাপত্র তালিকা</a>
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
                                    </div>
                                    <div class="row form-row" style="font-size: 16px; color: black;">

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
                                            <label for="title" class="control-label">শিরোনাম : </label>
                                            <input type="text" class="form-control input-sm" name="title"
                                                style="min-height: 33px;" value="" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="fiscal_year" class="control-label">অর্থবছর : </label>
                                           <select name="fiscal_year" id="fiscal_year" class="form-control input-sm">
                                               <option value="">নির্বাচন করুন</option>
                                               <?php

                                               $fiscal_year = $this->db->query("SELECT * FROM `session_year` ORDER BY `id` DESC")->result();
                                               foreach ($fiscal_year as $key => $value) { ?>
                                               <option value="<?=$value->id?>"><?=$value->session_name?></option>
                                               <?php } ?>
                                           </select>
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
                                                    <div class="col-md-4">
                                                        <img id="loading" src="<?=base_url('img/loading.gif') ?>"
                                                            style="height: 47px;margin-top: 14px;display: none;">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="">সর্বমোট পরিমান</label>
                                                        <input type="number" class="form-control input-sm"
                                                            name="total_amount" id="total_amount" readonly>
                                                    </div>
                                                </div>
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
                                                    border-bottom: 2px solid #31708f;
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
                                                    <input type="text" name="group_name" id="group_name"
                                                    placeholder="Enter Group Name">
                                                    <a class="btn btn-success btn-sm" id="createGroup" href="javascript:void(0)">Create Group</a>
                                                </div>
                                                <table class="col-md-12" width="100%" border="1"
                                                    style="border:1px solid #a09e9e; margin-top: 10px;" id="appRowDiv">
                                                    <thead>
                                                        <tr>
                                                            <!-- <th width="30%">বাজেট হেড<span class="required">*</span></th> -->
                                                            <th></th>
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
                                                        <textarea class="form-control" name="description"
                                                            style="height: 300px;"
                                                            id="description"><p></p><p></p></textarea>
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
            var data = JSON.parse(data);
            var tr = `<tr>
                        <td><input type="checkbox" class="row-select"></td>
                        <td style="padding:0px 10px">${data.name_bn}</td>
                        <td style="padding:0px 10px">${data.bd_code}</td>
                        <td style="padding:0px 10px">
                        <input type="hidden" name="head_id[]" value="${data.budget_head_id}" >
                        <input type="hidden" name="head_sub_id[]" value="${data.id}" >
                        <input type="hidden" class="group_name" name="group_name[]"
                                                                value="xnone" >
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
                                                $(document).ready(function() {
                                                    $('#createGroup').on('click', function() {
                                                        const groupName = $('#group_name').val().trim().replace(/\s+/g, '_');
                                                        if (groupName === '') {
                                                            alert('Please enter a group name.');
                                                            return;
                                                        }

                                                        const selectedRows = $('#tbody .row-select:checked')
                                                            .closest('tr');
                                                        if (selectedRows.length === 0) {
                                                            alert(
                                                                'Please select at least one row to create a group.');
                                                            return;
                                                        }

                                                        // Create a new group header row with a remove button
                                                        const groupHeader = `
                                                                <tr class="group-header group-header-${groupName}">
                                                                    <td colspan="5">
                                                                        <b>${groupName}</b>
                                                                        <a href="javascript:void(0)" data-group_name="${groupName}" class="btn btn-danger btn-sm remove-group" style="float: right;"><i class="fa fa-times"></i> Remove Group</a>
                                                                    </td>
                                                                </tr>`;
                                                        $('#tbody').prepend(groupHeader);

                                                        // Move each selected row under the new group header
                                                        var i = 0;
                                                        selectedRows.each(function() {
                                                            i++;
                                                            $(this).find('.row-select')
                                                        .remove(); // Uncheck the checkbox
                                                            if (i == 1) {
                                                                $(this).addClass(
                                                                    `group-row group-row-${groupName} group-end-row`
                                                                    );
                                                            } else {
                                                                $(this).addClass(
                                                                    `group-row group-row-${groupName}`
                                                                    );
                                                            }
                                                            $('.group-header-' + groupName).after($(
                                                                this));
                                                            
                                                            $('.group-row-' + groupName).find('.group_name').val(groupName);
                                                            
                                                        });

                                                        $('#group_name').val(
                                                        ''); // Clear the group name input

                                                        // Make group header and rows draggable
                                                        // $(`.group-header-${groupName}, .group-row-${groupName}`)
                                                        //     .draggable({
                                                        //         helper: 'clone',
                                                        //         start: function(event, ui) {
                                                        //             $(this).addClass('highlight');
                                                        //         },
                                                        //         stop: function(event, ui) {
                                                        //             $(this).removeClass(
                                                        //             'highlight');
                                                        //         }
                                                        //     });

                                                        // Droppable area for rows
                                                        // $('#tbody').droppable({
                                                        //     accept: '.group-header, .group-row, .no-group',
                                                        //     drop: function(event, ui) {
                                                        //         if (ui.helper.hasClass(
                                                        //                 'group-header')) {
                                                        //             // Move the group header to the top
                                                        //             $(this).prepend(ui.helper);
                                                        //         } else {
                                                        //             // Move the row to the top
                                                        //             $('.group-header').first()
                                                        //                 .after(ui.helper);
                                                        //         }
                                                        //     }
                                                        // });
                                                    });
                                                    // $(document).ready(function() {
                                                    //     $('#tbody').droppable({
                                                    //         accept: '.group-header, .group-row, .no-group',
                                                    //         drop: function(event, ui) {
                                                    //             if (ui.helper.hasClass(
                                                    //                     'group-header')) {
                                                    //                 // Move the group header to the top
                                                    //                 $(this).prepend(ui.helper);
                                                    //             } else {
                                                    //                 // Move the row to the top
                                                    //                 $('.group-header').first()
                                                    //                     .after(ui.helper);
                                                    //             }
                                                    //         }
                                                    //     });
                                                    // })
                                                    // Remove group functionality
                                                    $(document).on('click', '.remove-group', function() {
                                                        const groupName = $(this).data('group_name');

                                                        const groupRows = $(`.group-row-${groupName}`);
                                                        const groupHeader = $(`.group-header-${groupName}`);

                                                        groupRows.addClass('removable-row').fadeOut(500,
                                                            function() {
                                                                $(this).remove();
                                                            });
                                                        groupHeader.addClass('removable-row').fadeOut(500,
                                                            function() {
                                                                $(this).remove();
                                                            });
                                                    });
                                                });
                                            </script>