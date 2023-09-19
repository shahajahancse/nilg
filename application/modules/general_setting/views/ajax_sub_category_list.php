            
  <table class="table table-hover table-bordered  table-flip-scroll cf" id="">
    <thead>
      <tr>
        <th style="width:2%"> ক্রম </th>
        <th style="width:30%">ক্যাটেগরি নাম</th>
        <th style="width:30%">সাব ক্যাটেগরি নাম</th>
        <th style="width:20%">স্ট্যাটাস</th>
        <th style="width:40%; text-align: right;">অ্যাকশন</th>
      </tr>
    </thead> 
    <tbody>
      <?php 
        $sl = 0;
        foreach ($results as $row):
          $sl++;

          if($row->status == 1){
             $status = '<span class="btn btn-primary btn-xs btn-mini">এনাবল </span>';
          }else{
             $status = '<span class="btn btn-danger btn-xs btn-mini">ডিজাবল</span>';
          }  
      ?>
        <tr>
          <td class="v-align-middle"><?= eng2bng($sl).'.'?></td>
          <td class="v-align-middle"><?=$row->category_name?></td>
          <td class="v-align-middle"><?=$row->sub_cate_name?></td>
          <td class="v-align-middle"><?=$status?></td>
          <td align="right">
            <div class="btn-group">
              <button class="btn btn-mini btn-primary">অ্যাকশন</button>
              <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
              <ul class="dropdown-menu pull-right">

                <li><a href="<?php echo base_url('general_setting/sub_category_edit/'.$row->id)?>" class="btn btn-mini btn-primary"><i class="fa fa-pencil-square"></i> এডিট করুন </a></li>

                <li><a href="<?php echo base_url('general_setting/sub_category_delete/'.$row->id)?>" target="_blank" class="btn btn-mini btn-primary" onclick="return confirm('Are you sure you want to delete this sub category?');"><i class="fa fa-pencil-square"></i> ডিলিট করুন </a></li>

              </ul>
            </div>
          </td>
        </tr>
      <?php endforeach;?>                      
    </tbody>
  </table>

 
