<!-- <li><?=anchor("training/details/".$training->id, lang('common_details'))?></li> -->
<li><?=anchor("training/edit/".$training->id, lang('common_edit'))?></li>
<li><?=anchor("training/participant_list/".$training->id, 'অংশগ্রহণকারী তালিকা')?></li>
<li><?=anchor("training/schedule/".$training->id, 'প্রশিক্ষণ কর্মসূচী')?></li>
<li><?=anchor("training/allowance/".$training->id, 'প্রশিক্ষণ ভাতা')?></li>
<li><?=anchor("training/allowance_dress/".$training->id, 'পোষাক ভাতা')?></li>
<li><?=anchor("training/material/".$training->id, 'ট্রেনিং মেটেরিয়ালস')?></li>
<li><?=anchor("training/honorarium/".$training->id, 'সম্মানী ভাতার তালিকা')?></li>
<li><?=anchor("training/marksheet/".$training->id, 'প্রশিক্ষণার্থীর মার্কশীট')?></li>
<li><?=anchor("training/generate_certificate/".$training->id, 'জেনারেট সার্টিফিকেট')?></li>

<?php if($this->ion_auth->is_admin()){ ?>
<li class="divider"></li>
<li><a href="<?=base_url("training/delete_training/".$training->id)?>" onclick="return confirm('Are you sure you want to delete this personal data?');"><?=lang('common_delete')?></a></li>
<?php } ?>

<!-- <li><?=anchor("training/feedback_course/".$training->id, 'কোর্স মূল্যায়ন ফরম')?></li>
<li><?=anchor("training/feedback_course_result/".$training->id, 'কোর্স মূল্যায়ন ফলাফল')?></li> --> 