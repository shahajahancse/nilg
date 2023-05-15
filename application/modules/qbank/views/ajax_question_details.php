<?php 
$expAnswer = explode(",", $info->answer);
?>
<div class="row">    
    <div class="alert" style="display:none;"></div>
    <div class="col-md-12">
        <label class="form-label">অফিসের ধরণঃ <?=$info->office_type_name?></label>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <label class="form-label">প্রশ্নঃ <?=$info->question_title?> </label>        
    </div>
</div>

<?php if($info->question_type == 1 || $info->question_type == 2){ ?>
<div class="row">
    <div class="col-md-12">
        <label class="form-label"> সম্ভ্যাব্য উত্তর <span class="required">*</span></label>
        <textarea name="answer_text" rows="2" class="form-control input-sm"><?=$info->answer?></textarea>
    </div>
</div>

<?php }elseif($info->question_type == 3){ ?>

<div class="row form-row">            
    <div class="col-md-12">                
        <label class="form-label">প্রশ্নের অপশন সমূহঃ</label>
        <table width="100%" border="1" id="radioDiv">
            <tr>
                <td>প্রশ্নের অপশন</td>
                <td width="120">সঠিক উত্তর</td>        
            </tr>
            <?php foreach ($options as $row) { ?>
            <tr>
                <td>
                    <h5> <?=$row->option_name?> </h5>
                    <input type="hidden" name="hide_id[]" value="<?=$row->id?>">
                </td>
                <td>
                    <input type="radio" name="is_right" value="<?=$row->id?>" <?=$info->answer == $row->id ? "checked" : ""; ?>> সঠিক
                </td>      
            </tr>
            <?php } ?>
        </table>
    </div>              
</div>

<?php }elseif($info->question_type == 4){ ?>

<div class="row form-row">            
    <div class="col-md-12">                
        <label class="form-label">প্রশ্নের অপশন সমূহঃ</label>
        <table width="100%" border="1" id="checkDiv">
            <tr>
                <td>প্রশ্নের অপশন</td>
                <td width="120">সঠিক উত্তর</td>                
            </tr>
            <?php 
            foreach ($options as $row) { 
                $checked = in_array($row->id, $expAnswer) ? 'checked':'ddd'; //exit;
                ?>
                <?php //$info->answer == $row->id ? "checked" : ""; ?>
                <tr>
                    <td>
                        <h5> <?=$row->option_name?> </h5>
                        <input type="hidden" name="hide_id[]" value="<?=$row->id?>">
                    </td>
                    <td>
                        <input type="checkbox" name="is_right[<?=$row->id?>]" value="<?=$row->id?>" <?=$checked?>> সঠিক
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>              
    </div>
    <?php } ?>

