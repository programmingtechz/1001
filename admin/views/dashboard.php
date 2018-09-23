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
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
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
           <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Pending Orders</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="barChart" style="height:230px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          
           <!-- AREA CHART -->
           <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Total Revenue</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="barChart" style="height:230px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        

        </div>
        <!-- /.col (LEFT) -->
        <div class="col-md-6">
          <!-- DONUT CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">All orders</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                
              </div>
            </div>
            <div class="box-body">
              <canvas id="pieChart" style="height:250px"></canvas>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          
          
          
          <div class="box box-primary">
           
            <div class="box-header ">
              <i class="ion ion-clipboard"></i>
<div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                </div>
              <h3 class="box-title">Latest Orders</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <ul class="todo-list ui-sortable">
                <li>
                 
                  <!-- todo text -->
                  <span class="text">Order no:#<u>12345678</u> Booked Date: 23/06/2018</span>
                  <!-- Emphasis label -->
                  <small class="label label-danger"><i class="fa fa-clock-o"></i> Pending</small>
                  <!-- General tools such as edit or delete-->
                 
                </li>
                 <li>
                  <!-- todo text -->
                  <span class="text">Order no:#<u>12345678</u> Booked Date: 23/06/2018</span>
                  <!-- Emphasis label -->
                  <small class="label label-danger"><i class="fa fa-clock-o"></i> Completed</small>
                  <!-- General tools such as edit or delete-->
                 
                </li>
                  <li>
                  <!-- todo text -->
                  <span class="text">Order no:#<u>12345678</u> Booked Date: 23/06/2018</span>
                  <!-- Emphasis label -->
                  <small class="label label-danger"><i class="fa fa-clock-o"></i> Completed</small>
                  <!-- General tools such as edit or delete-->
                 
                </li>
                  <li>
                  <!-- todo text -->
                  <span class="text">Order no:#<u>12345678</u> Booked Date: 23/06/2018</span>
                  <!-- Emphasis label -->
                  <small class="label label-danger"><i class="fa fa-clock-o"></i> Completed</small>
                  <!-- General tools such as edit or delete-->
                 
                </li>
                  <li>
                  <!-- todo text -->
                  <span class="text">Order no:#<u>12345678</u> Booked Date: 23/06/2018</span>
                  <!-- Emphasis label -->
                  <small class="label label-danger"><i class="fa fa-clock-o"></i> Completed</small>
                  <!-- General tools such as edit or delete-->
                 
                </li>
              </ul>
            </div>
         
            </div>
          </div>

        </div>
        <!-- /.col (RIGHT) -->
      
      
      <div class="row">
      <div class="col-md-12">
          <!-- DONUT CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Orders</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                
              </div>
            </div>
            <div class="box-body">
            <div class="orders_list"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          
          </div>

</div>
    </section>
  