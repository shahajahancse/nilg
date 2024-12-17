<div class="row">    
    <div class="alert" style="display:none;"></div>
    <div class="col-md-12">
        <label class="form-label"><em>প্রশিক্ষণার্থীর নামঃ</em> <?=$info->name_bn?></label>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <label class="form-label"><em>মূল্যায়নের বিষয়ঃ</em> <?=$info->subject_name?> </label>        
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <label class="form-label"> নম্বরঃ <span class="required">*</span></label>
        <input type="number" name="mark" value="<?=$info->mark?>" class="form-control input-sm" onClick="this.select();">
    </div>
</div>

<br><br>
