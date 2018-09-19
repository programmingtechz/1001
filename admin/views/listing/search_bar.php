  <form id="simple_search_form">
    <div class="row">

      <div class="col-lg-3">
        <div class="input-group">
          <span class="input-group-addon">
            <input id="check_all" name="check_all" type="checkbox" value="1" data-placement="top" data-toggle="tooltip">
          </span>
          <?php echo form_dropdown('action', $bulk_actions, '', 'id="action" class="form-control"');?>
          <span class="input-group-addon">
            <input type="button" onclick="bulk_action();" value="Go">
          </span>
        </div>
      </div>

      <div class="col-lg-2">
        <?php echo form_dropdown('search_type', $simple_search_fields, $search_conditions['search_type'], 'class="form-control"');?> 
      </div>

      <div class="col-lg-3">
        <div class="input-group">
          <input type="text" class="form-control" name="search_text" value="<?php echo $search_conditions['search_text'];?>" placeholder="Search some stuff.">

          <span class="input-group-addon">
            <button type="button" id="simple_search_button"><i class="fa fa-search"></i></button>
          </span>
        </div>

      </div>

      <div class="col-lg-1 clear-filters">
        <div class="input-group">
          <a href="javascript:void(0);" onclick="$.fn.clear_simple_search();" data-placement="top" data-toggle="tooltip" data-original-title="clear simple search">clear filter</a>
        </div>
      </div>

      <div class="col-lg-2">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-gear"></i></span>
          <button type="button" class="btn dropdown-toggle advancesearch" onclick="$.fn.open_advance_search_form()">
            Advanced Search
          </button>
        </div>
      </div>

      <div class="col-lg-1 clear-filters">
        <a href="javascript:void(0);" onclick="$.fn.clear_advance_search();" data-placement="top" data-toggle="tooltip" data-original-title="clear advanced search">clear filter</a>
      </div>

    </div>

    <span style="display:none">
      <?php echo form_dropdown('per_page_options', $per_page_options, $per_page, 'class="form-control input-sm"');?>
    </span>   

  </form>


<div id="div_select_all" style="display:none;"> 
  <div class="menu_action pull-right nowrap m_bot_10">
  
        <a class="btn" href="javascript:;"  title="" onclick="do_select(1, 1)"><i class="icon-ok"></i> Select All</a>
      
        <a class="btn" href="javascript:;"  title="" onclick="do_select(1, 2)"><i class="icon-ok"></i> Select only in this view</a>       
  </div>          
</div>
