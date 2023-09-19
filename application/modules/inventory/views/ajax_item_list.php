
<table class="table table-hover table-condensed">
   <thead>
      <tr>
         <th style="width:2%"> ক্রম </th>
         <th style="width:12%">ক্যাটেগরি</th>
         <th style="width:12%">সাব ক্যাটেগরি</th>
         <th style="width:20%">মালামালের নাম</th>
         <th style="width:8%">একক</th>
         <th style="width:8%">পরিমাণ</th>
         <th style="width:10%">অরডার লেভেল</th>
         <th style="width:8%">স্ট্যাটাস</th>
         <th style="width:12%" class="text-center">অ্যাকশন</th>
      </tr>
   </thead>
   <tbody>
      <?php 
      foreach ($results as $key => $row) {

         if($row->status == 1){
            $status = 'এনাবল';
         }else{
            $status = 'ডিজাবল';
         }
         ?>
         <tr>
            <td class="v-align-middle"><?= eng2bng($key + 1).'.'?></td>
            <td class="v-align-middle"><?=$row->category_name?></td>
            <td class="v-align-middle"><?=$row->sub_cate_name?></td>
            <td class="v-align-middle"><strong><?=$row->item_name?></strong></td>
            <td class="v-align-middle"><?=$row->unit_name?></td>
            <td class="v-align-middle"><strong><?= eng2bng((int)$row->quantity); ?></strong></td>
            <td class="v-align-middle"><?= eng2bng((int)$row->order_level); ?></td>
            <td class="v-align-middle"><?=$status?></td>
            <td align="right">
               <div class="btn-group">
                 <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                 <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                  <ul class="dropdown-menu pull-right">
                     <li><a href="<?php echo base_url('inventory/item_edit/'.encrypt_url($row->id))?>" target="_blank"><i class="fa fa-pencil-square"></i> এডিট </a></li>
                     <?php if($this->ion_auth->is_admin()){ ?> 
                     <li><a href="<?php echo base_url('inventory/item_delete/'.$row->id)?>" target="_blank"><i class="fa fa-pencil-square"></i> ডিলেট </a></li>
                     <?php } ?>
                  </ul>
               </div>
            </td>
         </tr>
      <?php } ?>
   </tbody>
</table>