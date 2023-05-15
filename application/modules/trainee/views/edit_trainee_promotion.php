<div class="page-content">
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <div class="pull-right">
              <?php if($info->employee_type == 1){ ?>
              <a href="<?= base_url('trainee/details_pr/'. encrypt_url($info->id)) ?>" class="btn btn-primary btn-xs btn-mini"> বিস্তারিত তথ্য </a>
              <?php } else { ?>
              <a href="<?= base_url('trainee/details_employee/'. encrypt_url($info->id)) ?>" class="btn btn-primary btn-xs btn-mini"> বিস্তারিত তথ্য </a>
              <?php } ?>
            </div>
          </div>

          <div class="grid-body">
            <?php $attributes = array('id' => 'validate');
            echo form_open_multipart(uri_string(), $attributes);
            ?>

            <?php if ($this->session->flashdata('success')) : ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');; ?>
              </div>
            <?php endif; ?>

            <div id="msgNILG"> </div>

            <!-- Nilg Training Information  start -->
            <div class="row" style="margin-bottom: 30px;">
              <div class="col-md-12">
                <label class="form-label">পদোন্নতি সংক্রান্ত তথ্যাদিঃ</label>
                <table width="100%" border="1" id="promotionDiv">
                  <tr>
                    <td width="400">প্রতিষ্ঠানের নাম</td>
                    <td width="250">পদোন্নতি প্রাপ্ত পদবী</td>
                    <td>বেতনক্রম </td>
                    <td>মন্তব্য </td>
                    <td width="80"> <a id="addRowPromotion" class="label label-success"> <i class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                  </tr>
                  <?php if (!empty($promotions)) { ?>
                    <?php foreach ($promotions as $row) { ?>
                      <tr>
                        <td> <input type="text" name="promo_org_name[]" value="<?= $row->promo_org_name ?>" class="promo_org_sugg form-control input-sm">
                        </td>
                        <td><input type="text" class="promo_desig_sugg form-control input-sm" value="<?= $row->promo_desig_name ?>" name="promo_desig_name[]">
                        </td>
                        <td><input type="text" class="form-control input-sm " value="<?= $row->promo_salary_ratio ?>" name="promo_salary_ratio[]">
                        </td>
                        <td><input type="text" class="form-control input-sm " value="<?= $row->promo_comments ?>" name="promo_comments[]">
                        </td>
                        <td width="100"> <a href="javascript:void();" data-id="<?= $row->id ?>" onclick="removeRowPromoFunc(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন</a> </td>
                        <input type="hidden" name="hide_promo_id[]" value="<?= $row->id ?>">
                      </tr>
                  <?php }
                  } ?>
                  <tr></tr>
                </table>
              </div>
            </div>

            <div class="form-actions">
              <div class="pull-right">
                <?php echo form_submit('submit', lang('common_save'), "class='btn btn-primary btn-cons font-big-bold'"); ?>
              </div>
            </div>
            <?php echo form_close(); ?>

          </div> <!-- END GRID BODY -->
        </div> <!-- END GRID -->
      </div>
    </div> <!-- END ROW -->
  </div>
</div>



<script type="text/javascript">
  // NILG Employee Promotion
  $("#addRowPromotion").click(function(e) {
    var items = '';
    items += '<tr>';
    items += '<td><input name="promo_org_name[]" type="text" class="promo_org_sugg form-control input-sm"></td>';
    items += '<td><input name="promo_desig_name[]" type="text" class="promo_desig_sugg form-control input-sm"></td>';
    items += '<td><input name="promo_salary_ratio[]" type="text" class="form-control input-sm"></td>';
    items += '<td><input name="promo_comments[]" type="text" class="form-control input-sm"></td>';
    items += '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowPromotion(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
    items += '</tr>';

    $('#promotionDiv tr:last').after(items);
    // select2Organization();
    promotion_organization_suggestions();
    promotion_designation_suggestions();
  });

  function removeRowPromotion(id) {
    $(id).closest("tr").remove();
  }

  function removeRowPromoFunc(id) {
    var dataId = $(id).attr("data-id");
    var txt;
    if (confirm("আপনি কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলতে চান?") == true) {
      $.ajax({
        type: "POST",
        url: hostname + "common/ajax_promotion_del/" + dataId,
        success: function(response) {
          $("#msgPromo").addClass('alert alert-success').html(response);
          $(id).closest("tr").remove();
        }
      });
      txt = "You pressed OK!";
    } else {
      txt = "You pressed Cancel!";
    }
  }
</script>
