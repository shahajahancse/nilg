<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url()?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4> 
            <div class="pull-right">
              <a href="<?=base_url('my_trainings/certificate/'.$info->id)?>" class="btn btn-primary btn-xs btn-mini" onclick="printDiv('printableArea')"> প্রিন্ট করুন</a>
            </div>
          </div>

          <div class="grid-body" id="printableArea">
<style type="text/css">
  #certificate {
  height: 1250px;
  width: 990px;
  /*border:1px solid red;*/
  position: relative;
  }
  #image {
    position: absolute;
    left: 0;
    top: 0;
  }

  #name {
    z-index: 100;
    position: absolute;
    color: black;
    font-size: 24px;
    font-weight: bold;
    left: 280px;
    top: 527px;
    font-size: 30px;
  }
  #designation {
    z-index: 100;
    position: absolute;
    color: black;
    font-size: 24px;
    font-weight: bold;
    left: 315px;
    top: 585px;
    font-size: 30px;
  }
  #upazila {
    z-index: 100;
    position: absolute;
    color: black;
    font-size: 24px;
    font-weight: bold;
    left: 231px;
    top: 648px;
  }
  #zila {
    z-index: 100;
    position: absolute;
    color: black;
    font-size: 24px;
    font-weight: bold;
    left: 629px;
    top: 652px;
  }
  #date_start {
    z-index: 100;
    position: absolute;
    color: black;
    font-size: 24px;
    font-weight: bold;
    left: 85px;
    top: 711px;
  }

  #date_end {
    z-index: 100;
    position: absolute;
    color: black;
    font-size: 24px;
    font-weight: bold;
    left: 423px;
    top: 714px;

  }

  #signature{
    background-image: url(<?=base_url('awedget/assets/img/signature.jpg')?>);
    background-repeat: no-repeat;
    width: 394px;
    height: 142px;
    z-index: 100;
    position: absolute;
    left: 687px;
    top: 1034px;
  }

</style>
            <div id="certificate">
              <img id="image" src="<?=base_url('awedget/assets/img/certificate.jpg')?>" />
              <p id="name"> <?=$info->name_bangla?> </p>
              <p id="designation"> <?=$info->desig_name?></p>
              <p id="upazila"> <?=$info->up_th_name?> </p>
              <p id="zila"> <?=$info->district_name?> </p>
              <p id="date_start"> <?=date('d F, Y', strtotime($info->entry_date))?> </p>
              <p id="date_end"> </p>
              <p id="signature"></p>
            </div>
          </div>

        </div>
      </div>
    </div>

    </div> <!-- END ROW -->

  </div>
</div>