<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
         <li> জেনারেল সেটিংস</li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row-fluid">
         <div class="span12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('general_setting/category_add')?>" class="btn btn-blueviolet btn-xs btn-mini">ক্যাটাগরি এন্ট্রি করুন </a>
                  </div>            
               </div>

               <div class="grid-body ">
                  <div id="infoMessage"><?php //echo $message;?></div>            
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <a class="close" data-dismiss="alert">&times;</a>
                        <?php echo $this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>

                  <table class="table table-hover table-bordered  table-flip-scroll cf" id="">
                     <thead>
                        <tr>
                           <th style="width:2%"> ক্রম </th>
                           <th style="width:60%">ক্যাটাগরি নাম</th>
                           <!-- <th style="width:18%">Status</th> -->
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl = 0;
                        foreach ($results as $row):  
                           $sl++; ?>
                        <tr>
                           <td class="v-align-middle"><?= eng2bng($sl).'.'?></td>
                           <td class="v-align-middle"><?=$row->category_name?></td>
                        </tr>
                     <?php endforeach;?>                      
                  </tbody>
               </table>

            </div>
         </div>
      </div>
   </div>

</div> <!-- END ROW -->
</div>
