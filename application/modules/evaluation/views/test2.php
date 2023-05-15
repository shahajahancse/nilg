<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('evaluation')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>
<style type="text/css">
  ul:empty {
  padding:20px;
  background: pink;
}
</style>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('evaluation')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>  
            </div>
          </div>
          <div class="grid-body">



          <!-- HTML -->
<div class="row">

  <div class="col-xs-6">
    <h4>List 2</h4>
    <ul id="list2" class="list-group"></ul>
  </div>
  
  <div class="col-xs-6">
    <h4>List 1</h4>
    <ul id="list" class="list-group">
      <li class="list-group-item">Item 1</li>
      <li class="list-group-item">Item 2</li>
      <li class="list-group-item">Item 3</li>
      <li class="list-group-item">Item 4</li>
      <li class="list-group-item">Item 5</li>
    </ul>
  </div>

  
</div>
    


          </div>  <!-- END GRID BODY -->              
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>