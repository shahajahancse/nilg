<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('evaluation')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <style>
      /*body {
        font-family: arial;
        background: rgb(242, 244, 246);
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      h3 {
        color: rgb(199, 204, 209);
        font-size: 28px;
        text-align: center;
      }*/

      #elements-container {
        text-align: center;
      }

      .draggable-element {
        display: inline-block;
        width: 200px;
        height: 200px;
        background: white;
        border: 1px solid rgb(196, 196, 196);
        line-height: 200px;
        text-align: center;
        margin: 10px;
        color: rgb(51, 51, 51);
        font-size: 30px;
        cursor: move;
      }

      .drag-list {
        width: 400px;
        margin: 0 auto;
      }

      .drag-list > li {
        list-style: none;
        background: rgb(255, 255, 255);
        border: 1px solid rgb(196, 196, 196);
        margin: 5px 0;
        font-size: 24px;
      }

      .drag-list .title {
        display: inline-block;
        width: 130px;
        padding: 6px 6px 6px 12px;
        vertical-align: top;
      }

      .drag-list .drag-area {
        display: inline-block;
        background: rgb(158, 211, 179);
        width: 60px;
        height: 40px;
        vertical-align: top;
        float: right;
        cursor: move;
      }

      .code {
        background: rgb(255, 255, 255);
        border: 1px solid rgb(196, 196, 196);
        width: 600px;
        margin: 22px auto;
        position: relative;
      }

      .code::before {
        content: 'Code';
        background: rgb(80, 80, 80);
        width: 96%;
        position: absolute;
        padding: 8px 2%;
        color: rgb(255, 255, 255);
      }
      
      .code pre {
        margin-top: 50px;
        padding: 0 13px;
        font-size: 1em;
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

          <section class="showcase showcase-1">
      <h3>Example 1</h3>
      <div id="elements-container">
        <div class="draggable-element d-1">Drag 1</div>
        <div class="draggable-element d-2">Drag 2</div>
        <div class="draggable-element d-3">Drag 3</div>
        <div class="draggable-element d-4">Drag 4</div>
      </div>
    </section>
    <section class="code">
      <pre>
$('.draggable-element').arrangeable();
      </pre>
    </section>

    <section class="showcase showcase-2">
      <h3>Example 2</h3>
      <ul class="drag-list">
        <li><span class="title">list 1</span><span class="drag-area"></span></li>
        <li><span class="title">list 2</span><span class="drag-area"></span></li>
        <li><span class="title">list 3</span><span class="drag-area"></span></li>
        <li><span class="title">list 4</span><span class="drag-area"></span></li>
        <li><span class="title">list 5</span><span class="drag-area"></span></li>
        <li><span class="title">list 6</span><span class="drag-area"></span></li>
        <li><span class="title">list 7</span><span class="drag-area"></span></li>
      </ul>
    </section>

    <section class="code">
      <pre>
$('li').arrangeable({dragSelector: '.drag-area'});
      </pre>
    </section>


    


          </div>  <!-- END GRID BODY -->              
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>