<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <div class="page-bar">
        <?php echo set_breadcrumb(); ?>
      </div>
    </section>

    <!-- Main content -->
     <section class="content">
     <div class="row">
     <div class="form-group pull-right" style="padding-right:18px">
              
                <select class="form-control shop_select" style="width: 100%;">
                  <option selected="selected" value="all" >All Shops</option>
                <?php foreach( $shop_list as $k => $v ):?>
                <option value="<?=$v['id']?>" ><?=$v['name']."(".$v['Area'].")"?></option>
                <?php endforeach; ?>
                </select>
     </div>
     </div>
     <div class="row" id="order_stats">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
          <div class="custom_loader"></div>
            <div class="inner">
              <h3 class="total_order">0</h3>

              <p>Total Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
          <div class="custom_loader"></div>
            <div class="inner">
              <h3 class="pending_orders">0</h3>

              <p>Pending Orders</p>
            </div>
            <div class="icon">
               <i class="ion ion-bag"></i>
            </div>
           
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
          <div class="custom_loader"></div>
            <div class="inner">
              <h3 class="completed_orders">0</h3>

              <p>Completed Orders</p>
            </div>
            <div class="icon">
               <i class="ion ion-bag"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
          <div class="custom_loader"></div>
            <div class="inner">
              <h3 class="total_revenue">0</h3>

              <p>Total Amount</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->
      </div>
      <div class="row">
        <div class="col-md-6">
          <!-- AREA CHART -->
           <div class="box box-success all_orders_pie">
           <div class="custom_loader"></div>
            <div class="box-header with-border">
              <h3 class="box-title">All Orders</h3>
               
              <div class="box-tools pull-right">
                <i class="fa fa-refresh"></i><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              
              </div>
              
            </div>
            <div class="box-body chart-responsive">
             <div class="form-group pull-right">
                <div class="input-group">
                  <button type="button" class="btn btn-default pull-right date-range" >
                    <span>
                      <i class="fa fa-calendar"></i> Date range picker
                    </span>
                    <i class="fa fa-caret-down"></i>
                  </button>
                </div>
              </div>
              <div class="chart">
                 <div class="chart-graph" ></div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          
           <!-- AREA CHART -->
           <div class="box box-success all_orders_revenue">
           <div class="custom_loader"></div>
            <div class="box-header with-border">
              <h3 class="box-title">Total Revenue</h3>

              <div class="box-tools pull-right">
                <i class="fa fa-refresh"></i><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              
              </div>
            </div>
            <div class="box-body chart-responsive">
             <div class="form-group pull-right">
                <div class="input-group">
                  <button type="button" class="btn btn-default pull-right date-range" >
                    <span>
                      <i class="fa fa-calendar"></i> Date range picker
                    </span>
                    <i class="fa fa-caret-down"></i>
                  </button>
                </div>
              </div>
                <div class="chart">
                 <div class="chart-graph" ></div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        

        </div>
        <!-- /.col (LEFT) -->
        <div class="col-md-6">
          <!-- DONUT CHART -->
          <div class="box box-danger all_orders_line">
          <div class="custom_loader"></div>
            <div class="box-header with-border">
              <h3 class="box-title">All orders</h3>

              <div class="box-tools pull-right">
                <i class="fa fa-refresh"></i><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                
              </div>
            </div>
            <div class="box-body chart-responsive">
             <select class="form-control status_select pull-left" style="width: 100%;">
                  <option  value="all" >All Orders</option>
                  <option value="ACCEPTED" >Pending Orders</option>
                  <option  selected="selected" value="COMPLETED" >Completed Orders</option>
                
                </select>
              <div class="form-group pull-right">
                <div class="input-group">
                  <button type="button" class="btn btn-default pull-right date-range" >
                    <span>
                      <i class="fa fa-calendar"></i> Date range picker
                    </span>
                    <i class="fa fa-caret-down"></i>
                  </button>
                </div>
              </div>
                <div class="chart">
                 <div class="chart-graph" ></div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          
          
          
          <div class="box box-primary latest_orders">
           
            <div class="box-header ">
              <i class="ion ion-clipboard"></i>
<div class="box-tools pull-right">
                <i class="fa fa-refresh"></i><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                </div>
              <h3 class="box-title">Latest Orders</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="custom_loader"></div>
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <ul class="todo-list ui-sortable">
                
              </ul>
            </div>
         
            </div>
          </div>

        </div>
        <!-- /.col (RIGHT) -->
      
      
      <div class="row cal_orders">
      <div class="col-md-12">
          <!-- DONUT CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Orders</h3>

              <div class="box-tools pull-right">
                <i class="fa fa-refresh"></i><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                
              </div>
            </div>
            <div class="box-body">
            <div class="custom_loader"></div>
            <div class="cal_list"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          
          </div>

</div>
    </section>
  