<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
         <li>  জেনারেল সেটিংস </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                  </div>
               </div>
               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <a class="close" data-dismiss="alert">&times;</a>
                        <?php echo $this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>
                  <div class="row form-row">
                     <div class="col-md-4">
                        <label class="form-label">Role</label>
                        <select name=" groups_id" class="form-control input-sm" id="groups_id">
                           <option value="">Select Role</option>
                           <?php foreach ($results as $key => $r) { ?>
                              <option value="<?= $r->id ?>"><?= $r->title .' => '. $r->name ?></option>
                           <?php } ?>
                        </select>
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Department</label>
                        <select name="dept_id" class="form-control input-sm" id="dept_id">
                           <option value="">Select Department</option>
                           <?php foreach ($depts as $key => $d) { ?>
                              <option value="<?= $d->id ?>"><?= $d->name_en .' => '. $d->dept_name ?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>
                  <hr>
                  <div class="row form-row" id="load_desig">

                  </div>


               </div>  <!-- END GRID BODY -->
            </div> <!-- END GRID -->
         </div>
      </div> <!-- END ROW -->
   </div>
</div>


<script>
    function check_level(e) {
        var is_check    = 0;
        if (e.checked) { is_check = 1; }
        var id          = $(e).val();
        var groups_id   = $('#groups_id').val();
        var dept_id     = $('#dept_id').val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('general_setting/manage_designation_add_ajax') ?>",
            data: {
                groups_id   : groups_id,
                dept_id     : dept_id,
                id          : id,
                is_check    : is_check,
            },
            success: function(data) {
                console.log('success');
            }
        })
    }
</script>

<script type="text/javascript">
    //Designation dropdown
      $('#dept_id').change(function() {
      $('#load_desig').show().empty();
        var groups_id   = $('#groups_id').val();
        var dept_id     = $('#dept_id').val();
        $.ajax({
            type: "POST",
            data: {
                groups_id: groups_id,
                dept_id: dept_id,
            },
            url: hostname + "general_setting/manage_designation_ajax/",
            success: function(func_data) {
                $('#load_desig').show().empty().html(func_data);
            }
        });
    });

    //Department dropdown
    $('#groups_id').change(function() {
         $('#load_desig').show().empty();
         $("#dept_id > option").remove();
         $('#dept_id').append("<option value=''>-- Select Department --</option>");
         $.ajax({
            type: "POST",
            url: hostname + "common/get_dept/",
            success: function(func_data) {
                $.each(func_data, function(id, name) {
                    var opt = $('<option />');
                    opt.val(id);
                    opt.text(name);
                    $('#dept_id').append(opt);
                });
            }
        });
    });
</script>
