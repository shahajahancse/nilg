<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
         <li> <a href="<?=base_url('inventory')?>" class="active"> <?=$module_name; ?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row-fluid">
         <div class="span12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('inventory/index')?>" class="btn btn-blueviolet btn-xs btn-mini">Back</a>  
                  </div>
               </div>

               <div class="grid-body ">
                  <div id="infoMessage"><?php //echo $message;?></div>            
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>

                  <table class="table table-hover table-condensed" id="examples">
                     <thead>
                        <tr>
                           <th style=""> ক্রম </th>
                           <th style="">নাম</th>
                           <th style="">ডিপার্টমেন্ট</th>
                           <th style="">পদবি</th>
                           <th style="">আইটেম নাম</th>
                           <th style="">ক্যাটেগরি</th>
                           <th style="">কুয়ান্টিটি</th>
                           <th style="">তারিখ</th>
                           <th style="" class="text-center">অ্যাকশন</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl = $pagination['current_page'];
                        foreach ($results as $row) {
                           $sl++; ?>
                           <tr>
                              <td class="v-align-middle"><?=eng2bng($sl).'.'?></td>
                              <td class="v-align-middle"><?=$row->name_bn?></td>
                              <td class="v-align-middle"><?=$row->dept_name?></td>
                              <td class="v-align-middle"><?=$row->desig_name?></td>
                              <td class="v-align-middle"><?=$row->item_name." ".$row->unit_name?></td>
                              <td class="v-align-middle"><?=$row->category_name?></td>
                              <td class="v-align-middle"><?= eng2bng($row->qty_request); ?></td>
                              <td class="v-align-middle"><?=date_bangla_calender_format($row->updated);?></td>
                              <td class="v-align-middle"><?=anchor("inventory/again_requisition/".encrypt_url($row->id), 'পুনরায় রিকুইজিশন', array('class' => 'btn btn-primary btn-mini'))?></td>
                           </tr>
                        <?php } ?>
                     </tbody>
                  </table>

                  <div class="row">
                     <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> সর্বমোট <span style="color: green; font-weight: bold;"><?php echo eng2bng($total_rows); ?> আইটেম </span></div>
                     <div class="col-sm-8 col-md-8 text-right">
                        <?php echo $pagination['links']; ?>
                     </div>
                  </div>

               </div>
            </div>
         </div>
      </div> <!-- END ROW -->
   </div>
</div>

<script type="text/javascript">
   /*$(document).ready(function() {
      $('#examples').DataTable( {
         "aaSorting": []
      });
   });*/
</script>