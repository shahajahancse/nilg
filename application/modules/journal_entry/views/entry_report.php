<div class="page-content">
    <div class="content">
        <ul class="breadcrumb" style="margin-bottom: 20px;">
            <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
            <li><?=$meta_title; ?> </li>
        </ul>

        <div class="row-fluid">
            <div class="span12">
                <div class="grid simple horizontal red">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                    </div>
                    <div class="grid-body">
                        <?php if($this->session->flashdata('success')):?>
                            <div class="alert alert-success">
                                <?php echo $this->session->flashdata('success');?>
                            </div>
                        <?php endif; ?>

                <?php $attributes = array('id' => 'validates', 'target'=>'_blank');
                    echo form_open("journal_entry/entry_report_view", $attributes);?>
                        <div id="error" style="display: none;">
                            <div class="alert alert-danger">এই রিপোর্ট দেখার জন্য লাল চিহ্নিত ফিল্ড গুলো পূরণ করুন।</div>
                        </div>
                        <?=validation_errors()?>
                        <fieldset class="col-md-12">
                            <legend>রিপোর্ট ফিল্টার</legend>
                            <div id="error" style="display: none;">
                                <div class="alert alert-danger">Please fill up red level input filtering field.</div>
                            </div>
                            <div class="row">
                                <?php if($this->ion_auth->in_group(array('admin','nilg','acc', 'bli'))){ ?>
                                    <?php
                                        $books = $this->db->where('status', 1)->get('budget_j_publication_book')->result();
                                        $pgroups = $this->db->get('budget_j_publication_group')->result();
                                    ?>
                                    <div class="form-group col-md-4">
                                        <label class="form-label">বুক নির্বাচন করুন</label>
                                        <?php echo form_error('book_name'); ?>
                                        <select name="book_name" id="book_name" class="form-control input-sm" onchange="block('group_name')">
                                            <option value="">বুক নির্বাচন করুন</option>
                                            <?php foreach ($books as $key => $row) { ?>
                                            <option value="<?=$row->id?>"><?=$row->name_bn?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label">গ্রুপ নির্বাচন করুন</label>
                                        <select name="group_name" id="group_name" class="form-control input-sm" onchange="block('book_name')">
                                            <option value="">গ্রুপ নির্বাচন করুন</option>
                                            <?php foreach ($pgroups as $key => $r) { ?>
                                            <option value="<?=$r->id?>"><?=$r->name_bn?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                <?php } ?>

                                <div class="form-group col-md-2">
                                    <label class="form-label">শুরুর তারিখ</label>
                                    <input style="height: 33px" type="text" name="from_date" id="from_date" class="form-control datetime input-sm"
                                        value="<?=set_value('from')?>" placeholder="From Date">
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="form-label">শেষের তারিখ</label>
                                    <input style="height: 33px" type="text" name="to_date" id="to_date" class="form-control datetime input-sm"
                                        value="<?=set_value('from')?>" placeholder="To Date">
                                </div>
                            </div>
                        </fieldset>

                        <?php if ($this->ion_auth->in_group(array('admin','nilg','acc'))) { ?>
                            <fieldset class="col-md-12">
                                <legend>হোস্টেল রিপোর্ট বাটন</legend>
                                <!-- <button type="submit" name="btnsubmit" value="all_pending,hostel"
                                    class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> মোট পেন্ডিং</button>
                                <button type="submit" name="btnsubmit" value="all_approved,hostel"
                                    class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> মোট অনুমোদিত </button> -->
                                <button type="submit" name="btnsubmit" value="hostel_entry_report"
                                    class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> মোট এন্ট্রি </button>
                            </fieldset>

                            <fieldset class="col-md-12">
                                <legend>প্রকাশনা রিপোর্ট বাটন</legend>
                                <button type="submit" name="btnsubmit" value="all_pending,publication"
                                    class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> মোট পেন্ডিং</button>
                                <button type="submit" name="btnsubmit" value="all_approved,publication"
                                    class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> মোট অনুমোদিত </button>
                                <button type="submit" name="btnsubmit" value="all_entry,publication"
                                    class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> মোট এন্ট্রি </button>
                            </fieldset>

                            <fieldset class="col-md-12">
                                <legend>রাজস্ব রিপোর্ট বাটন</legend>
                                <button type="submit" name="btnsubmit" value="all_pending,revenue"
                                    class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> মোট পেন্ডিং</button>
                                <button type="submit" name="btnsubmit" value="all_approved,revenue"
                                    class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> মোট অনুমোদিত </button>
                                <button type="submit" name="btnsubmit" value="all_entry,revenue"
                                    class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> মোট এন্ট্রি </button>
                            </fieldset>

                            <fieldset class="col-md-12">
                                <legend>বিবিধ রিপোর্ট বাটন</legend>
                                <button type="submit" name="btnsubmit" value="all_pending,miscellaneous"
                                    class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> মোট পেন্ডিং</button>
                                <button type="submit" name="btnsubmit" value="all_approved,miscellaneous"
                                    class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> মোট অনুমোদিত </button>
                                <button type="submit" name="btnsubmit" value="all_entry,miscellaneous"
                                    class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> মোট এন্ট্রি </button>
                            </fieldset>

                            <fieldset class="col-md-12">
                                <legend>পেনশন রিপোর্ট বাটন</legend>
                                <button type="submit" name="btnsubmit" value="all_pending,pension"
                                    class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> মোট পেন্ডিং</button>
                                <button type="submit" name="btnsubmit" value="all_approved,pension"
                                    class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> মোট অনুমোদিত </button>
                                <button type="submit" name="btnsubmit" value="all_entry,pension"
                                    class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> মোট এন্ট্রি </button>
                            </fieldset>

                            <fieldset class="col-md-12">
                                <legend>GPF রিপোর্ট বাটন</legend>
                                <button type="submit" name="btnsubmit" value="all_pending,gpf"
                                    class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> মোট পেন্ডিং</button>
                                <button type="submit" name="btnsubmit" value="all_approved,gpf"
                                    class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> মোট অনুমোদিত </button>
                                <button type="submit" name="btnsubmit" value="all_entry,gpf"
                                    class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> মোট এন্ট্রি </button>
                            </fieldset>

                        <?php  }else{ ?>
                            <?php if($this->ion_auth->in_group(array('bli'))){?>
                            <fieldset class="col-md-12">
                                <legend>প্রকাশনা রিপোর্ট বাটন</legend>
                                <button type="submit" name="btnsubmit" value="all_book,number" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> মোট বইয়ের সংখ্যা</button>
                                <button type="submit" name="btnsubmit" value="all_book,amount" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> মোট বইয়ের মূল্য</button>
                                <button type="submit" onclick="return validFunc()" name="btnsubmit" value="single_book,amount" id="single_book" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> একটি বইয়ের রিপোর্ট</button>
                                <button type="submit" name="btnsubmit" value="group_book,number" id="group_book" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> গ্রুপ ভিত্তিক সংখ্যা</button>
                                <button type="submit" name="btnsubmit" value="excel_sheet,number" id="excel_sheet" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> এক্সেল শীট </button>
                            </fieldset>
                            <?php } ?>

                            <?php if($this->ion_auth->in_group(array('bho'))){?>
                            <fieldset class="col-md-12">
                                <legend>হোস্টেল রিপোর্ট বাটন</legend>
                                <!-- <button type="submit" name="btnsubmit" value="all_pending,hostel"
                                    class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> মোট পেন্ডিং</button>
                                <button type="submit" name="btnsubmit" value="all_approved,hostel"
                                    class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> মোট অনুমোদিত </button> -->
                                <button type="submit" name="btnsubmit" value="hostel_entry_report"
                                    class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> রিপোর্ট </button>
                            </fieldset>
                            <?php } ?>
                        <?php } ?>


                        <div class="clearfix"></div>
                        <?php form_close(); ?>
                    </div> <!-- /grid-body -->
                </div> <!-- /grid -->
            </div>
        </div> <!-- /row-fluid -->

    </div> <!-- /content -->
</div> <!-- /page-content -->

<script>
    function validFunc() {
      var division = document.getElementById("book_name").value;
      submitOK = "true";

      if (division == '' || division <= 0) {
        $("#book_name").css("border", "1px solid red");
        submitOK = "false";
      }

      if (submitOK == "false") {
        $("#error").show();
        return false;
      }
    }

</script>

<script>
    function block(v){
        $('#'+v).val('');
    }
</script>

<script>
    $("#validate").submit(function() {
        if ($("#from_date").val() == "" || $("#to_date").val() == "") {
            $("#error").show();
            return false;
        } else {
            $("#error").hide();
            return true;
        }
    });
</script>
