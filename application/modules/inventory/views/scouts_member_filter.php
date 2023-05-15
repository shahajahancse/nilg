<!-- <form method="get" action="">                     -->
	<div class="row">
      <div class="col-md-3 m-t-10">
         <?php $more_attr = 'class="form-control input-sm"';
         echo form_dropdown('dis_type', $users, set_value('dis_type'), $more_attr);
         ?>
      </div>

      <div class="col-md-2 m-t-10">
         <input name="date_from" value="<?=set_value('date_from')?>" type="text" id="date_from" class="form-control input-sm datetime" placeholder="Date From" autocomplete="off">
      </div>
      <div class="col-md-2 m-t-10">
         <input name="date_to" value="<?=set_value('date_to')?>" type="text" id="date_to" class="form-control input-sm datetime" placeholder="Date To" autocomplete="off">
      </div>

	</div>
	
<!-- </form> -->

<div class="clearfix"></div>
<!-- <hr > -->