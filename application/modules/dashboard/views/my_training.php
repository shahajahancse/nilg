<style>
    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu .dropdown-menu {
        top: 0;
        right: 100%;
        margin-top: 30px;
    }

    .open>.dropdown-menu {
        display: block !important;
        left: -85px !important;
    }

    .form {
        border: 1px solid #0aa699
    }

    .savebtn {
        align-items: flex-end;
        display: flex;
        flex-direction: column-reverse;
        margin: 7px;

    }

    .input-file {
        margin-left: 10px !important;
        height: 25px !important;
        line-height: 1 !important;
    }

    .input-file::file-selector-button {
        border: none;
        border-radius: 0px;
        color: white;
        background-color: #fff;
        border: 0px;
        height: 0;
        width: 0;
        font-size: 0px;
        cursor: pointer;
        transition: all .25s ease-in;
        cursor: pointer;
    }

    .input-file::file-selector-button:hover {
        background-color: #fff;
        color: #fff;
        transition: all .25s ease-in;
    }
</style>



<div class="page-content">
    <div class="content">
        <ul class="breadcrumb" style="margin-bottom: 20px;">
            <li> <a href="<?= base_url('dashboard') ?>" class="active"> ড্যাশবোর্ড </a> </li>
            <li><?= $meta_title ?> </li>
        </ul>





        <div class="row margin-top-10">
            <div class="col-md-12">
                <div class="grid simple horizontal green">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
                    </div>

                    <div class="grid-body">
                        <div id="infoMessage"><?php //echo $message;
                                                ?></div>
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success">
                                <?php echo $this->session->flashdata('success');; ?>
                            </div>
                        <?php endif; ?>
                        <div class="row ">
                            <div class="col-md-3 m-b-5">
                                <select id="course_id" name="course_id" onchange="myFunction_c()" class="form-control input-sm" style="height: 24px !important;">
                                    <option value="">কোর্সের শিরোনাম</option>
                                    <?php
                                    $courses = $this->db->select('id, course_title')->from('course')->where('status', 1)->get();
                                    foreach ($courses->result() as $key => $row): ?>
                                        <option value="<?php echo $row->course_title; ?>"><?php echo $row->course_title; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="col-md-2 m-b-5">
                                <input style="height: 26px;padding: 13px 14px;width: 153px;border: 1px solid #00a59a;" class="ffff"
                                    placeholder="কোর্স কোড" name="course_code" id="course_code" onkeyup="myFunction_code()" onchange="myFunction_code()">
                            </div>
                            <div class="col-md-1 m-b-5">
                                <a href="<?= base_url('training') ?>" class="btn btn-warning btn-mini ">Clear</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered " id="exampless">
                                <thead class="cf">
                                    <tr>
                                        <th>ক্রম</th>
                                        <th>প্রশিক্ষণের শিরোনাম </th>
                                        <th>কোর্স কোড </th>
                                        <th>প্রশিক্ষণের সময়</th>
                                        <th width="80">অ্যাকশন</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sl = 0;
                                    foreach ($results as $row) {
                                        $sl++;
                                        $note = $this->db->where('training_id', $row->training_id)->where('app_user_id', $this->userID)->get('training_participant')->row()->note;
                                    ?>
                                        <tr>
                                            <td class="tg-ywa99"><?= eng2bng($sl) . '.' ?></td>
                                            <td class="tg-ywa99"><?= func_training_title($row->training_id) ?></td>
                                            <td class="tg-ywa99"><?= $row->pin ?></td>
                                            <td class="tg-ywa99"><?= date_bangla_calender_format($row->start_date) ?> হতে
                                                <?= date_bangla_calender_format($row->end_date) ?></td>
                                            <td class="tg-ywa99">
                                                <div class="dropdown" class="btn-group pull-right">
                                                    <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown"
                                                        href="dropdown"> অ্যাকশন <span class="caret"></span> </a>
                                                    <ul class="dropdown-menu">
                                                        <li><?= anchor("dashboard/my_training_schedule/" . encrypt_url($row->training_id), 'প্রশিক্ষণ কর্মসূচী') ?>
                                                        </li>
                                                        <li class="dropdown-submenu">
                                                            <a class="test" tabindex="-1">নোট <span class="caret"></span></a>
                                                            <ul style="display: none;border: 1px solid #683091;padding: 7px;"
                                                                class="dropdown-menu">
                                                                <?php
                                                                if ($note) {
                                                                    $notearray = json_decode($note);
                                                                    foreach ($notearray as $key => $data) { ?>
                                                                        <li style="display: flex;">
                                                                            <a style="background-color: #8dc641;"
                                                                                href='<?= base_url('uploads/note/' . $data) ?>'
                                                                                target='_blank'
                                                                                class='btn btn-primary btn-xs btn-mini col-md-9'>নোট
                                                                                <?= $key + 1 ?></a>
                                                                            <a href='<?= base_url('training/dellet_note/' . $data . '/' . $row->training_id) ?>'
                                                                                class='btn btn-primary btn-xs btn-mini col-md-3'
                                                                                style="padding: 0;padding-left: 7px;"><img
                                                                                    style="width: 20px;height: 20px;"
                                                                                    src="<?= base_url('uploads/delete.png') ?>"
                                                                                    alt="Dellet"></a>
                                                                        </li>

                                                                <?php }
                                                                }
                                                                ?>


                                                                <?php
                                                                $attributes = array('autcomplete' => 'off', 'id' => 'notedata');
                                                                echo form_open_multipart("training/uplodenote/$row->training_id", $attributes); ?>
                                                                <input type="hidden" name="triningid"
                                                                    value="<?= $row->training_id ?>">
                                                                <div class="row form-row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label">নোট আপলোড</label>
                                                                            <div class="row">
                                                                                <div class="form-group userfile">
                                                                                    <div style="margin-left: -11px;"
                                                                                        class="col-sm-10">
                                                                                        <input style="height: 25px !important"
                                                                                            class="form-control input-file"
                                                                                            type="file" name="userfile[]">
                                                                                    </div>
                                                                                    <div class="col-sm-2">
                                                                                        <button style="margin-left: -18px;"
                                                                                            class="btn btn-success btn-mini handbook-add">
                                                                                            <span class="fa fa-plus"></span>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-12 ">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary col-md-12 btn-mini note-upload">
                                                                                    Upload
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php echo form_close(); ?>


                                                            </ul>
                                                        </li>



                                                        <?php
                                                        if ($row->handbook != null && $row->handbook != '') {
                                                            if (is_array(json_decode($row->handbook))) { ?>
                                                                <li class="dropdown-submenu">
                                                                    <a class="test" tabindex="-1">ট্রেনিং হ্যান্ডবুক ডাউনলোড <span
                                                                            class="caret"></span></a>
                                                                    <ul class="dropdown-menu">
                                                                        <?php
                                                                        foreach (json_decode($row->handbook) as $key => $row):
                                                                            $path = base_url('uploads/handbook/' . $row);
                                                                            echo '<li><a href="' . $path . '" target="_blank" class="btn btn-primary btn-xs btn-mini">ফাইল   ' . eng2bng($key + 1) . '</a></li>';
                                                                        endforeach; ?>
                                                                    </ul>
                                                                </li>

                                                        <?php } else {
                                                                $path = base_url('uploads/handbook/' . $row->handbook);
                                                                echo '<li><a href="' . $path . '" target="_blank" class="btn btn-primary btn-xs btn-mini">ট্রেনিং হ্যান্ডবুক ডাউনলোড </a></li>';
                                                            }
                                                        } ?>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div> <!-- END ROW -->

</div>
</div>

<script>
    // Multiple handbook Upload
    $(document)
        .on("click", ".userfile .handbook-add", function(e) {
            e.preventDefault();
            var current_obj = $(this).closest(".userfile");
            var cloned_obj = $(current_obj.clone()).insertAfter(current_obj).find('input[type="file"]').val("");

            current_obj.find(".fa-plus").removeClass("fa-plus").addClass("fa-minus");

            current_obj.find(".btn-success").removeClass("btn-success").addClass("btn-danger");

            current_obj.find(".handbook-add").removeClass("handbook-add").addClass("handbook-del");
        })

        .on("click", ".handbook-del", function(e) {
            e.preventDefault();
            $(this).closest(".userfile").remove();
            return false;
        })


    $(document).ready(function() {
        $('.dropdown-submenu a.test').on("click", function(e) {
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
        });
    });
</script>


<script>
    function myFunction_c() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("course_id");
        filter = input.value.toUpperCase();
        table = document.getElementById("exampless");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

<script>
    function myFunction_code() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("course_code");
        filter = input.value.toUpperCase();
        table = document.getElementById("exampless");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>