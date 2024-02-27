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
                  <div class="pull-right">
                     <a href="<?=base_url('budgets/budget_field_create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create Budget</a>
                  </div>            
               </div>

               <div class="grid-body ">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>
                  <table class="table table-hover table-condensed" border="0">
                     <thead>
                        <tr>
                           <th> ক্রম </th>
                            <th>আমাউন্ট</th>
                           <th>ডেস্ক</th>
                           <th>ডেস্কিপশন</th>
                           <th>স্টাস</th>
                           <th>আপডেট তারিখ</th>
                           <th style="text-align: right;">অ্যাকশন</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=$pagination['current_page'];
                        foreach ($results as $row):
                           $sl++;
                        ?>
                        <tr>
                           <td class="v-align-middle"><?=$sl.'.'?></td>
                           <td class="v-align-middle"><?=$row->title; ?></td>
                           <td class="v-align-middle"><?=$row->amount; ?></td>
                          
                           <td class="v-align-middle" style="width: 200px; white-space: normal;overflow: hidden" title="<?=$row->description; ?>"><?=$row->description; ?></td>
                           <td class="v-align-middle">
                           <!-- 1=pending,2=dpt. app., 3=reject, 4=acc., 5=dg, 6=draft, 7=revenue received -->
                              <?php if($row->status==1){
                                 echo '<span class="label label-warning">Pending </span>';
                              }elseif($row->status==2){
                                 echo '<span class="label label-success">DPT. Approve </span>';
                              }elseif($row->status==3){
                                 echo '<span class="label label-important">Rejected </span>';
                              }elseif($row->status==4){
                                 echo '<span class="label label-info">ACC. Approve </span>';
                              }elseif($row->status==5){
                                 echo '<span class="label label-success">DG. Approve </span>';
                              }elseif($row->status==6){
                                 echo '<span class="label label-info">Draft </span>';
                              }elseif($row->status==7){
                                 echo '<span class="label label-success">Revenue Received </span>';
                              }
                              ?>
                           </td>
                         
                           <td class="v-align-middle"><?=date_bangla_calender_format($row->updated_at); ?>                              
                           </td>
                           <td align="right">
                              <div class="btn-group">
                                <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                                <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                                <ul class="dropdown-menu pull-right">
                                  <li><a href="<?php echo base_url('budgets/budget_field_details/'.encrypt_url($row->id))?>"><i class="fa fa-pencil-square"></i> বিস্তারিত </a></li>
                                </ul>
                              </div>
                           </td>
                        </tr>
                     <?php endforeach;?>                      
                  </tbody>
               </table>

               <div class="row">
                  <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> সর্বমোট <span style="color: green; font-weight: bold;"><?php echo eng2bng($total_rows); ?> রিকুইজিশন </span></div>
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