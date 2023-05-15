<div class="page-content">
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?= base_url('dashboard') ?>" class="active"> <?=lang('Dashboard') ?> </a> </li>
         <li> <a href="<?= base_url('trainer') ?>" class="active"> <?=$module_title?> </a></li>
         <li><?=$meta_title?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">      
                     <a href="<?=base_url('trainer/details/'.encrypt_url(3))?>" class="btn btn-primary btn-xs btn-mini" onclick="printDiv('printableArea')"> প্রিন্ট করুণ </a>
                     <a href="<?=base_url('trainer/all')?>" class="btn btn-primary btn-xs btn-mini"> প্রশিক্ষকের তালিকা </a>
                  </div>
               </div>
               <div class="grid-body" id="printableArea">
                  <div class="row">
                     <div class="col-md-12">
                        <table class="tg" width="100%">
                           <tr>
                              <th class="tg-akf0" colspan="4" style="text-align: center;">
                                 <h3 style="font-weight: bold;">জাতীয় স্থানীয় সরকার ইনস্টিটিউট </h3>
                                 <span style="color: black;" > (এনআইএলজি) </span> <br>
                                 <span style="color: black;">২৯, আগারগাঁও, শেরে বাংলা নগর</span> <br>
                                 <span style="color: black;">ঢাকা - ১২০৭</span>
                                 <h4 style="font-weight: bold;">ব্যাক্তিগত ডাটা সীট (প্রশিক্ষক)</h4>
                              </th>
                           </tr>
                           <tr><td class="tg-mtwr" colspan="4"> ব্যাক্তিগত বা সাধারণ তথ্য </td></tr>
                           <tr>
                              <td class="tg-khup">নাম (বাংলা)</td>
                              <td class="tg-ywa9"><?=$info->name_bn?></td>
                              <td class="tg-khup">এনআইডি নম্বর</td>
                              <td class="tg-ywa9"><?=eng2bng($info->nid)?></td>
                           </tr>
                           <tr>
                              <td class="tg-khup">নাম (ইংরেজি)</td>
                              <td class="tg-ywa9"><?=$info->name_en?></td>
                              <td class="tg-khup">জম্ম তারিখ</td>
                              <td class="tg-ywa9"><?=date_bangla_calender_format($info->dob); //date('d F, Y', strtotime($info->dob));?></td>
                           </tr>
                           <tr>
                              <td class="tg-khup">বর্তমান ঠিকানা</td>
                              <td class="tg-ywa9"><?=$info->present_add?></td>
                              <td class="tg-khup">মোবাইল নম্বর</td>
                              <td class="tg-ywa9"><?=eng2bng($info->mobile_no)?></td>
                           </tr>
                           <tr>
                              <td class="tg-khup">সর্বোচ্চ শিক্ষাগত যোগ্যতা</td>
                              <td class="tg-ywa9"><?=$info->height_education?></td>
                              <td class="tg-khup">ই-মেইল</td>
                              <td class="tg-ywa9"><?=$info->email?></td>
                           </tr>
                           <tr><td class="tg-mtwr" colspan="4"> অফিস/প্রতিষ্ঠানের তথ্য </td></tr>
                           <tr>
                              <td class="tg-khup">অফিস/প্রতিষ্ঠানের নাম</td>
                              <td class="tg-ywa9"><?=$info->office_name?></td>
                              <td class="tg-khup">বর্তমান পদবি</td>
                              <td class="tg-ywa9"><?=$info->designation?></td>
                           </tr>
                           <tr>
                              <td class="tg-khup">আগ্রহী বিষয়</td>
                              <td class="tg-ywa9"><?=$info->interested_subjects?></td>
                              <td class="tg-khup">ক্রিয়েটেড ডেট</td>
                              <td class="tg-ywa9"><?= date('d F, Y', $info->created_on); ?></td>
                           </tr>

                        </table>

                     </div>          

                  </div>
               </div>
            </div>
         </div>

      </div>


   </div>
</div>