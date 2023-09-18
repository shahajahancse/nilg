
   <table class="table table-hover table-bordered  table-flip-scroll cf" border="0">
      <thead>
         <tr>
            <th style="width:10px;"> ক্রম </th>
            <th style="width:200px;">নাম</th>
            <th style="width:100px;">ডিপার্টমেন্ট</th>
            <th style="width:100px;">পদবি</th>
            <th style="width:100px;">তারিখ</th>
            <th style="width:100px;">আপডেট তারিখ</th>
            <th style="width:50px;">স্ট্যাটাস</th>
            <th style="width:100px; text-align: right;">অ্যাকশন</th>
         </tr>
      </thead>
      <tbody>
      <?php 
         $sl = 0;
         foreach ($rows as $row):
            $sl++;
            $status = '<span class="label label-success">ডেলিভারড</span>';
         ?>
         <tr>
            <td class="v-align-middle"><?=eng2bng($sl).'.'?></td>
            <td class="v-align-middle"><?=$row->name_bn; ?></td>
            <td class="v-align-middle"><?=$row->dept_name; ?></td>
            <td class="v-align-middle"><?=$row->desig_name; ?></td>
            <td class="v-align-middle"><?=date_bangla_calender_format($row->created); ?>
            </td>
            <td class="v-align-middle"><?=date_bangla_calender_format($row->updated); ?>                              
            </td>
            <td> <?=$status?></td>
            <td align="right">
               <div class="btn-group">
                 <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                 <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                 <ul class="dropdown-menu pull-right">
                   <li><a href="<?php echo base_url('inventory/requisition_details/'.encrypt_url($row->id))?>" target="_blank"><i class="fa fa-pencil-square"></i> বিস্তারিত </a></li>
                   <li><a href="<?php echo base_url('inventory/my_requisition_print/'.encrypt_url($row->id))?>" target="_blank"><i class="fa fa-pencil-square"></i> প্রিন্ট করুন </a></li>
                 </ul>
               </div>
            </td>
         </tr>
      <?php endforeach;?>                      
      </tbody>
   </table>
                 