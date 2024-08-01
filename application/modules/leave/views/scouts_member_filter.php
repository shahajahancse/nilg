<!-- <form method="get" action="">                     -->
	<div class="row">
      <div class="col-md-3 m-t-10">
         <label for="user">কর্মকর্তা/কর্মচারী</label>
         <?php $more_attr = 'class="form-control input-sm" id="user" style="height: 20px !important"';
            echo form_dropdown('user', $users, set_value('user'), $more_attr);
         ?>
      </div>

      <div class="col-md-3 m-t-10">
         <label for="user">ছুটির ধরণ </label>
         <?php $more_attr = 'class="form-control input-sm" style="height: 20px !important"';
            echo form_dropdown('leave_type', $leave_types, set_value('leave_type'), $more_attr);
         ?>
      </div>

      <div class="col-md-2 m-t-10">
         <label for="user">শুরুর তারিখ</label>
         <input name="date_from" value="<?=set_value('date_from')?>" type="text" id="date_from" class="form-control input-sm datetime" placeholder="Date From" autocomplete="off">
      </div>
      <div class="col-md-2 m-t-10">
         <label for="user">শেষ তারিখ</label>
         <input name="date_to" value="<?=set_value('date_to')?>" type="text" id="date_to" class="form-control input-sm datetime" placeholder="Date To" autocomplete="off">
      </div>

	</div>

<!-- </form> -->

<div class="clearfix"></div>
<!-- <hr > -->
